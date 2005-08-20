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

unset_user_login_data();


if (isset($_SESSION['user_theme_color'])) {

    global $cfg;
$theme_color = $cfg['USER_INITIAL_THEME'];

} else {

    $theme_color = $cfg['USER_INITIAL_THEME_COLOR'];

}

$tpl = new pTemplate();

$tpl -> define('page', $cfg['LOGIN_TEMPLATE_PATH'].'/index.tpl');

$tpl -> assign(
                array(
                        'TR_MAIN_INDEX_PAGE_TITLE' => tr('VHCS - Virtual Hosting Control System'),
                        'THEME_COLOR_PATH' => "themes/$theme_color",
                        'THEME_CHARSET' => tr('encoding'),
                        'TC_BLUE_SELECTED' => $theme_color === 'blue' ? 'selected' : '',
                        'TC_GREEN_SELECTED' => $theme_color === 'green' ? 'selected' : '',
                        'TC_YELLOW_SELECTED' => $theme_color === 'yellow' ? 'selected' : '',
                        'TC_RED_SELECTED' => $theme_color === 'red' ? 'selected' : '',
                        'TR_LOGIN' => tr('Login'),
                        'TR_USERNAME' => tr('Username'),
                        'TR_PASSWORD' => tr('Password'),
                        'TR_THEME_COLOR' => tr('Theme color'),
                        'TR_BLUE' => tr('Blue'),
                        'TR_GREEN' => tr('Green'),
                        'TR_YELLOW' => tr('Yellow'),
                        'TR_RED' => tr('Red'),
						'TR_TIME' => date("g:i a"),
						'TR_DATE' => date("l dS of F Y"),
                        'TR_VHCS_LICENSE' => $cfg['VHCS_LICENSE']
                     )
              );

$tpl -> parse('PAGE', 'page');

$tpl -> prnt();

if (isset($cfg['DUMP_GUI_DEBUG'])) dump_gui_debug();

?>
