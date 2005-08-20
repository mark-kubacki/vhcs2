<?
/************************************************************************
UebiMiau is a GPL'ed software developed by 

 - Aldoir Ventura - aldoir@users.sourceforge.net
 - http://uebimiau.sourceforge.net

Fell free to contact, send donations or anything to me :-)
São Paulo - Brasil
*************************************************************************/

@set_time_limit(0);
error_reporting (E_ALL ^E_NOTICE); 

require("./inc/config.php");
require("./inc/class.uebimiau.php");
require("./inc/lib.php");

if(empty($sid)) $sid = strtoupper("{".uniqid("")."-".uniqid("")."-".time()."}");

define("SMARTY_DIR","./smarty/");
require_once(SMARTY_DIR."Smarty.class.php");
$smarty = new Smarty;
$smarty->compile_dir = $temporary_directory;
$smarty->security=true;
$smarty->secure_dir=array("./");

//$smarty->debugging = false;
$smarty->assign("umLanguageFile",$selected_language.".txt");

$SS = New Session();
$SS->temp_folder = $temporary_directory;
$SS->sid = $sid;


$sess = $SS->Load();



$start = ($sess["start"] == "")?time():$sess["start"];

$UM = new UebiMiau();

if(strlen($f_pass) > 0) {

	switch(strtoupper($mail_server_type)) {

	case "DETECT":
		$f_server = strtolower(getenv("HTTP_HOST"));
		$f_server = str_replace($mail_detect_remove,"",$f_server);
		$f_server = $mail_detect_prefix.$f_server;
		if(ereg("(.*)@(.*)",$f_email,$regs)) {
			$f_user = $regs[1];
			$domain = $regs[2];
			if($mail_detect_login_type != "") $f_user = eregi_replace("%user%",$f_user,eregi_replace("%domain%",$domain,$mail_detect_login_type));
		}
		break;

	case "ONE-FOR-EACH": 
		$domain = $mail_servers[$six]["domain"];
		$f_email = $f_user."@".$domain;
		$f_server = $mail_servers[$six]["server"];
		$login_type = $mail_servers[$six]["login_type"];
		if($login_type != "") $f_user = eregi_replace("%user%",$f_user,eregi_replace("%domain%",$domain,$login_type));
		break;

	case "ONE-FOR-ALL": 
		if(ereg("(.*)@(.*)",$f_email,$regs)) {
			$f_user = $regs[1];
			$domain = $regs[2];
			if($one_for_all_login_type != "") $f_user = eregi_replace("%user%",$f_user,eregi_replace("%domain%",$domain,$one_for_all_login_type));
		}
		$f_server = $default_mail_server;
		break;
	}

	$UM->mail_email 	= $sess["email"]  = stripslashes($f_email);
	$UM->mail_user 		= $sess["user"]   = stripslashes($f_user);
	$UM->mail_pass 		= $sess["pass"]   = stripslashes($f_pass); 
	$UM->mail_server 	= $sess["server"] = stripslashes($f_server); 

	$sess["start"] = time();

	$refr = 1;

} elseif (
	($sess["auth"] && intval((time()-$start)/60) < $idle_timeout)) {

	$UM->mail_user   = $f_user    = $sess["user"];
	$UM->mail_pass   = $f_pass    = $sess["pass"];
	$UM->mail_server = $f_server  = $sess["server"];
	$UM->mail_email  = $f_email   = $sess["email"];

} else {
	Header("Location: ./index.php?tid=$tid&lid=$lid\r\n"); 
	exit; 
}
$sess["start"] = time();

$SS->Save($sess);

$userfolder = $temporary_directory.ereg_replace("[^a-z0-9\._-]","_",strtolower($f_user))."_".strtolower($f_server)."/";

$UM->mail_port 			= $mail_port;
$UM->debug				= $enable_debug;
$UM->use_html			= $allow_html;
$UM->mail_protocol		= $mail_protocol;

$UM->user_folder 		= $userfolder;
$UM->temp_folder		= $temporary_directory;
$UM->timeout			= $idle_timeout;


$prefs = load_prefs();

$UM->timezone			= $prefs["timezone"];
$UM->charset			= $default_char_set;


/*
Don't remove the fallowing lines, or you will be problems with browser's cache 
*/
Header("Expires: Wed, 11 Nov 1998 11:11:11 GMT\r\n".
"Cache-Control: no-cache\r\n".
"Cache-Control: must-revalidate\r\n".
"Pragma: no-cache");

$nocache = "
<META HTTP-EQUIV=\"Cache-Control\" CONTENT=\"no-cache\">
<META HTTP-EQUIV=\"Expires\" CONTENT=\"-1\">
<META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">";
// Sort rules


if(!ereg("(subject|fromname|date|size)",$sortby)) {
	$sortby = $prefs["sort-by"];
	if(!ereg("(subject|fromname|date|size)",$sortby))
		$sortby = $default_sortby;
} else {
	$need_save = true;
	$prefs["sort-by"] = $sortby;
}

if(!ereg("ASC|DESC",$sortorder)) {
	$sortorder = $prefs["sort-order"];
	if(!ereg("ASC|DESC",$sortorder))
		$sortorder = $default_sortorder;
} else {
	$need_save = true;
	$prefs["sort-order"] = $sortorder;
}

if($need_save) save_prefs($prefs);

if($folder == "" || strpos($folder,"..") !== false ) 
	$folder = "inbox";
elseif (!file_exists($userfolder.$folder)) { 
	Header("Location: ./logout.php?sid=$sid&tid=$tid&lid=$lid"); 
	exit; 
}

?>
