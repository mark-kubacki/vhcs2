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
  $als_id = $_GET['id'];
	check_for_lock_file();

  $query = <<<SQL_QUERY
        update
            domain_aliasses
        set
            url_forward = 'no',
            alias_status = 'change'
        where
            alias_id = ?
SQL_QUERY;

  $rs = exec_query($sql, $query, array($als_id));

  send_request();
  write_log($_SESSION['user_logged']." : change domain alias forward");
  set_page_message(tr('Alias scheduled for modification!'));
  header('Location: manage_domains.php');
  exit(0);

} else {

  header('Location: manage_domains.php');
  exit(0);
}

?>
