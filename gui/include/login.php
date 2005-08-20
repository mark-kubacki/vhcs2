<?php
//   -------------------------------------------------------------------------------
//  |             VHCS(tm) - Virtual Hosting Control System                         |
//  |              Copyright (c) 2001-2004 be moleSoftware		            		|
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



function register_user($uname, $upass) {

    global $sql;

    global $cfg;


    $timestamp = time();


    if ($cfg['DB_TYPE'] === 'mysql') {
        $query = "select admin_id, admin_pass, admin_type, created_by from admin where binary admin_name = ?";
    }

    $rs = exec_query($sql, $query, array($uname));

    if (($rs -> RecordCount()) != 1)  {

		write_log("Login error, <b><i>".$uname."</i></b> unknown username");

        return false;

    }

    $udata = $rs -> FetchRow();

    if (crypt($_POST['upass'], $udata[1]) === $udata[1] || md5($_POST['upass']) === $udata[1]) {

        if (isset($_SESSION['user_logged'])) {

			write_log($_SESSION['user_logged']." user already logged or session sharing problem! Aborting...");

            system_message(tr('User already logged or session sharing problem! Aborting...'));

   		} else {

					if ($udata['admin_type'] == "user"){

							$domain_admin_id = $udata['admin_id'];

							$query = <<<SQL_QUERY
                          select
                                domain_status
                          from
                                domain
                          where
                                domain_admin_id = ?;
SQL_QUERY;

              $rs = exec_query($sql, $query, array($domain_admin_id));

							$user_dom_data = $rs -> FetchRow();

							if ($user_dom_data['domain_status'] != $cfg['ITEM_OK_STATUS']){

								write_log( $uname." Domain status is not OK - user can not login");

								return false;
							}
			}

			// all is OK let's login the user
		$user_login_time = time();

    $query = <<<SQL_QUERY
        insert into login
            (session_id, lastaccess)
        values
            (?, ?)
SQL_QUERY;

    $rs = exec_query($sql, $query, array($uname, $user_login_time));


            $_SESSION['user_logged'] = $uname;

            $_SESSION['user_type'] = $udata['admin_type'];

            $_SESSION['user_id'] = $udata['admin_id'];

            $_SESSION['user_created_by'] = $udata['created_by'];

            $_SESSION['user_login_time'] = $user_login_time;

			write_log( $uname." user logged in.");

            return true;

        }

    } else {

		write_log( $uname." bad password login data.");

        return false;

    }

}

function check_user_login($uname, $utype, $uid) {

    global $cfg, $sql;

    $timestamp = time();
	//lets kill all time out sessions
	global $cfg;
    $timeout_sessions =  $timestamp - $cfg['SESSION_TIMEOUT'];
	$query = <<<SQL_QUERY
        delete from
            login
        where
            lastaccess < ?
SQL_QUERY;

  $rs = exec_query($sql, $query, array($timeout_sessions));


    if (isset($_SESSION['user_logged'])) {

	$user_id = $_SESSION['user_logged'];

	$query = <<<SQL_QUERY
        select
          	 session_id
        from
            login
        where
            session_id = ?
SQL_QUERY;

    $rs = exec_query($sql, $query, array($user_id));

	if ($rs -> RecordCount() == 0) {

        write_log($_SESSION['user_logged']." user session do not exist or killed");

        return false;

    }


        if ($timestamp - $_SESSION['user_login_time'] <= $cfg['SESSION_TIMEOUT']) {

            $_SESSION['user_login_time'] = $timestamp;

$query = <<<SQL_QUERY
        update
            login
        set
            lastaccess = ?
        where
             session_id = ?
SQL_QUERY;
			$rs = exec_query($sql, $query, array($timestamp, $user_id));

            goto_user_location();

            return true;

        } else {

			$query = <<<SQL_QUERY
            delete from
                login
            where
                session_id = ?
SQL_QUERY;

		    $rs = exec_query($sql, $query, array($user_id));
			write_log($uname." user session timed out");

            return false;

        }

    } else {


		write_log($uname." bad session data.");

        return false;

    }

}


