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



function system_message($msg) {

    global $cfg;


    $theme_color = $cfg['USER_INITIAL_THEME_COLOR'];


    $tpl = new pTemplate();
/*
    if (preg_match("/(admin|client|reseller)/", $_SERVER['PHP_SELF'], $matches)) {

        $tpl_path = "../".$cfg['ROOT_TEMPLATE_PATH'];

    } else {

        $tpl_path = $cfg['ROOT_TEMPLATE_PATH'];

    }
*/
	$tpl_path = "../".$cfg['ROOT_TEMPLATE_PATH'].$cfg['USER_INITIAL_THEME'];
	$tpl -> define_dynamic('page', $tpl_path.'/system-message.tpl');

    
    $tpl -> assign(
                    array(
                            'TR_SYSTEM_MESSAGE_PAGE_TITLE' => 'VHCS Error',
                            'THEME_COLOR_PATH' => "themes/$theme_color",
                            'THEME_CHARSET' => tr('encoding'),

                            'TR_ERROR_MESSAGE' => 'Error Message',
							'TR_VHCS_LICENSE' => $cfg['VHCS_LICENSE'],
							'TR_TIME' => date("g:i a"),
							'TR_DATE' => date("l dS of F Y"),
                            'MESSAGE' => $msg
                         )
                  );
    
    $tpl -> parse('PAGE', 'page');
    
    $tpl -> prnt();


    exit(0);

}
?>
