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



session_start();

//error_reporting(0); 
error_reporting(E_ALL); // setting for development edition - see all error messages

$include_path = '/var/www/vhcs2/gui/include/';

include ($include_path.'spGzip.php'); 

include ($include_path.'class.pTemplate.php');

include ($include_path.'vhcs2-db-keys.php');

include ($include_path.'vhcs-config.php');

$cfg_obj = new Config("/etc/vhcs2/vhcs2.conf");

if ($cfg_obj->status == "err") {

    /* cannot open vhcs.conf file - we must show warning */

    print "<center><b><font color=red>Can not open the vhcs2.conf config file !<br><br>Pleas contact your system administrator</font></b></center>";

    die();

}

$cfg = $cfg_obj->getValues();

$cfg['DB_TYPE'] = $cfg['DATABASE_TYPE'];
$cfg['DB_HOST'] = $cfg['DATABASE_HOST'];
$cfg['DB_USER'] = $cfg['DATABASE_USER'];

$cfg['DB_PASS'] = '';

if ($cfg['DATABASE_PASSWORD'] != '') {
    /* decrypt database password */
    $cfg['DB_PASS'] = decrypt_db_password($cfg['DATABASE_PASSWORD']);
}

$cfg['DB_NAME'] = $cfg['DATABASE_NAME'];

$cfg['SESSION_TIMEOUT'] = 300*60;

$cfg['ITEM_ADD_STATUS'] = 'toadd';

$cfg['ITEM_OK_STATUS'] = 'ok';

$cfg['ITEM_CHANGE_STATUS'] = 'change';

$cfg['ITEM_DELETE_STATUS'] = 'delete';

$cfg['ITEM_DISABLED_STATUS'] = 'disabled';

$cfg['ITEM_RESTORE_STATUS'] = 'restore';

$cfg['ITEM_TOENABLE_STATUS'] = 'toenable';

$cfg['ITEM_TODISABLED_STATUS'] = 'todisable';

$cfg['MAX_SQL_DATABASE_LENGTH'] = 64;

$cfg['MAX_SQL_USER_LENGTH'] = 16;

$cfg['MAX_SQL_PASS_LENGTH'] = 16;

$cfg['ROOT_TEMPLATE_PATH'] = 'themes/';

$cfg['LOGIN_TEMPLATE_PATH'] = $cfg['ROOT_TEMPLATE_PATH'].$cfg['USER_INITIAL_THEME'];

$cfg['ADMIN_TEMPLATE_PATH'] = "../".$cfg['ROOT_TEMPLATE_PATH'].$cfg['USER_INITIAL_THEME'].'/admin';

$cfg['RESELLER_TEMPLATE_PATH'] = "../".$cfg['ROOT_TEMPLATE_PATH'].$cfg['USER_INITIAL_THEME'].'/reseller';

$cfg['CLIENT_TEMPLATE_PATH'] = "../".$cfg['ROOT_TEMPLATE_PATH'].$cfg['USER_INITIAL_THEME'].'/client';

$cfg['IPS_LOGO_PATH'] = "../themes/user_logos";

$cfg['PURCHASE_TEMPLATE_PATH'] = "../".$cfg['ROOT_TEMPLATE_PATH'].$cfg['USER_INITIAL_THEME'].'/orderpanel';

$cfg['DOMAIN_ROWS_PER_PAGE'] = 10;

$cfg['HOSTING_PLANS_LEVEL'] = 'reseller'; 
/*
'reseller' => hosting plans are available only in reseller level
'admin' => hosting plans are available only in admin level, reseller can not make custom changes
'both' => hp are in admin and reseller level
*/

$cfg['VHCS_LICENSE'] = 'VHCS<sup>&reg;</sup> Pro v2.4.6.2<br>build: 2005-08-20<br>Spartacus';

// variable for developmetn edition => shows all php variables under the pages
//$cfg['DUMP_GUI_DEBUG'] = '_on_'; 

include ($include_path.'debug.php');

include ($include_path.'i18n.php');

include ($include_path.'system-message.php');

include ($include_path.'sql.php');

include ($include_path.'system-log.php');

include ($include_path.'calc-functions.php');

include ($include_path.'login.php');

include ($include_path.'date-functions.php');

include ($include_path.'layout-functions.php');

include ($include_path.'client-functions.php');

include ($include_path.'admin-functions.php');

include ($include_path.'reseller-functions.php');

include ($include_path.'vhcs-2-0.php');

include ($include_path.'idna.php');
?>