function goto_user_location()
{
    $path = explode("/", $_SERVER['SCRIPT_NAME']);

    $found = false;

    for($i=0; $i< count($path);$i++){

        if($path[$i] == $_SESSION['user_type']){

            $found= true;

        } else if ($_SESSION['user_type'] == 'user' && $path[$i] == 'client') {

            $found= true;

        }
   }
   if(!$found)
   {

        if ($_SESSION['user_type'] == 'admin') {

            header("Location: ../admin/manage_users.php");

        } else if ($_SESSION['user_type'] == 'reseller') {

            header("Location: ../reseller/index.php");

        } else if ($_SESSION['user_type'] == 'user') {

            header("Location: ../client/index.php");

        }
    }

}

function check_login () {

    if (isset($_SESSION['user_logged'])) {

        if (!check_user_login($_SESSION['user_logged'], $_SESSION['user_type'], $_SESSION['user_id'])) {

            header("Location: ../index.php");

        }

    } else {

        header("Location: ../index.php");

    }

function change_user_interface($form_id, $to_id) {

    global $sql;

    global $cfg;


    $timestamp = time();

    if ($cfg['DB_TYPE'] === 'mysql') {
      $query_from = "select admin_id, admin_name, admin_pass, admin_type, created_by from admin where binary admin_id = ?";
      $query_to = "select admin_id, admin_name, admin_pass, admin_type, created_by from admin where binary admin_id = ?";
    }

    $rs_from = exec_query($sql, $query_from, array($form_id));
    $rs_to = exec_query($sql, $query_to, array($to_id));

    if (($rs_from -> RecordCount()) != 1 || ($rs_to -> RecordCount()) != 1)  {
      write_log("Change interface error => unknown from or to username");
      return false;
    }


    $from_udata = $rs_from -> FetchRow();

    $to_udata = $rs_to -> FetchRow();


		// let's check if TO_DOMAIN Status OK
		// if domain satus not OK -> don't add mail accounts or subdomains .. or something else

		if ($to_udata['admin_type'] == "user"){

					$domain_admin_id = $to_udata['admin_id'];

          $query = <<<SQL_QUERY
                  select
                      domain_status
                  from
                      domain
                  where
                      domain_admin_id = ?
SQL_QUERY;

						$rs = exec_query($sql, $query, array($domain_admin_id));

						$user_dom_data = $rs -> FetchRow();

							if ($user_dom_data['domain_status'] != $cfg['ITEM_OK_STATUS']){

								write_log("Domain ID: ".$to_udata['admin_id']." - domain status PROBLEM -");

								return false;
							}
					}
		//end of Domain User Status check



			if ($from_udata['admin_type'] === 'admin' && $to_udata['admin_type'] === 'reseller') {

       		     $header = "../reseller/index.php";

	        } else if ($from_udata['admin_type'] === 'admin' && ($to_udata['admin_type'] != 'admin' || $to_udata['admin_type'] != 'reseller')) {

         		 $header = "../client/index.php";

			} else if ($from_udata['admin_type'] === 'reseller' && ($to_udata['admin_type'] != 'admin' || $to_udata['admin_type'] != 'reseller')) {

         		 $header = "../client/index.php";

    	    }

			// lets check and go from bottom to top User -> Reseller -> Admin

			else if (isset($_SESSION['logged_from'])) { // ther is SESSION 'logged from' -> we can go from Buttom to TOP

					if ($from_udata['admin_type'] === 'reseller' && $to_udata['admin_type'] == 'admin') {

					 $header = "../admin/manage_users.php";

					}
					// user to admin
					else if (($from_udata['admin_type'] != 'admin' || $from_udata['admin_type'] != 'reseller') && $to_udata['admin_type'] === 'admin') {

						 $header = "../admin/manage_users.php";

					}
					// user reseller
					else if (($from_udata['admin_type'] != 'admin' || $from_udata['admin_type'] != 'reseller') && $to_udata['admin_type'] === 'reseller') {

						 $header = "../reseller/users.php";

					}

					else{

						write_log("change interface error from: ".$from_udata['admin_name']." to: ".$to_udata['admin_name']);

				        return false;
					}



			} else {

				write_log("change interface error from: ".$from_udata['admin_name']." to: ".$to_udata['admin_name']);

			    return false;
			}

			// lets save layout and language from admin/reseler - they don't wannt to read user interface on china or arabic language
			$user_language = $_SESSION['user_def_lang'];

			$user_layout = $_SESSION['user_theme_color'];


			// delete all sessions and globals data and set new one with SESSION logged_from
			unset_user_login_data();

 			if ($to_udata['admin_type'] != 'admin'){

				$_SESSION['logged_from'] = $from_udata['admin_name'];

				$_SESSION['logged_from_id'] = $from_udata['admin_id'];

			}

			// we gonna kill all sessions and globals if user get back to admin level
				if (isset($_SESSION['admin_name']))

				unset($_SESSION['admin_name']);

				if (isset($_SESSION['admin_id']))

				unset($_SESSION['admin_id']);

				if (isset($GLOBALS['admin_name']))

				unset($GLOBALS['admin_name']);

				if (isset($GLOBALS['admin_id']))

				unset($GLOBALS['admin_id']);
			// no more sessions and globals to kill - they were always killed - rest in peace

            $_SESSION['user_logged'] = $to_udata['admin_name'];

            $_SESSION['user_type'] = $to_udata['admin_type'];

            $_SESSION['user_id'] = $to_udata['admin_id'];

            $_SESSION['user_created_by'] = $to_udata['created_by'];

            $_SESSION['user_login_time'] = time();

			$_SESSION['user_def_lang'] = $user_language;

			$_SESSION['user_theme_color'] = $user_layout;

			$user_login_time = time();
			$new_user_name = $to_udata['admin_name'];

			$query = <<<SQL_QUERY
        insert into login
            (session_id, lastaccess)
        values
            (?, ?)
SQL_QUERY;

    $rs = exec_query($sql, $query, array($new_user_name, $user_login_time));

    write_log($from_udata['admin_name']." change into interface from ".$to_udata['admin_name']);
    return $header;
	}
}

