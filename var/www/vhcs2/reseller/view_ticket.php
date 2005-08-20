<?php
//   -------------------------------------------------------------------------------
//  |             VHCS(tm) - Virtual Hosting Control System                         |
//  |              Copyright (c) 2001-2005 by moleSoftware		            		|
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

$tpl -> define_dynamic('page', $cfg['RESELLER_TEMPLATE_PATH'].'/view_ticket.tpl');

$tpl -> define_dynamic('page_message', 'page');

$tpl -> define_dynamic('logged_from', 'page');

$tpl -> define_dynamic('tickets_list', 'page');

$tpl -> define_dynamic('tickets_item', 'tickets_list');

$tpl -> define_dynamic('custom_buttons', 'page');

//
// page functions.
//





function gen_tickets_list(&$tpl, &$sql, &$ticket_id)
{
  $user_id = $_SESSION['user_id'];
  $query = <<<SQL_QUERY
    	select
          ticket_id,
          ticket_status,
          ticket_reply,
          ticket_urgency,
          ticket_date,
          ticket_subject,
          ticket_message
      from
        	tickets
      where
        	ticket_id = ?
        and
          (ticket_from = ? or ticket_to = ?)
SQL_QUERY;

  $rs = exec_query($sql, $query, array($ticket_id, $user_id, $user_id));

		if ($rs -> RecordCount() == 0) {

        $tpl -> assign('TICKETS_LIST', '');

        set_page_message(tr('Ticket not found!'));

    } else {


		$ticket_urgency = $rs -> fields['ticket_urgency'];
		$ticket_subject = $rs -> fields['ticket_subject'];
		$ticket_status = $rs -> fields['ticket_status'];

		if ($ticket_status == 0){
				$tr_action = tr("Open ticket");
				$action = "open";
			}
			else {
				$tr_action = tr("Close ticket");
				$action = "close";
			}
			if ($ticket_urgency == 1){
				$urgency = tr("Low");
				$urgency_id = "1";
			}
			else if ($ticket_urgency == 2){
				$urgency = tr("Medium");
				$urgency_id = "2";
			}
			else if ($ticket_urgency == 3){
				$urgency = tr("High");
				$urgency_id = "3";
			}
			else if ($ticket_urgency == 4){
				$urgency = tr("Very high");
				$urgency_id = "4";
			}

			get_ticket_from($tpl, $sql, $ticket_id);
			global $cfg;
			$date_formt = $cfg['DATE_FORMAT'];

			$tpl -> assign(
									array(
											'TR_ACTION' => $tr_action,
											'ACTION' => $action,
											'URGENCY' => $urgency,
											'URGENCY_ID' => $urgency_id,
											'DATE' => date($date_formt, $rs -> fields['ticket_date']),
											'SUBJECT' => $rs -> fields['ticket_subject'],
											'TICKET_CONTENT' => $rs -> fields['ticket_message'],
											'ID' => $rs -> fields['ticket_id'],

										)
								  );

			$tpl -> parse('TICKETS_ITEM', '.tickets_item');
			get_tickets_replys($tpl, $sql, $ticket_id);
		}

}
function get_tickets_replys(&$tpl, &$sql, &$ticket_id)
{
  $query = <<<SQL_QUERY
    	select
            ticket_id,
            ticket_status,
            ticket_reply,
            ticket_urgency,
            ticket_date,
            ticket_subject,
            ticket_message
      from
            tickets
      where
            ticket_reply = ?
      order by
            ticket_id ASC
SQL_QUERY;

		$rs = exec_query($sql, $query, array($ticket_id));

		while (!$rs -> EOF) {


			$ticket_id = $rs -> fields['ticket_id'];
			$ticket_subject = $rs -> fields['ticket_subject'];
            $ticket_date = $rs -> fields['ticket_date'];
            $ticket_message = $rs -> fields['ticket_message'];

			global $cfg;
			$date_formt = $cfg['DATE_FORMAT'];

			$tpl -> assign(
                            array(
                                    'DATE' => date($date_formt, $rs -> fields['ticket_date']),
									'TICKET_CONTENT' => $rs -> fields['ticket_message'],
                                 )
                          );
			get_ticket_from($tpl, $sql, $ticket_id);
			$tpl -> parse('TICKETS_ITEM', '.tickets_item');
			$rs -> MoveNext();

			}

}

