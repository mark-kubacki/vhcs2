<?php
//   -------------------------------------------------------------------------------
//  |             VHCS(tm) - Virtual Hosting Control System                         |
//  |              Copyright (c) 2001-2005 by moleSoftware	|
//  |			http://vhcs.net | http://www.molesoftware.com		           		|
//  |                                                                               |
//  | This program is free software; you can redistribute it and/or                 |
//  | modify it under the terms of the MPL General Public License                   |
//  | as published by the Free Software Foundation; either version 1.1              |
//  | of the License, or (at your option) any later version.                        |
//  |                                                                               |
//  | You should have received a copy of the MPL Mozilla Public License             |
//  | along with this program; if not, write to the Open Source Initiative (OSI)    |
//  | http://opensource.org | osi@opensource.org								    |
//  |                                                                               |
//   -------------------------------------------------------------------------------


include '../include/vhcs-lib.php';

check_login();

$tpl = new pTemplate();
$tpl -> define_dynamic('page', $cfg['CLIENT_TEMPLATE_PATH'].'/create_catchall.tpl');
$tpl -> define_dynamic('page_message', 'page');
$tpl -> define_dynamic('logged_from', 'page');
$tpl -> define_dynamic('mail_list', 'page');
$tpl -> define_dynamic('custom_buttons', 'page');

if (isset($_GET['id'])) {
  $item_id = $_GET['id'];
} else if (isset($_POST['id'])) {
  $item_id = $_POST['id'];
} else {
  user_goto('catchall.php');
}

//
// page functions.
//
function gen_dynamic_page_data(&$tpl, &$sql, $id)
{
  global $_SESSION, $cfg;

  list($dmn_id,
       $dmn_name,
       $dmn_gid,
       $dmn_uid,
       $dmn_created_id,
       $dmn_created,
       $dmn_last_modified,
       $dmn_mailacc_limit,
       $dmn_ftpacc_limit,
       $dmn_traff_limit,
       $dmn_sqld_limit,
       $dmn_sqlu_limit,
       $dmn_status,
       $dmn_als_limit,
       $dmn_subd_limit,
       $dmn_ip_id,
       $dmn_disk_limit,
       $dmn_disk_usage,
       $dmn_php,
       $dmn_cgi) = get_domain_default_props($sql, $_SESSION['user_id']);

  list($mail_acc_cnt,
       $dmn_mail_acc_cnt,
       $sub_mail_acc_cnt,
       $als_mail_acc_cnt) = get_domain_running_mail_acc_cnt($sql, $dmn_id);

  if ($dmn_mailacc_limit != 0 &&  $mail_acc_cnt >= $dmn_mailacc_limit) {
    set_page_message(tr('Mail accounts limit expired!'));
    header("Location: catchall.php");
    die();
  }

  $ok_status = $cfg['ITEM_OK_STATUS'];
  if (preg_match("/(\d+);(dmn|als)/", $id, $match) == 1) {
    $item_id = $match[1];
    $item_type = $match[2];

    if ($item_type === 'dmn') {
      $query = <<<SQL_QUERY
                select
                    t1.mail_id, t1.mail_type, t2.domain_name, t1.mail_acc
                from
                    mail_users as t1,
                    domain as t2
                where
                    t1.domain_id = ?
                  and
                    t2.domain_id = ?
                  and
                    t1.sub_id = '0'
                  and
                    t1.status = ?
                  and
                    t1.mail_type = 'normal_mail'
                order by
                    t1.mail_type desc, t1.mail_id
SQL_QUERY;

      $rs = exec_query($sql, $query, array($item_id, $item_id, $ok_status));
      if ($rs -> RecordCount() == 0) {
        user_goto('catchall.php');
      }

      while (!$rs -> EOF) {
        $show_mail_acc = decode_idna($rs -> fields['mail_acc']);
        $show_domain_name = decode_idna($rs -> fields['domain_name']);
        $mail_acc = $rs -> fields['mail_acc'];
        $domain_name = $rs -> fields['domain_name'];
        $tpl -> assign(array('MAIL_ID' => $rs -> fields['mail_id'],
                             'MAIL_ACCOUNT' => $show_mail_acc."@".$show_domain_name, // this will be show in the templates
                             'MAIL_ACCOUNT_PUNNY' => $mail_acc."@".$domain_name //this will be updated wenn we crate cach all
                            )
                      );

        $tpl -> parse('MAIL_LIST', '.mail_list');
        $rs -> MoveNext();
      }

    } else if ($item_type === 'als') {

      $query = <<<SQL_QUERY
                select
                    t1.mail_id, t1.mail_type, t2.alias_name, t1.mail_acc
                from
                    mail_users as t1,
                    domain_aliasses as t2
                where
                    t1.sub_id = t2.alias_id
                  and
                    t1.status = ?
                  and
                    t2.alias_id = ?
                  and
                    t1.mail_type = 'alias_mail'
                order by
                  t1.mail_type desc, t1.mail_id
SQL_QUERY;

      $rs = exec_query($sql, $query, array($ok_status, $item_id));

      if ($rs -> RecordCount() == 0) {
        user_goto('catchall.php');
      }

      while (!$rs -> EOF) {
        $show_mail_acc = decode_idna($rs -> fields['mail_acc']);
        $show_alias_name = decode_idna($rs -> fields['alias_name']);
        $mail_acc = $rs -> fields['mail_acc'];
        $alias_name = $rs -> fields['alias_name'];
        $tpl -> assign(array('MAIL_ID' => $rs -> fields['mail_id'],
                             'MAIL_ACCOUNT' => $show_mail_acc."@".$show_alias_name, // this will be show in the templates
                             'MAIL_ACCOUNT_PUNNY' =>  $mail_acc."@".$alias_name //this will be updated wenn we crate cach all
                             )
                      );

        $tpl -> parse('MAIL_LIST', '.mail_list');
        $rs -> MoveNext();
      }

    }

  } else {
    user_goto('catchall.php');
  }

}