function unset_user_login_data () {

    global $cfg, $sql;

    if (isset($_SESSION['user_logged'])) {
    $admin_name = $_SESSION['user_logged'];

    $query = <<<SQL_QUERY
        delete from
            login
        where
             session_id = ?
SQL_QUERY;

    $rs = exec_query($sql, $query, array($admin_name));

        unset($_SESSION['user_logged']);
		}

    if (isset($_SESSION['user_id']))

        unset($_SESSION['user_id']);

    if (isset($_SESSION['user_type']))

        unset($_SESSION['user_type']);

    if (isset($_SESSION['user_created_by']))

        unset($_SESSION['user_created_by']);

    if (isset($_SESSION['user_login_time']))

        unset($_SESSION['user_login_time']);

	if (isset($_SESSION['dmn_name']))

        unset($_SESSION['dmn_name']);

	if (isset($_SESSION['user_has_domain']))

        unset($_SESSION['user_has_domain']);

	if (isset($_SESSION['hpid']))

        unset($_SESSION['hpid']);

	if (isset($_SESSION['user_deleted']))

        unset($_SESSION['user_deleted']);

	if (isset($_SESSION['edit']))

        unset($_SESSION['edit']);

	if (isset($_SESSION['reseller_ips']))

        unset($_SESSION['reseller_ips']);

	if (isset($_SESSION['sql_support']))

        unset($_SESSION['sql_support']);

	if (isset($_SESSION['email_support']))

        unset($_SESSION['email_support']);

	if (isset($_SESSION['admin_id']))

        unset($_SESSION['admin_id']);

	if (isset($_SESSION['admin_login']))

        unset($_SESSION['admin_login']);

	if (isset($_SESSION['admin_type']))

        unset($_SESSION['admin_type']);

	if (isset($_SESSION['admin_email']))

        unset($_SESSION['admin_email']);

	if (isset($_SESSION['cur_lang']))

        unset($_SESSION['cur_lang']);

	if (isset($_SESSION['step_two_back_data']))

        unset($_SESSION['step_two_back_data']);

	if (isset($_SESSION['local_data']))

        unset($_SESSION['local_data']);

	if (isset($_SESSION['logged']))

        unset($_SESSION['logged']);

	if (isset($_SESSION['subdomain_support']))

        unset($_SESSION['subdomain_support']);

	if (isset($_SESSION['edit_ID']))

        unset($_SESSION['edit_ID']);

	if (isset($_SESSION['user_name']))

        unset($_SESSION['user_name']);

	if (isset($_SESSION['user_has_domain']))

        unset($_SESSION['user_has_domain']);

	if (isset($_SESSION['layout_id']))

        unset($_SESSION['layout_id']);

	if (isset($_SESSION['user_page_message']))

        unset($_SESSION['user_page_message']);

	if (isset($_SESSION['dmn_name']))

        unset($_SESSION['dmn_name']);

	if (isset($_SESSION['local_data']))

        unset($_SESSION['local_data']);

	if (isset($_SESSION['rau3_added']))

        unset($_SESSION['rau3_added']);

	if (isset($_SESSION['chtpl']))

        unset($_SESSION['chtpl']);

	if (isset($_SESSION['step_one']))

        unset($_SESSION['step_one']);

	if (isset($_SESSION['dmn_tpl']))

        unset($_SESSION['dmn_tpl']);

	if (isset($_SESSION['logged_from']))

        unset($_SESSION['logged_from']);

	if (isset($_SESSION['logged_from_id']))

        unset($_SESSION['logged_from_id']);

	if (isset($_SESSION['ddel']))

        unset($_SESSION['ddel']);

	if (isset($_SESSION['user_def_lang']))

        unset($_SESSION['user_def_lang']);

	if (isset($_SESSION['alias_support']))

        unset($_SESSION['alias_support']);



// globals

	if (isset($GLOBALS['user_logged']))

        unset($GLOBALS['user_logged']);

	if (isset($GLOBALS['user_def_lang']))

        unset($GLOBALS['user_def_lang']);

	if (isset($GLOBALS['user_type']))

        unset($GLOBALS['user_type']);

	if (isset($GLOBALS['user_id']))

        unset($GLOBALS['user_id']);

	if (isset($GLOBALS['user_created_by']))

        unset($GLOBALS['user_created_by']);

	if (isset($GLOBALS['user_login_time']))

        unset($GLOBALS['user_login_time']);

	if (isset($GLOBALS['user_theme_color']))

        unset($GLOBALS['user_theme_color']);

	if (isset($GLOBALS['layout_id']))

        unset($GLOBALS['layout_id']);

	if (isset($GLOBALS['email_support']))

        unset($GLOBALS['email_support']);

	if (isset($GLOBALS['subdomain_support']))

        unset($GLOBALS['subdomain_support']);

	if (isset($GLOBALS['sql_support']))

        unset($GLOBALS['sql_support']);

	if (isset($GLOBALS['user_page_message']))

        unset($GLOBALS['user_page_message']);

	if (isset($GLOBALS['ch_hpprops']))

        unset($GLOBALS['ch_hpprops']);

	if (isset($_SESSION['ch_hpprops']))

        unset($_SESSION['ch_hpprops']);

	if (isset($GLOBALS['dmn_name']))

        unset($GLOBALS['dmn_name']);

	if (isset($GLOBALS['local_data']))

        unset($GLOBALS['local_data']);

	if (isset($GLOBALS['rau3_added']))

        unset($GLOBALS['rau3_added']);

	if (isset($GLOBALS['dmn_tpl']))

        unset($GLOBALS['dmn_tpl']);

	if (isset($GLOBALS['chtpl']))

        unset($GLOBALS['chtpl']);

	if (isset($GLOBALS['step_one']))

        unset($GLOBALS['step_one']);

	if (isset($GLOBALS['logged_from']))

        unset($GLOBALS['logged_from']);

	if (isset($GLOBALS['logged_from_id']))

        unset($GLOBALS['logged_from_id']);

	if (isset($GLOBALS['ddel']))

        unset($GLOBALS['ddel']);

	if (isset($GLOBALS['alias_support']))

        unset($GLOBALS['alias_support']);


    $_SESSION['user_def_lang'] = $cfg['USER_INITIAL_LANG'];
}

?>