function get_ticket_from(&$tpl, &$sql, &$ticket_id)
{
	$query = <<<SQL_QUERY
        select
            ticket_from,
            ticket_to,
            ticket_status,
            ticket_reply
        from
        	tickets
        where
        	ticket_id = ?

SQL_QUERY;

		$rs = exec_query($sql, $query, array($ticket_id));
		$ticket_from = $rs -> fields['ticket_from'];
		$ticket_to = $rs -> fields['ticket_to'];
		$ticket_status = $rs -> fields['ticket_status'];
		$ticket_reply = $rs -> fields['ticket_reply'];

	$query = <<<SQL_QUERY
        select
            admin_name,
            admin_type,
            fname,
            lname
        from
            admin
        where
            admin_id = ?
SQL_QUERY;

	$rs = exec_query($sql, $query, array($ticket_from));
	$from_user_name = $rs -> fields['admin_name'];
	$admin_type = $rs -> fields['admin_type'];
	$from_first_name = $rs -> fields['fname'];
	$from_last_name = $rs -> fields['lname'];

	$from_name = $from_first_name." ".$from_last_name." (".$from_user_name.")";

			$tpl -> assign(
                            array(
                                    'FROM' => $from_name

                                 )
                          );


}





//
// common page data.
//

global $cfg;
$theme_color = $cfg['USER_INITIAL_THEME'];

$tpl -> assign(
                array(
                        'TR_CLIENT_VIEW_TICKET_PAGE_TITLE' => tr('VHCS - Reseller : Support System: View Tickets'),
                        'THEME_COLOR_PATH' => "../themes/$theme_color",
                        'THEME_CHARSET' => tr('encoding'),
                        'VHCS_LICENSE' => $cfg['VHCS_LICENSE'],
						'ISP_LOGO' => get_logo($_SESSION['user_id']),

                     )
              );


function send_user_message(&$sql, $user_id, $reseller_id, $ticket_id)
{
  if (!isset($_POST['uaction'])) return;

	// close ticket
	elseif ($_POST['uaction'] == "close"){
		close_ticket($sql, $ticket_id);
		return;
	}
	// open ticket
	elseif ($_POST['uaction'] == "open"){
		open_ticket($sql, $ticket_id);
		return;
	}
	// no message check->error
	elseif ($_POST['user_message'] === '') {

        set_page_message(tr('Please type your message!'));

        return;

    }


    $ticket_date = time();

    $subj = $_POST['subject'];

    $user_message = preg_replace("/\n/", "<br>", $_POST["user_message"]);

	$ticket_status = 2;

	$ticket_reply = $_GET['ticket_id'];


$query = <<<SQL_QUERY
        select
            ticket_level,
            ticket_from,
            ticket_to,
            ticket_status,
            ticket_reply,
            ticket_urgency,
            ticket_date,
            ticket_subject,
            ticket_message
        from
            tickets
        where
            ticket_id = ?
SQL_QUERY;

		$rs = exec_query($sql, $query, array($ticket_reply));

		$ticket_level = $rs -> fields['ticket_level'];

		if ($ticket_level!=1){
			$ticket_to = $rs -> fields['ticket_from'];

			$ticket_from = $rs -> fields['ticket_to'];
		}
		else{
			$ticket_to = $rs -> fields['ticket_to'];

			$ticket_from = $rs -> fields['ticket_from'];
		}

	$urgency = $_POST['urgency'];

    $query = <<<SQL_QUERY
        insert into tickets
            (ticket_from,
             ticket_to,
             ticket_status,
             ticket_reply,
             ticket_urgency,
             ticket_date,
             ticket_subject,
             ticket_message)
        values
            (?, ?, ?, ?, ?, ?, ?, ?)
SQL_QUERY;

    $rs = exec_query($sql, $query, array($ticket_to,
                                         $ticket_from,
                                         $ticket_status,
                                         $ticket_reply,
                                         $urgency,
                                         $ticket_date,
                                         $subj,
                                         $user_message));

	set_page_message(tr('Message was sent.'));

}


