<?php
//   -------------------------------------------------------------------------------
//  |             VHCS(tm) - Virtual Hosting Control System                         |
//  |              Copyright (c) 2001-2005 be moleSoftware		            		|
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

include 'include/vhcs-lib.php';

if (isset($_POST['uname']) && isset($_POST['upass'])) {

	$uname = get_punny($_POST['uname']);

    if (register_user($uname, $_POST['upass'])) {

        if ($_SESSION['user_type'] == 'admin') {

            header("Location: admin/index.php");

        } else if ($_SESSION['user_type'] == 'reseller') {

            header("Location: reseller/index.php");

        } else if ($_SESSION['user_type'] == 'user') {

            header("Location: client/index.php");

        }

   } else {

		header('Location: index.php');

   }

} else {

      header('Location: index.php');

}

exit(0);

?>
