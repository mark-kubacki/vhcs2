<?php

/************************************************************************
UebiMiau is a GPL'ed software developed by 

 - Aldoir Ventura - aldoir@users.sourceforge.net
 - http://uebimiau.sourceforge.net

Fell free to contact, send donations or anything to me :-)
S�o Paulo - Brasil
*************************************************************************/

require("./inc/inc.php");

echo($nocache);

if($tipo == "send") {

	require("./inc/class.smtp.php");

	$ARTo = $UM->get_names(stripslashes($to));
	$ARCc = $UM->get_names(stripslashes($cc));
	$ARBcc = $UM->get_names(stripslashes($bcc));

	if((count($ARTo)+count($ARCc)+count($ARBcc)) > 0) {
		$mail = new phpmailer;
		// for password authenticated servers

		if($use_password_for_smtp) {
			$mail->UseAuthLogin($sess["user"],$sess["pass"]);
		}
		// if using the advanced editor

		if($is_html == "true")  {
			$mail->IsHTML(1);
			if($footer != "") $body .= preg_replace("/(\r\n|\n|\r)/","<BR />\\1",$footer);

		} elseif ($footer != "") $body .= $footer;

		$mail->CharSet		= $default_char_set;
		$mail->IPAddress	= getenv("REMOTE_ADDR");
		$mail->timezone		= $server_time_zone;
		$mail->From 		= ($allow_modified_from && !empty($prefs["reply-to"]))?$prefs["reply-to"]:$sess["email"];
		$mail->FromName 	= $UM->mime_encode_headers($prefs["real-name"]);
		$mail->AddReplyTo($prefs["reply-to"], $UM->mime_encode_headers($prefs["real-name"]));
		$mail->Host 		= $smtp_server;
		$mail->WordWrap 	= 76;
		$mail->Priority		= $priority;

		if(count($ARTo) != 0) {
			for($i=0;$i<count($ARTo);$i++) {
				$name = $ARTo[$i]["name"];
				$email = $ARTo[$i]["mail"];
				if($name != $email)
					$mail->AddAddress($email,$UM->mime_encode_headers($name));
				else
					$mail->AddAddress($email);
			}
		}

		if(count($ARCc) != 0) {
			for($i=0;$i<count($ARCc);$i++) {
				$name = $ARCc[$i]["name"];
				$email = $ARCc[$i]["mail"];
				if($name != $email)
					$mail->AddCC($email,$UM->mime_encode_headers($name));
				else
					$mail->AddCC($email);
			}
		}

		if(count($ARBcc) != 0) {
			for($i=0;$i<count($ARBcc);$i++) {
				$name = $ARBcc[$i]["name"];
				$email = $ARBcc[$i]["mail"];
				if($name != $email)
					$mail->AddBCC($email,$UM->mime_encode_headers($name));
				else
					$mail->AddBCC($email);
			}
		}

		if(is_array($attachs = $sess["attachments"])) {
			for($i=0;$i<count($attachs);$i++) {
				if(file_exists($attachs[$i]["localname"])) {
					$mail->AddAttachment($attachs[$i]["localname"], $attachs[$i]["name"], $attachs[$i]["type"]);
				}
			}
		}

		$mail->Subject = $UM->mime_encode_headers(stripslashes($subject));
		$mail->Body = stripslashes($body);


		if(($resultmail = $mail->Send()) === false) {

			$err = $mail->ErrorAlerts[count($mail->ErrorAlerts)-1];
			$smarty->assign("umMailSent",false);
			$smarty->assign("umErrorMessage",$err);

		} else {
			$smarty->assign("umMailSent",true);

			if(is_array($attachs = $sess["attachments"])) {
				for($i=0;$i<count($attachs);$i++) {
					if(file_exists($attachs[$i]["localname"])) {
						@unlink($attachs[$i]["localname"]);
					}
				}
				
				unset($sess["attachments"]);
				reset($sess);
				$SS->Save($sess);
			}

			if($prefs["save-to-sent"]) {
				if(!$UM->mail_connect()) { Header("Location: error.php?err=1&sid=$sid&tid=$tid&lid=$lid\r\n"); exit; }
				if(!$UM->mail_auth(false)) { Header("Location: badlogin.php?sid=$sid&tid=$tid&lid=$lid\r\n"); exit; }
				$UM->mail_save_message("sent",$resultmail,"\\SEEN");
				unset($sess["headers"][base64_encode("sent")]);
				$UM->mail_disconnect();
				$SS->Save($sess);
			}

		}

	} else die("<script language=\"javascript\">location = 'error.php?err=3&sid=$sid&tid=$tid&lid=$lid';</script>");

	$jssource = "
	<script language=\"javascript\">
	function newmsg() { location = 'newmsg.php?pag=$pag&folder=".urlencode($folder)."&sid=$sid&tid=$tid&lid=$lid'; }
	function folderlist() { location = 'folders.php?folder=".urlencode($folder)."&sid=$sid&tid=$tid&lid=$lid'}
	function goend() { location = 'logout.php?sid=$sid&tid=$tid&lid=$lid'; }
	function goinbox() { location = 'msglist.php?folder=inbox&sid=$sid&tid=$tid&lid=$lid'; }
	function emptytrash() {	location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true&sid=$sid&tid=$tid&lid=$lid';}
	function search() {	location = 'search.php?folder=".urlencode($folder)."&sid=$sid&tid=$tid&lid=$lid';}
	function addresses() { location = 'addressbook.php?sid=$sid&tid=$tid&lid=$lid'; }
	function prefs() { location = 'preferences.php?sid=$sid&tid=$tid&lid=$lid'; }
	</script>
	";

	$smarty->assign("umSid",$sid);
	$smarty->assign("umLid",$lid);
	$smarty->assign("umTid",$tid);
	$smarty->assign("umJS",$jssource);

	$smarty->display("$selected_theme/newmsg-result.htm");

}else {

	$priority_level = (!$priority)?3:$priority;

	$uagent = $HTTP_SERVER_VARS["HTTP_USER_AGENT"];
	$isMac = ereg("Mac",$uagent);
	$isOpera = ereg("Opera",$uagent);

	$uagent = explode("; ",$uagent);
	$uagent = explode(" ",$uagent[1]);
	$bname = strtoupper($uagent[0]);
	$bvers = $uagent[1];
	$show_advanced = (($bname == "MSIE") && (intval($bvers) >= 5) && (!$textmode) && (!$isMac) && (!$isOpera) && ($prefs["editor-mode"] != "text"))?1:0;

	//$show_advanced = 0;

	$js_advanced = ($show_advanced)?"true":"false";

	$signature = $prefs["signature"];
	if($show_advanced) $signature = nl2br($signature);

	$add_sig = $prefs["add-sig"];
	
	$umAddSig = ($add_sig)?1:0;

	$forms = "<input type=hidden name=tipo value=edit>
	<input type=hidden name=is_html value=\"$js_advanced\">
	<input type=hidden name=sid value=\"$sid\">
	<input type=hidden name=lid value=\"$lid\">
	<input type=hidden name=tid value=\"$tid\">
	<input type=hidden name=folder value=\"$folder\">
	<input type=hidden name=sig value=\"".htmlspecialchars($signature)."\">
	<input type=hidden name=textmode value=\"$textmode\">
	";



	$jssource = "
	<script language=\"javascript\">
	bIs_html = $js_advanced;
	bsig_added = false;
	function addsig() {
		with(document.composeForm) {
			if(bsig_added || sig.value == '') return false;
			if(cksig.checked) {
				if(bIs_html) {
					cur = GetHtml()
					SetHtml(cur+'<br><br>--<br>'+sig.value);
				} else
					body.value += '\\r\\n\\r\\n--\\r\\n'+sig.value;
			}
			cksig.disabled = true;
			bsig_added = true;
		}
		return true;
	}

	function upwin(rem) { 
		mywin = 'upload.php';
		if (rem != null) mywin += '?rem='+rem+'&sid=$sid';
		else mywin += '?sid=$sid&tid=$tid&lid=$lid';
		window.open(mywin,'Upload','width=300,height=50,scrollbars=0,menubar=0,status=0'); 
	}

	function doupload() {
		if(bIs_html) document.composeForm.body.value = GetHtml();
		document.composeForm.tipo.value = 'edit';
		document.composeForm.submit();
	}
	function textmode() {
		with(document.composeForm) {
			if(bIs_html) body.value = GetText();
			textmode.value = 1;
			tipo.value = 'edit';
			submit();
		}
	}

	function enviar() {
		error_msg = new Array();
		frm = document.composeForm;
		check_mail(frm.to.value);
		check_mail(frm.cc.value);
		check_mail(frm.bcc.value);
		errors = error_msg.length;

		if(frm.to.value == '' && frm.cc.value == '' && frm.bcc.value == '')
			alert('".ereg_replace("'","\\'",$error_no_recipients)."');

		else if (errors > 0) {

			if (errors == 1) errmsg = '".ereg_replace("'","\\'",$error_compose_invalid_mail1_s)."\\r\\r';
			else  errmsg = '".ereg_replace("'","\\'",$error_compose_invalid_mail1_p)."\\r\\r';

			for(i=0;i<errors;i++)
				errmsg += error_msg[i]+'\\r';

			if (errors == 1) errmsg += '\\r".ereg_replace("'","\\'",$error_compose_invalid_mail2_s)."s';
			else  errmsg += '\\r".ereg_replace("'","\\'",$error_compose_invalid_mail2_p)."';

			alert(errmsg)
	
		} else {
			if(bIs_html) frm.body.value = GetHtml();
			frm.tipo.value = 'send';
			frm.submit();
		}
	}
	
	function newmsg() { location = 'newmsg.php?pag=$pag&folder=".urlencode($folder)."&sid=$sid&tid=$tid&lid=$lid'; }
	function folderlist() { location = 'folders.php?folder=".urlencode($folder)."&sid=$sid&tid=$tid&lid=$lid'}
	function goend() { location = 'logout.php?sid=$sid&tid=$tid&lid=$lid'; }
	function goinbox() { location = 'msglist.php?folder=inbox&sid=$sid&tid=$tid&lid=$lid'; }
	function emptytrash() {	location = 'folders.php?empty=trash&folder=".urlencode($folder)."&goback=true&sid=$sid&tid=$tid&lid=$lid';}
	function search() {	location = 'search.php?folder=".urlencode($folder)."&sid=$sid&tid=$tid&lid=$lid';}
	function addrpopup() {	mywin = window.open('quick_address.php?sid=$sid&tid=$tid&lid=$lid','AddressBook','width=480,height=220,top=200,left=200'); }
	function addresses() { location = 'addressbook.php?sid=$sid&tid=$tid&lid=$lid'; }
	function prefs() { location = 'preferences.php?sid=$sid&tid=$tid&lid=$lid'; }
	function AddAddress(strType,strAddress) {
		obj = eval('document.composeForm.'+strType);
		if(obj.value == '') obj.value = strAddress
		else  obj.value = obj.value + ', ' + strAddress
	}
	
	function check_mail(strmail) {
		if(strmail == '') return;
		chartosplit = ',;';
		protectchar = '\"';
		temp = '';
		armail = new Array();
		inthechar = false; 
		lt = '<';
		gt = '>'; 
		isclosed = true;
	
		for(i=0;i<strmail.length;i++) {
			thischar = strmail.charAt(i);
			if(thischar == lt && isclosed) isclosed = false;
			if(thischar == gt && !isclosed) isclosed = true;
			if(thischar == protectchar) inthechar = (inthechar)?0:1;
			if(chartosplit.indexOf(thischar) != -1 && !inthechar && isclosed) {
				armail[armail.length] = temp; temp = '';
			} else temp += thischar;
		}
	
		armail[armail.length] = temp; 
	
		for(i=0;i<armail.length;i++) {
			thismail = armail[i]; strPat = /(.*)<(.*)>/;
			matchArray = thismail.match(strPat); 
			if (matchArray != null) strEmail = matchArray[2];
			else {
				strPat = /([-a-zA-Z0-9_$+.]+@[-a-zA-Z0-9_.]+[-a-zA-Z0-9_]+)((.*))/; matchArray = thismail.match(strPat); 
				if (matchArray != null) strEmail = matchArray[1];
				else strEmail = thismail;
			}
			if(strEmail.charAt(0) == '\"' && strEmail.charAt(strEmail.length-1) == '\"') strEmail = strEmail.substring(1,strEmail.length-1)
			if(strEmail.charAt(0) == '<' && strEmail.charAt(strEmail.length-1) == '>') strEmail = strEmail.substring(1,strEmail.length-1)
	
			strPat = /([-a-zA-Z0-9_$+.]+@[-a-zA-Z0-9_.]+[-a-zA-Z0-9_]+)((.*))/;
			matchArray = strEmail.match(strPat); 
			if(matchArray == null)
				error_msg[error_msg.length] = strEmail;
		}
	}
	
	
	</script>
	";

	$smarty->assign("umPriority",$priority_level);
	$smarty->assign("umAddSignature",$umAddSig);
	$smarty->assign("umForms",$forms);
	$smarty->assign("umJS",$jssource);

	$body = stripslashes($body);


	if(isset($rtype)) {
		$mail_info = $sess["headers"][base64_encode(strtolower($folder))][$ix];

		if(!eregi("\\ANSWERED",$mail_info["flags"])) {

			if(!$UM->mail_connect()) { die("<script>location = 'error.php?err=1&sid=$sid&tid=$tid&lid=$lid'</script>"); }
			if(!$UM->mail_auth()) { die("<script>location = 'badlogin.php?sid=$sid&tid=$tid&lid=$lid'</script>"); }
			if($UM->mail_set_flag($mail_info,"\\ANSWERED","+")) {
				$sess["headers"][base64_encode(strtolower($folder))][$ix] = $mail_info;
				$SS->Save($sess);
			}
			$UM->mail_disconnect(); 

		}


		$filename = $mail_info["localname"];

		if(!file_exists($filename)) die("<script>location = 'msglist.php?err=2&folder=".urlencode($folder)."&pag=$pag&sid=$sid&tid=$tid&lid=$lid&refr=true';</script>");
		$result = $UM->_read_file($filename);
		
		$email = $UM->Decode($result);
		$result = $UM->fetch_structure($result);


		$tmpbody = $email["body"];
		$subject = $mail_info["subject"];

		$ARReplyTo = $email["reply-to"];
		$ARFrom = $email["from"];
		$useremail = $sess["email"];

		// from
		if($ARReplyTo[0]["mail"] != "") {
			$name = $ARReplyTo[0]["name"];
			$thismail = $ARReplyTo[0]["mail"];
		} else {
			$name = $ARFrom[0]["name"];
			$thismail = $ARFrom[0]["mail"];
		}
		$fromreply = "\"$name\" <$thismail>";

		// To
		$ARTo = $email["to"];

		for($i=0;$i<count($ARTo);$i++) {
			$name = $ARTo[$i]["name"]; $thismail = $ARTo[$i]["mail"];
			if(isset($toreply)) $toreply .= ", \"$name\" <$thismail>";
			else $toreply = "\"$name\" <$thismail>";
		}

		// CC
		$ARCC = $email["cc"];
		for($i=0;$i<count($ARCC);$i++) {
			$name = $ARCC[$i]["name"]; $thismail = $ARCC[$i]["mail"];
			if(isset($ccreply)) $ccreply .= ", \"$name\" <$thismail>";
			else $ccreply = "\"$name\" <$thismail>";
		}

		function clear_names($strMail) {
			global $UM;
			$strMail = $UM->get_names($strMail);
			for($i=0;$i<count($strMail);$i++) {
				$thismail = $strMail[$i];
				$thisline = ($thismail["mail"] != $thismail["name"])?"\"".$thismail["name"]."\""." <".$thismail["mail"].">":$thismail["mail"];
				if($thismail["mail"] != "" && strpos($result,$thismail["mail"]) === false) {
					if($result != "") $result .= ", ".$thisline;
					else $result = $thisline;
				}
			}
			return $result;
		}


		$allreply = clear_names($fromreply.", ".$toreply);
		$ccreply = clear_names($ccreply);
		$fromreply = clear_names($fromreply);

		$msgsubject = $email["subject"];

		$fromreply_quote 	= $fromreply;
		$toreply_quote		= $toreply;
		$ccreply_quote		= $ccreply;
		$msgsubject_quote	= $msgsubject;

		if($show_advanced) {
			$fromreply_quote 	= htmlspecialchars($fromreply_quote);
			$toreply_quote		= htmlspecialchars($toreply_quote);
			$ccreply_quote		= htmlspecialchars($ccreply_quote);
			$msgsubject_quote	= htmlspecialchars($msgsubject_quote);
			$linebreak			= "<br>";

		} else {
			$tmpbody			= strip_tags($tmpbody);
			$quote_string = "> ";
			$tmpbody = $quote_string.ereg_replace("\n","\n$quote_string",$tmpbody);
		}

$body = "
$reply_delimiter$linebreak
$reply_from_hea ".ereg_replace("(\")","",$fromreply_quote)."$linebreak
$reply_to_hea ".ereg_replace("(\")","",$toreply_quote);

if(!empty($ccreply)) {
	$body .= "$linebreak
$reply_cc_hea ".ereg_replace("(\")","",$ccreply_quote);
}


$body .= "$linebreak
$reply_subject_hea ".$msgsubject_quote."$linebreak
$reply_date_hea ".@strftime($date_format,$email["date"])."$linebreak
$linebreak
$tmpbody";


		if($show_advanced) {
			$body = "
<br>
<BLOCKQUOTE dir=ltr style=\"PADDING-RIGHT: 0px; PADDING-LEFT: 5px; MARGIN-LEFT: 5px; BORDER-LEFT: #000000 2px solid; MARGIN-RIGHT: 0px\">
  <DIV style=\"FONT: 10pt arial\">
  $body
  </DIV>
</BLOCKQUOTE>
";
		}

		switch($rtype) {
		case "reply":
			if(!eregi("^$reply_prefix",trim($subject))) $subject = "$reply_prefix $subject";
			$to = $fromreply;
			break;
		case "replyall":
			if(!eregi("^$reply_prefix",trim($subject))) $subject = "$reply_prefix $subject";
			$to = $allreply;
			$cc = $ccreply;
			break;
		case "forward":
			if(!eregi("^$forward_prefix",trim($subject))) $subject = "$forward_prefix $subject";

			if(count($email["attachments"]) > 0) {
				$bound = $email["attachments"][0]["boundary"];
				if($bound != "") {
					$parts = $UM->split_parts($bound,$result["body"]);
				} else {
					$parts[0] = $result["body"];
				}

				for($i = 0; $i < count($email["attachments"]); $i++) {

					$current = $email["attachments"][$i];

					$currentstruc = $UM->fetch_structure($parts[$current["part"]]);

					$tmpfilename 	= $userfolder."_attachments/".uniqid("").".tmp";
					$contenttype 	= ($current["content-type"] != "")?$current["content-type"]:"application/octet-stream";
					$filename		= ($current["name"] != "")?$current["name"]:basename($tmpfilename);

					$UM->save_attach($currentstruc["header"],$currentstruc["body"],$tmpfilename);

					$ind = count($sess["attachments"]);
					$sess["attachments"][$ind]["localname"] = $tmpfilename;
					$sess["attachments"][$ind]["name"] = $filename;
					$sess["attachments"][$ind]["type"] = $contenttype;
					$sess["attachments"][$ind]["size"] = filesize($tmpfilename);
				}
	
				$SS->Save($sess);
			}
			break;
		}
		
		
		if($add_sig && !empty($signature)) 
			if($show_advanced) $body = "<br><br>--<br>$signature<br><br>$body";
			else $body = "\r\n\r\n--\r\n$signature\r\n\r\n$body";
	} else

		if($add_sig && !empty($signature) && empty($body)) 
			if($show_advanced) $body = "<br><br>--<br>$signature<br><br>$body";
			else $body = "\r\n\r\n--\r\n$signature\r\n\r\n$body";

	$haveSig = empty($signature)?0:1;
	$smarty->assign("umHaveSignature",$haveSig);

	$strto = (isset($nameto) && eregi("([-a-z0-9_$+.]+@[-a-z0-9_.]+[-a-z0-9_])",$mailto))?
	"<input class=textinput style=\"width : 200px;\" type=text size=20 name=to value=\"&quot;".htmlspecialchars(stripslashes($nameto))."&quot; <".htmlspecialchars(stripslashes($mailto)).">\">
	":"<input class=textinput style=\"width : 200px;\" type=text size=20 name=to value=\"".htmlspecialchars(stripslashes($to))."\">";

	$strcc = "<input class=textinput style=\"width : 200px;\" type=text size=20 name=cc value=\"".htmlspecialchars(stripslashes($cc))."\">";
	$strbcc = "<input class=textinput style=\"width : 200px;\" type=text size=20 name=bcc value=\"".htmlspecialchars(stripslashes($bcc))."\">";
	$strsubject = "<input class=textinput style=\"width : 200px;\" type=text size=20 name=subject value=\"".htmlspecialchars(stripslashes($subject))."\">";

	$haveAttachs = (is_array($attachs = $sess["attachments"]) && count($sess["attachments"]) != 0)?1:0;
	$smarty->assign("umHaveAttachs",$haveAttachs);

	if(is_array($attachs = $sess["attachments"]) && count($sess["attachments"]) != 0) {

		$attachlist = Array();
		for($i=0;$i<count($attachs);$i++) {
			$index = count($attachlist);

			$attachlist[$index]["name"] = $attachs[$i]["name"];
			$attachlist[$index]["size"] = ceil($attachs[$i]["size"]/1024);
			$attachlist[$index]["type"] = $attachs[$i]["type"];
			$attachlist[$index]["link"] = "javascript:upwin($i)";
		}
		$smarty->assign("umAttachList",$attachlist);
	}

	if(!$show_advanced) $body = stripslashes($body);

	$umAdvEdit = ($show_advanced)?1:0;

	$smarty->assign("umBody",$body);
	$smarty->assign("umTo",$strto);
	$smarty->assign("umCc",$strcc);
	$smarty->assign("umBcc",$strbcc);
	$smarty->assign("umSubject",$strsubject);
	$smarty->assign("umTextEditor",$txtarea);
	$smarty->assign("umAdvancedEditor",$umAdvEdit);

	$smarty->display("$selected_theme/newmsg.htm");

}

?>

