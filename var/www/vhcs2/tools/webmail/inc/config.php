<?
/************************************************************************
UebiMiau is a GPL'ed software developed by 

 - Aldoir Ventura - aldoir@users.sourceforge.net
 - http://uebimiau.sourceforge.net

Fell free to contact, send donations or anything to me :-)
S�o Paulo - Brasil
*************************************************************************/

########################################################################
#Defaults:
#1 - Yes/On/True
#0 - No/Off/False
# do not remove or change this

define("yes",1);
define("no",0);

$themes 	= Array();
$languages 	= Array();

########################################################################
# _ Please attention _:
# The temporary files will be stored on this folder
# For security reasons, do not use web-shared folders

# ** The Web Server needs write-permission on this folder

# * Unix/Linux users use.
# /tmp/uebimiau
# * Win32 users
# c:/winnt/temp/uebimiau

# NEVER use backslashes (\). Always use forward slashes (/),
# for all operating systems, INCLUDING Windows
########################################################################

$temporary_directory = "./database/";

########################################################################
# Your local SMTP Server (alias or IP) such as "smtp.yourdomain.com"
# eg. "server1;server2;server3"   -> specify main and backup server
########################################################################

$smtp_server = "localhost";  #YOU NEED CHANGE IT !!


########################################################################
# Protocol and port
# Choose "imap" as protocol to use the Internet Mail Access Protocol, 
# or "pop3" to use the Post Office Protocol.
# The default ports are:
# pop3 -> 110
# imap -> 143
# The imap is more fast, but all functions of UebiMiau works with POP3
########################################################################

$mail_protocol 	= "pop3";
$mail_port		= 110;

########################################################################
# The TIME ZONE of server, format (+|-)HHMM (H=hours, M=minutes), eg. +0100
########################################################################
$server_time_zone = "-0000";


########################################################################
# The maximum size for stored files
# In order to keep you system fast, use values better than 5MB
# If you need disable it, set the value to 0 or leave it blank
########################################################################
$quota_limit = 4096;  //  in KB, eg. 4096 Kb = 4MB


########################################################################
# Use SMTP password (AUTH LOGIN type)
########################################################################
$use_password_for_smtp	= no;

########################################################################
# Redirect new users to the preferences page at first login
########################################################################
$check_first_login		= yes;

########################################################################
# Enable visualization of HTML messages
# *This option afect only incoming messages, the  HTML editor
# for new messages (compose page) is automatically activated 
# when the client's browser support it (IE5 or higher)
########################################################################

$allow_html 			= yes;

########################################################################
# FILTER javascript (and others scripts) from incoming messages
########################################################################
$allow_scripts			= no;

########################################################################
# Turn this option to 'yes' if you want allow users send messages using
# they 'Reply to' preference's option as your 'From' header, otherwise 
# the From field will be the email wich the users log in
########################################################################
$allow_modified_from	= yes;


########################################################################
# Server type:
# allowed values:

# "DETECT" -------->	Guess the pop3 server. If you are running UM
# 					in a domain "www.company.com", the script will 
#					use "PREFIX.company.com" as your server. you 
#					can set the "PREFIX" in the var $mail_detect_prefix.
#					Also, the var $mail_detect_remove can be set
#					to "www.", then the script get rid the "www" and 
#					put the prefix, eg. pop3.company.com.br

#"ONE-FOR-EACH" -->	Each domain have your own mail server.
#					The script will load the list of domains/servers from
#					var $mail_servers.

#"ONE-FOR-ALL" --->	If you use this option, your users must supply the
#					full email address as username. You can set the mail
#					server in the var $default_mail_server
#					

# LOGIN_TYPE

# Note. You can supply the LOGIN_TYPE according to your MAIL SERVER.
# Eg. If your mail server requires usernames in user@domain.com, you must
# specify the LOGIN_TYPE as "%user%@%domain%". You can combine it according to 
# your server. eg.

# %user%
# %user%@%domain%
# %user%.%domain%

########################################################################

$mail_server_type 	= "ONE-FOR-ALL";

########################################################################
# TYPE: DETECT
########################################################################

$mail_detect_remove 	= "www.";
$mail_detect_prefix 	= "mail.";
$mail_detect_login_type = "%user%@%domain%";

########################################################################
# TYPE: ONE-FOR-EACH
# Each domain have your own mail server
########################################################################
/*
$mail_servers[] = Array(
	"domain" => "domain.com", 
	"server" => "domain.com", 
	"login_type" => "%user%@%domain%"
);


$mail_servers[] = Array(
	"domain" => "your-2nd-domain.com", 
	"server" => "mail.your-2nd-domain.com", 
	"login_type" => "%user%@%domain%" 
);
*/

/*
$mail_servers[] = Array(
	"domain" => "your-Nth-domain.com", 
	"server" => "mail.Nth-domain.com", 
	"login_type" => "%user%@%domain%"
);
*/

########################################################################
# TYPE: ONE-FOR-ALL
# the default mail server for all domains
########################################################################

$default_mail_server 	= "127.0.0.1";
$one_for_all_login_type	= "%user%@%domain%";

########################################################################
# Language & themes settings
########################################################################

require("./inc/config.languages.php");

########################################################################
# Support for SendMail (DEFAULT DISABLED (using SMTP))
# Only for *nix Systems (NOT Win32)
########################################################################
$use_sendmail     = no;
$path_to_sendmail = "/usr/sbin/sendmail";


########################################################################
# In some POP3 servers, if you send a "RETR" command, your
# message will be automatically deleted :(
# This option prevents this inconvenience
########################################################################

$mail_use_top = yes;

########################################################################
# Name and Version, it's used in many places, like as
# "X-Mailer" field, footer
########################################################################

$appversion = "2.7.2";
$appname = "UebiMiau";


########################################################################
# Add a "footer" to sent mails
########################################################################

$footer = "

________________________________________________
VHCS Webmail
";

########################################################################
# Enable debug :)
# no - disabled
# 1 or yes -> enabled with full results
# 2 -> enable with servers communications only
# ********************************************************/
$enable_debug = no;

########################################################################
# Block external images.
# If an HTML message have external images, it will be 
# blocked. This feature prevent spam tracking
########################################################################

$block_external_images = no;

########################################################################
# Session timeout for inactivity
########################################################################

$idle_timeout = 10; //minutes

########################################################################
# Order setting
########################################################################

$default_sortby = "date";
$default_sortorder = "DESC";

########################################################################
# Default preferences...
########################################################################

$default_preferences = Array(
	"send_to_trash_default" 	=> yes,		# send deleted messages to trash
	"st_only_ready_default" 	=> yes,		# only read messages, otherwise, delete it
	"save_to_sent_default"		=> yes,		# send sent messages to sent
	"empty_trash_default"		=> yes,		# empty trash on logout
	"sortby_default"			=> "date",	# alowed: "attach","subject","fromname","date","size"
	"sortorder_default"			=> "DESC",	# alowed: "ASC","DESC"
	"rpp_default"				=> 10,		# records per page (messages), alowed: 10,20,30,40,50,100,200
	"add_signature_default"		=> no,		# add the signature by default
	"signature_default"			=> "",		# a default signature for all users, use text only, with multiple lines if needed
	"timezone_default"			=> "+0000",	# timezone, format (+|-)HHMM (H=hours, M=minutes)
	"display_images_deafult"	=> yes,		# automatically show attached images in the body of message
	"editor_mode_default"		=> "html",	# use "html" or "text" to set default editor. "html" will be used only in IE5+ browsers
	"refresh_time_default"		=> 10		# after this time, the message list will be refreshed, in minutes
						);
?>