<?php

/************************************************************************
UebiMiau is a GPL'ed software developed by 

 - Aldoir Ventura - aldoir@users.sourceforge.net
 - http://uebimiau.sourceforge.net

Fell free to contact, send donations or anything to me :-)
São Paulo - Brasil
*************************************************************************/

require("./inc/inc.php");

if(is_array($sess["headers"]) && file_exists($userfolder)) {

	$inboxdir = $userfolder."inbox/";
	$d = dir($userfolder."_attachments/");
	while($entry=$d->read()) {
		if($entry != "." && $entry != "..") 
			unlink($userfolder."_attachments/$entry");
	}
	$d->close();

	if(is_array($sess["folders"])) {
		$boxes = $sess["folders"];
		for($n=0;$n<count($boxes);$n++) {
			$entry = $boxes[$n]["name"];
			$file_list = Array();
			if(is_array($curfolder = $sess["headers"][base64_encode(strtolower($entry))])) {
				if(in_array(strtolower($entry),$UM->_system_folders))
					$entry = strtolower($entry);
				for($j=0;$j<count($curfolder);$j++) {
					$file_list[] = $curfolder[$j]["localname"];
				}

				$d = dir($userfolder."$entry/");
				while($curfile=$d->read()) {
					if($curfile != "." && $curfile != "..") {
						$curfile = $userfolder."$entry/$curfile";
						if(!in_array($curfile,$file_list)) {
							unlink($curfile);
						}
					}
				}
				$d->close();
			}
		}
	}

	if($prefs["empty-trash"]) {
		$trash = "trash";
		if(!is_array($sess["headers"][base64_encode($trash)])) {
			$sess["headers"][base64_encode($trash)] = $UM->mail_list_msgs($trash);
		}
		$trash = $sess["headers"][base64_encode($trash)];
		if(count($trash) > 0) {

			if(!$UM->mail_connect()) { Header("Location: error.php?err=1&sid=$sid&tid=$tid&lid=$lid\r\n"); exit; }
			if(!$UM->mail_auth()) { Header("Location: badlogin.php?sid=$sid&tid=$tid&lid=$lid\r\n"); exit; }

			for($j=0;$j<count($trash);$j++) {
				$UM->mail_delete_msg($trash[$j],false);
			}
			$UM->mail_expunge();
			$UM->mail_disconnect();
		}
	}
	$SS->Kill();
}


header("Location: ./index.php\r\n");
?> 