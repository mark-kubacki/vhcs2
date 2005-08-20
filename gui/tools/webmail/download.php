<?php
/************************************************************************
UebiMiau is a GPL'ed software developed by 

 - Aldoir Ventura - aldoir@users.sourceforge.net
 - http://uebimiau.sourceforge.net

Fell free to contact, send donations or anything to me :-)
São Paulo - Brasil
*************************************************************************/


// load session management
require("./inc/inc.php");
// check for all parameters


if(	$part == "" || 
	$folder == "" || 
	$ix == "") Header("Location: error.php?err=3&sid=$sid&tid=$tid&lid=$lid");

$mail_info = $sess["headers"][base64_encode(strtolower($folder))][$ix];
$localname = $mail_info["localname"];
// check if the file exists, otherwise, do a error

if(ereg("\\.\\.",$filename)) { Header("Location: error.php?err=3&sid=$sid&tid=$tid&lid=$lid"); exit; }
$filename 		= $userfolder."_attachments/".md5(base64_decode($bound))."_".$filename;
if (!file_exists($localname)) { Header("Location: error.php?err=3&sid=$sid&tid=$tid&lid=$lid"); exit; }

if($cache) {
	if (!file_exists($filename)) { Header("Location: error.php?err=3&sid=$sid&tid=$tid&lid=$lid"); exit; }
	clearstatcache();
	$fp = fopen($filename,"rb");
	$email = fread($fp,filesize($filename));
	fclose($fp);
	echo($email);
	exit;
}


// read the email
$email = $UM->_read_file($localname);
// start a new mime decode class
// split the mail, body and headers
$email = $UM->fetch_structure($email);

$header = $email["header"];
$body = $email["body"];

// check if file will be downloaded
$isdown = (isset($down))?1:0;
// get the attachment
$UM->download_attach($header,$body,base64_decode($bound),$part,$isdown);
unset($UM);
?>