function get_send_to_who(&$sql, &$ticket_reply)
{
	$query = <<<SQL_QUERY
        select
            ticket_from
        from
            tickets
        where
            ticket_id = ?
SQL_QUERY;

		$rs = exec_query($sql, $query, array($ticket_reply));
		$ticket_from = $rs -> fields['ticket_from'];

	$query = <<<SQL_QUERY
        select
            admin_type
        from
            admin
        where
            admin_id = ?
SQL_QUERY;

	$rs = exec_query($sql, $query, array($ticket_from));
	$admin_type = $rs -> fields['admin_type'];

}

function close_ticket($sql, $ticket_id)
{
$query = <<<SQL_QUERY
      update
          tickets
      set
          ticket_status = '0'
      where
          ticket_id = ?
SQL_QUERY;

		$rs = exec_query($sql, $query, array($ticket_id));

		set_page_message(tr('Ticket was closed!'));

}

function open_ticket($sql, $ticket_id)
{

$query = <<<SQL_QUERY
        select
            ticket_level
        from
            tickets
        where
            ticket_id = ?
SQL_QUERY;

	$rs = exec_query($sql, $query, array($ticket_id));

	global $ticket_level;

	$ticket_level = $rs -> fields['ticket_level'];
	if ($ticket_level != 2){
		//if ticket to user
		$ticket_status = 2;
	}
	else
	{
		//if ticket to admin
		$ticket_status = 3;
	}

$query = <<<SQL_QUERY
        update
            tickets
        set
            ticket_status = ?
        where
            ticket_id = ?
SQL_QUERY;

		$rs = exec_query($sql, $query, array($ticket_status, $ticket_id));

		//set_page_message(tr('Ticket was closed!'));

}

function change_ticket_status_view($sql, $ticket_id)
{
	$query = <<<SQL_QUERY
        select
            ticket_level,
            ticket_status
        from
            tickets
        where
            ticket_id = ?
SQL_QUERY;

    $rs = exec_query($sql, $query, array($ticket_id));
		$ticket_level = $rs -> fields['ticket_level'];
		$ticket_status = $rs -> fields['ticket_status'];

		if ($ticket_status == 0) return;

		else if ($ticket_level != 2){
		//if ticket to user
		$ticket_status = 2;
		}
		else
		{
			//if ticket to admin
			$ticket_status = 3;
		}

$query = <<<SQL_QUERY
        update
            tickets
        set
            ticket_status = ?
        where
            ticket_id = ?
SQL_QUERY;

  $rs = exec_query($sql, $query, array($ticket_status, $ticket_id));
}



//
// dynamic page data.
//

	global $cfg;
	$support_system = $cfg['VHCS_SUPPORT_SYSTEM'];

	if ($support_system !== 'yes'){
		header( "Location: index.php" );
        die();

	}
$reseller_id = $_SESSION['user_created_by'];
if (isset($_GET['ticket_id'])) {

	change_ticket_status_view($sql, $_GET['ticket_id']);

	send_user_message($sql, $_SESSION['user_id'], $reseller_id, $_GET['ticket_id']);

	gen_tickets_list($tpl, $sql, $_GET['ticket_id']);

}
else
{
    set_page_message(tr('Ticket not found!'));

	Header("Location: support_system.php");
	die();

}



//
// static page messages.
//

gen_reseller_menu($tpl);

gen_logged_from($tpl);

$tpl -> assign(
                array(
                        'TR_VEIW_SUPPORT_TICKET' => tr('View support ticket'),
						'TR_TICKET_URGENCY' => tr('Priority'),
						'TR_TICKET_SUBJECT' => tr('Subject'),
						'TR_TICKET_DATE' => tr('Date'),
						'TR_DELETE' => tr('Delete'),
						'TR_NEW_TICKET_REPLY' => tr('Send message reply'),
						'TR_REPLY' => tr('Send reply'),
						'TR_TICKET_FROM' => tr('From'),
						'TR_OPEN_TICKETS' => tr('Open tickets'),
						'TR_CLOSED_TICKETS' => tr('Closed tickets'),
                     )
              );

gen_page_message($tpl);

$tpl -> parse('PAGE', 'page');

$tpl -> prnt();

if (isset($cfg['DUMP_GUI_DEBUG'])) dump_gui_debug();

unset_messages();
?>
