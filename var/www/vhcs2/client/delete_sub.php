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

if (isset($_GET['id']) && $_GET['id'] !== '') {
  $sub_id = $_GET['id'];
  $dmn_id = get_user_domain_id($sql, $_SESSION['user_id']);

  $query = <<<SQL_QUERY
        select
             subdomain_id
        from
            subdomain
        where
            domain_id = ?
          and
            subdomain_id = ?
SQL_QUERY;

  $rs = exec_query($sql, $query, array($dmn_id, $sub_id));
  if ($rs -> RecordCount() == 0) {
    user_goto('manage_domains.php');
  }

  check_for_lock_file();

  $query = <<<SQL_QUERY
        update
            subdomain
        set
            subdomain_status = 'delete'
        where
            subdomain_id = ?
SQL_QUERY;

  $rs = exec_query($sql, $query, array($sub_id));
  send_request();
  set_page_message(tr('Subdomain scheduled for deletion!'));
  header('Location: manage_domains.php');
  exit(0);

} else {

  header('Location: manage_domains.php');
  exit(0);

}

?>