function create_catchall_mail_account($sql, $id)
{
  global $cfg;

  if (isset($_POST['uaction']) && $_POST['uaction'] === 'create_catchall') {
    if (preg_match("/(\d+);(dmn|als)/", $id, $match) == 1) {
      $item_id = $match[1];
      $item_type = $match[2];
      $post_mail_id = $_POST['mail_id'];

      if (preg_match("/(\d+);([^;]+);/", $post_mail_id, $match) == 1) {
        $mail_id = $match[1];
        $mail_acc = $match[2];
        if ($item_type === 'dmn') {
          $mail_type = 'normal_catchall';
        } else {
          $mail_type = 'alias_catchall';
        }

        $query = <<<SQL_QUERY
                    select
                        domain_id, sub_id
                    from
                        mail_users
                    where
                        mail_id = ?
SQL_QUERY;

        $rs = exec_query($sql, $query, array($mail_id));
        $domain_id = $rs -> fields['domain_id'];
        $sub_id = $rs -> fields['sub_id'];
        $status = $cfg['ITEM_ADD_STATUS'];
        check_for_lock_file();

        $query = <<<SQL_QUERY
                    insert into mail_users
                        (mail_acc,
                         mail_pass,
                         mail_forward,
                         domain_id,
                         mail_type,
                         sub_id,
                         status,
                         mail_auto_respond)
                    values
                        (?, ?, ?, ?, ?, ?, ?, ?)
SQL_QUERY;

        $rs = exec_query($sql, $query, array($mail_acc, '_no_', '_no_', $domain_id, $mail_type, $sub_id, $status, '_no_'));

        send_request();
        write_log($_SESSION['user_logged']." : add new email catch all ");
        set_page_message(tr('Catch all account sheculed for creation!'));
        user_goto('catchall.php');
      } else {
        user_goto('catchall.php');
      }
    } else {
      user_goto('catchall.php');
    }
  }
}


//
// common page data.
//
global $cfg;
$theme_color = $cfg['USER_INITIAL_THEME'];

$tpl -> assign(array('TR_CLIENT_CREATE_CATCHALL_PAGE_TITLE' => tr('VHCS - Client/Create CatchAll Mail Account'),
                     'THEME_COLOR_PATH' => "../themes/$theme_color",
                     'THEME_CHARSET' => tr('encoding'),
                     'TID' => $_SESSION['layout_id'],
                     'VHCS_LICENSE' => $cfg['VHCS_LICENSE'],
                     'ISP_LOGO' => get_logo($_SESSION['user_id'])));

//
// dynamic page data.
//
gen_dynamic_page_data($tpl, $sql, $item_id);
create_catchall_mail_account($sql, $item_id);
$tpl -> assign('ID', $item_id);

//
// static page messages.
//
gen_client_menu($tpl);
gen_logged_from($tpl);
check_permissions($tpl);

$tpl -> assign(array('TR_CREATE_CATCHALL_MAIL_ACCOUNT' => tr('Create catch all mail account'),
                     'TR_MAIL_LIST' => tr('Mail accounts list'),
                     'TR_CREATE_CATCHALL' => tr('Create catch all')));

gen_page_message($tpl);
$tpl -> parse('PAGE', 'page');
$tpl -> prnt();

if (isset($cfg['DUMP_GUI_DEBUG'])) dump_gui_debug();

unset_messages();

?>
