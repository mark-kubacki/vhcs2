<?
/************************************************************************
UebiMiau is a GPL'ed software developed by 

 - Aldoir Ventura - aldoir@users.sourceforge.net
 - http://uebimiau.sourceforge.net

Fell free to contact, send donations or anything to me :-)
São Paulo - Brasil
*************************************************************************/



class UebiMiau_core {

	var $mail_connection	= 0;
	var $mail_server		= "localhost";
	var	$mail_port			= 110;
	var	$mail_error_msg		= "";
	var	$mail_user			= "unknown";
	var	$mail_pass			= "";
	var	$mail_email			= "unknown@localhost";
	var	$mail_protocol		= "pop3";

	var $allow_scripts		= true;
	var $use_html			= false;
	var $charset			= "iso-8859-1";
	var $timezone			= "+0000";
	var $debug				= false;
	var $user_folder		= "./";
	var $temp_folder		= "./";
	var $timeout			= 10;
	var $displayimages		= false;
	var $save_temp_attachs	= true;

	// internal
	var $_msgbody			= "";
	var $_content			= Array();
	var $_sid				= "";
	/*******************/



	function _get_headers_from_cache($strfile) {
		if(!file_exists($strfile)) return;
		$f = fopen($strfile,"rb");
		while(!feof($f)) {
			$result .= chop(fread($f,1024))."\r\n";
			$pos = strpos($result,"\r\n\r\n");
			if(!($pos === false)) {
				$result = substr($result,0,$pos);
				break;
			}
		}
		fclose($f);
		unset($f); unset($pos); unset($strfile);
		return $result;
	}


	function _read_file($strfile) {
		if($strfile == "" || !file_exists($strfile)) return;
		$fd = fopen($strfile,"rb");
		while(!feof($fd)) {
			$result .= chop(fgets($fd, 65536))."\r\n";
		}
		fclose($fd);
		return $result;
	}

	function _save_file($filename,$content) {
		$tmpfile = fopen($filename,"wb");
		fwrite($tmpfile,$content);
		fclose($tmpfile);
		unset($content,$tmpfile);
	}


	// remove dirs recursivelly
	function _RmdirR($location) { 

		if (substr($location,-1) <> "/") $location = $location."/";
		$all=opendir($location);
		while ($file=readdir($all)) { 
			if (is_dir($location.$file) && $file <> ".." && $file <> ".") { 
				$this->_RmdirR($location.$file);
				unset($file); 
			} elseif (!is_dir($location.$file)) { 
				unlink($location.$file); 
				unset($file); 
			}
		}
		closedir($all); 
		unset($all);
		rmdir($location);
	}

	/*******************/

	function mime_encode_headers($string) {
		if($string == "") return;
        if(!eregi("^([[:print:]]*)$",$string))
    		$string = "=?".$this->charset."?Q?".str_replace("+","_",str_replace("%","=",urlencode($string)))."?=";
		return $string;
	}

	function add_body($strbody) {
		if(!$this->allow_scripts) $strbody = $this->filter_scripts($strbody);
		if($this->_msgbody == "")
			$this->_msgbody = $strbody;
		else
			$this->_msgbody .= "\r\n<br>\r\n<br>\r\n<hr>\r\n<br>\r\n$strbody";
	}


	function decode_mime_string($subject) {
		$string = $subject;

		if(($pos = strpos($string,"=?")) === false) return $string;

		while(!($pos === false)) {

			$newresult .= substr($string,0,$pos);
			$string = substr($string,$pos+2,strlen($string));
			$intpos = strpos($string,"?");
			$charset = substr($string,0,$intpos);
			$enctype = strtolower(substr($string,$intpos+1,1));
			$string = substr($string,$intpos+3,strlen($string));
			$endpos = strpos($string,"?=");
			$mystring = substr($string,0,$endpos);
			$string = substr($string,$endpos+2,strlen($string));

			if($enctype == "q") $mystring = quoted_printable_decode(ereg_replace("_"," ",$mystring)); 
			else if ($enctype == "b") $mystring = base64_decode($mystring);

			$newresult .= $mystring;
			$pos = strpos($string,"=?");

		}

		$result = $newresult.$string;

		if(ereg("koi8", $subject)) $result = convert_cyr_string($result, "k", "w");
		return $result;

	}

	function decode_header($header) {
		$headers = explode("\r\n",$header);

		$decodedheaders = Array();
		for($i=0;$i<count($headers);$i++) {
			$thisheader = trim($headers[$i]);
			if(!empty($thisheader))
				if(!ereg("^[A-Z0-9a-z_-]+:",$thisheader))
					$decodedheaders[$lasthead] .= " $thisheader";
				else {
					$dbpoint = strpos($thisheader,":");
					$headname = strtolower(substr($thisheader,0,$dbpoint));
					$headvalue = trim(substr($thisheader,$dbpoint+1));
					if($decodedheaders[$headname] != "") $decodedheaders[$headname] .= "; $headvalue";
					else $decodedheaders[$headname] = $headvalue;
					$lasthead = $headname;
				}
		}

		return $decodedheaders;
	}



	function get_names($strmail) {
		$ARfrom = Array();
		$strmail = stripslashes(ereg_replace("\t","",ereg_replace("\n","",ereg_replace("\r","",$strmail))));
		if(trim($strmail) == "") return $ARfrom;

		$armail = Array();
		$counter = 0;  $inthechar = 0;
		$chartosplit = ",;"; $protectchar = "\""; $temp = "";
		$lt = "<"; $gt = ">";
		$closed = 1;

		for($i=0;$i<strlen($strmail);$i++) {
			$thischar = $strmail[$i];
			if($thischar == $lt && $closed) $closed = 0;
			if($thischar == $gt && !$closed) $closed = 1;
			if($thischar == $protectchar) $inthechar = ($inthechar)?0:1;
			if(!(strpos($chartosplit,$thischar) === false) && !$inthechar && $closed) {
				$armail[] = $temp; $temp = "";
			} else 
				$temp .= $thischar;
		}

		if(trim($temp) != "")
			$armail[] = trim($temp);

		for($i=0;$i<count($armail);$i++) {
			$thisPart = trim(eregi_replace("^\"(.*)\"$", "\\1", trim($armail[$i])));
			if($thisPart != "") {
				if (eregi("(.*)<(.*)>", $thisPart, $regs)) {
					$email = trim($regs[2]);
					$name = trim($regs[1]);
				} else {
					if (eregi("([-a-z0-9_$+.]+@[-a-z0-9_.]+[-a-z0-9_]+)((.*))", $thisPart, $regs)) {
						$email = $regs[1];
						$name = $regs[2];
					} else
						$email = $thisPart;
				}

				$email = preg_replace("/<(.*)\\>/", "\\1", $email);
				$name = preg_replace("/\"(.*)\"/", "\\1", trim($name));
				$name = preg_replace("/\((.*)\)/", "\\1", $name);

				if ($name == "") $name = $email;
				if ($email == "") $email = $name;
				$ARfrom[$i]["name"] = $this->decode_mime_string($name);
				$ARfrom[$i]["mail"] = $email;
				unset($name);unset($email);
			}
		}
		return $ARfrom;
	}

	function build_alternative_body($ctype,$body) {

		$boundary = $this->get_boundary($ctype);
		$parts = $this->split_parts($boundary,$body);
		$thispart = ($this->use_html)?$parts[1]:$parts[0];

		foreach($parts as $index => $value) {
			$email = $this->fetch_structure($value);
			$parts[$index] = $email;
			$parts[$index]["headers"] = $headers = $this->decode_header($email["header"]);
			unset($email);
			$ctype = split(";",$headers["content-type"]); $ctype = strtolower($ctype[0]);
			$parts[$index]["type"] = $ctype;
			if($this->use_html && $ctype == "text/html") {
				$part = $parts[$index];
				break;
			} elseif (!$this->use_html && $ctype == "text/plain") {
				$part = $parts[$index];
				break;
			}
		}
		if(!isset($part)) $part = $parts[0];
		unset($parts);

		$body = $this->compile_body($part["body"],$part["headers"]["content-transfer-encoding"],$part["headers"]["content-type"]);
		if(!$this->use_html && $part["type"] != "text/plain") $body = $this->html2text($body);
		if(!$this->use_html) $body = $this->build_text_body($body);
		$this->add_body($body);
	}

	function build_complex_body($ctype,$body) {
		global $sid,$lid,$ix,$folder;

		$Rtype = trim(substr($ctype,strpos($ctype,"type=")+5,strlen($ctype)));

		if(strpos($Rtype,";") != 0)
			$Rtype = substr($Rtype,0,strpos($Rtype,";"));
		if(substr($Rtype,0,1) == "\"" && substr($Rtype,-1) == "\"")
			$Rtype = substr($Rtype,1,strlen($Rtype)-2);


		$boundary = $this->get_boundary($ctype);
		$part = $this->split_parts($boundary,$body);

		for($i=0;$i<count($part);$i++) {
			$email = $this->fetch_structure($part[$i]);

			$header = $email["header"];
			$body = $email["body"];
			$headers = $this->decode_header($header);

			$ctype = $headers["content-type"];
			$cid = $headers["content-id"];

			$Actype = split(";",$headers["content-type"]);
			$types = split("/",$Actype[0]); $rctype = strtolower($Actype[0]);

			$is_download = (ereg("name=",$headers["content-disposition"].$headers["content-type"]) || $headers["content-id"] != "" || $rctype == "message/rfc822");

			if($rctype == "multipart/alternative") {

				$this->build_alternative_body($ctype,$body);

			} elseif($rctype == "text/plain" && !$is_download) {

				$body = $this->compile_body($body,$headers["content-transfer-encoding"],$headers["content-type"]);
				$this->add_body($this->build_text_body($body));

			} elseif($rctype == "text/html" &&  !$is_download) {

				$body = $this->compile_body($body,$headers["content-transfer-encoding"],$headers["content-type"]);

				if(!$this->use_html) $body = $this->build_text_body($this->html2text($body));
				$this->add_body($body);

			} elseif($is_download) {

				$thisattach 	= $this->build_attach($header,$body,$boundary,$i);
				$thisfile 		= "download.php?sid=$sid&tid=$tid&lid=$lid&folder=".urlencode($folder)."&ix=".$ix."&bound=".base64_encode($thisattach["boundary"])."&part=".$thisattach["part"]."&filename=".urlencode($thisattach["name"]);
				$temp_attach 	= false;
				$filename 		= $this->user_folder."_attachments/".md5($thisattach["boundary"])."_".$thisattach["name"];

				if($cid != "") {
					$temp_attach	= true;
					if($this->save_temp_attachs)
						$thisfile 	.= "&cache=true";
					if(substr($cid,0,1) == "<" && substr($cid,-1) == ">")
						$cid = substr($cid,1,strlen($cid)-2);
					$cid = "cid:$cid";
					$this->_msgbody	= str_replace($cid,$thisfile,$this->_msgbody);

				} elseif($this->displayimages) {
					$ext = substr($thisattach["name"],-4);
					$allowed_ext = Array(".gif",".jpg");
					if(in_array($ext,$allowed_ext)) {
						$temp_attach	= true;
						if($this->save_temp_attachs)
							$thisfile 	.= "&cache=true";
						$this->add_body("<img src=\"$thisfile\">");
					}
				}

				if($temp_attach && $this->save_temp_attachs)
					$this->save_attach($header,$body,$filename);

			} else
				$this->process_message($header,$body);

		}
	}

	function build_text_body($body) {
		$body = preg_replace("/(\r\n|\n|\r)/","<BR />\\1",$this->make_link_clickable(htmlspecialchars($body)));
		return "<font face=\"Courier New\" size=2>$body</font>";
	}

	function decode_qp($str) {
		return preg_replace(
					Array("'(=[0-9A-F]{2})+'ie","'=(\r\n|\n|\r)+'"), 
					Array("chr(hexdec('\\1'))",""), $str );
	}

	function make_link_clickable($str){

		$str = eregi_replace("([[:space:]])((f|ht)tps?:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a class=autolink href=\"\\2\" target=\"_blank\">\\2</a>", $str); //http 
		$str = eregi_replace("([[:space:]])(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "\\1<a class=autolink href=\"http://\\2\" target=\"_blank\">\\2</a>", $str); // www. 
		$str = eregi_replace("([[:space:]])([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","\\1<a class=autolink href=\"mailto:\\2\">\\2</a>", $str); // mail 

		$str = eregi_replace("^((f|ht)tp:\/\/[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a href=\"\\1\" target=\"_blank\">\\1</a>", $str); //http 
		$str = eregi_replace("^(www\.[a-z0-9~#%@\&:=?+\/\.,_-]+[a-z0-9~#%@\&=?+\/_.;-]+)", "<a class=autolink href=\"http://\\1\" target=\"_blank\">\\1</a>", $str); // www. 
		$str = eregi_replace("^([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})","<a class=autolink href=\"mailto:\\1\">\\1</a>", $str); // mail 

		return $str;
	}

	function process_message($header,$body) {
		$mail_info = $this->get_mail_info($header);

		$ctype = $mail_info["content-type"];
		$ctenc = $mail_info["content-transfer-encoding"];

		if($ctype == "") $ctype = "text/plain";

		$type = $ctype;

		$ctype = split(";",$ctype);
		$types = split("/",$ctype[0]);

		$maintype = trim(strtolower($types[0]));
		$subtype = trim(strtolower($types[1]));

		switch($maintype) {
		case "text":
			$body = $this->compile_body($body,$ctenc,$mail_info["content-type"]);
			switch($subtype) {
			case "html":
				if(!$this->use_html) $body = $this->build_text_body($this->html2text($body));
				$msgbody = $body;
				break;
			default:
				$msgbody = $this->build_text_body($body);
				break;
			}
			$this->add_body($msgbody);
			break;
		case "multipart":
			if(ereg($subtype,"signed,mixed,related"))
				$subtype = "complex";
			switch($subtype) {
			case "alternative":
				$msgbody = $this->build_alternative_body($ctype[1],$body);
				break;
			case "complex":
				$msgbody = $this->build_complex_body($type,$body);
				break;
			default:
				$thisattach = $this->build_attach($header,$body,"",0);
			}
			break;
		default:
			$thisattach = $this->build_attach($header,$body,"",0);
		}
	}

	function build_attach($header,$body,$boundary,$part,$mode="info",$down=0,$nametosave="tmp.eml") {

		global $mail,$temporary_directory,$userfolder;

		$headers = $this->decode_header($header);

		$cdisp = $headers["content-disposition"];
		$ctype = $headers["content-type"]; 
		$ctype2 = explode(";",$ctype); 
		$ctype2 = $ctype2[0];

		$Atype = split("/",$ctype);
		$Acdisp = split(";",$cdisp);

		$tenc = $headers["content-transfer-encoding"];

		$is_embebed = ($headers["content-id"] != "");
		$body = $this->compile_body($body,$tenc,$ctype);
		$fname = $Acdisp[1];

		if(ereg("filename=(.*)",$fname,$regs))
			$filename = $regs[1];
		if($filename == "" && ereg("name=(.*)",$ctype,$regs))
			$filename = $regs[1];
		$filename = ereg_replace("\"(.*)\"","\\1",$filename);

		$filename = trim($this->decode_mime_string($filename));

		if($filename == "" && $Atype[0] == "message") {

			$attachheader = $this->fetch_structure($body);
			$attachheader = $this->decode_header($attachheader["header"]);
			$filename = $this->decode_mime_string($attachheader["subject"]);
			unset($attachheader);
			$filename = substr(ereg_replace("[^A-Za-z0-9]","_",$filename),0,20).".eml";
		} elseif($filename == "") {
			$filename = uniqid("").".tmp";
		}


		switch($mode) {
		case "info":
			$temp_array["name"] = $filename;
			$temp_array["size"] = strlen($body);
			$temp_array["temp"] = $temp;
			$temp_array["content-type"] = $ctype2;
			$temp_array["content-disposition"] = $Acdisp[0];
			$temp_array["boundary"] = $boundary;
			$temp_array["part"] = $part;
			$indice = count($this->_content["attachments"]);
			if(!$is_embebed)
				$this->_content["attachments"][$indice] = $temp_array;
			return $temp_array;
			break;
		case "down":
			$content_type = ($down)?"application/octet-stream":strtolower($ctype2);
			$filesize = strlen($body);
			header("Content-Type: $content_type; name=\"$filename\"\r\n"
			."Content-Length: $filesize\r\n");
			$cdisp = ($down)?"attachment":"inline";
			header("Content-Disposition: $cdisp; filename=\"$filename\"\r\n");
			echo($body);
			break;
		case "save":
			if(!ereg("\\.\\.",$nametosave))
				$this->_save_file($nametosave,$body);
			return 1;
			break;
		}
	}

	function compile_body($body,$enctype,$ctype) {
		$enctype = explode(" ",$enctype); $enctype = $enctype[0];
		if(strtolower($enctype) == "base64")
			$body = base64_decode($body);
		elseif(strtolower($enctype) == "quoted-printable")
			$body = $this->decode_qp($body);
		if(ereg("koi8", $ctype)) $body = convert_cyr_string($body, "k", "w");
		return $body;

	}


	function download_attach($header,$body,$bound="",$part=0,$down=1) {
		if($bound != "") {
			$parts = $this->split_parts($bound,$body);
			// split the especified part of mail, body and headers
			$email = $this->fetch_structure($parts[$part]);
			$header = $email["header"];
			$body = $email["body"];
			unset($email);
		}
		$this->build_attach($header,$body,"",0,$mode="down",$down);
	}

	function save_attach($header,$body,$filename) {
		$this->build_attach($header,$body,"",0,$mode="save",0,$filename);
	}

	function get_mail_info($header) {

		$myarray = Array();
		$headers = $this->decode_header($header);

		$message_id = ereg_replace("<(.*)>","\\1",$headers["message-id"]);

		$myarray["content-type"] = $headers["content-type"];
		$myarray["priority"] = $headers["x-priority"][0];

		$myarray["content-transfer-encoding"] = str_replace("GM","-",$headers["content-transfer-encoding"]);
		$myarray["message-id"] = trim($message_id);

		$received	= ereg_replace("  "," ",$headers["received"]);
		$user_date	= ereg_replace("  "," ",$headers["date"]);

		if(eregi("([0-9]{1,2}[ ]+[A-Z]{3}[ ]+[0-9]{4}[ ]+[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2})[ ]?((\+|-)[0-9]{4})?",$received,$regs)) {
			//eg. Tue, 4 Sep 2001 16:22:31 -0000
			$mydate = $regs[1];
			$mytimezone = $regs[2];
			if(empty($mytimezone))
				if(eregi("((\\+|-)[0-9]{4})",$user_date,$regs)) $mytimezone = $regs[1];
				else $mytimezone = $this->timezone;
		} elseif(eregi("(([A-Z]{3})[ ]+([0-9]{1,2})[ ]+([0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2})[ ]+([0-9]{4}))",$received,$regs)) {
			//eg. Tue Sep 4 16:26:17 2001 (Cubic Circle's style)
			$mydate = $regs[3]." ".$regs[2]." ".$regs[5]." ".$regs[4];
			if(eregi("((\\+|-)[0-9]{4})",$user_date,$regs)) $mytimezone = $regs[1];
			else $mytimezone = $this->timezone;

		} elseif(eregi("([0-9]{1,2}[ ]+[A-Z]{3}[ ]+[0-9]{4}[ ]+[0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2})[ ]?((\+|-)[0-9]{4})?",$user_date,$regs)) {
			//eg. Tue, 4 Sep 2001 16:22:31 -0000 (from Date header)
			$mydate = $regs[1];
			$mytimezone = $regs[2];
			if(empty($mytimezone))
				if(eregi("((\\+|-)[0-9]{4})",$user_date,$regs)) $mytimezone = $regs[1];
				else $mytimezone = $this->timezone;
		} else {
			$mydate		= date("d M Y H:i");
			$mytimezone	= $this->timezone;
		}
		$myarray["date"] = $this->build_mime_date($mydate,$mytimezone);
		$myarray["subject"] = $this->decode_mime_string($headers["subject"]);
		$myarray["from"] = $this->get_names($headers["from"]);
		$myarray["to"] = $this->get_names($headers["to"]);
		$myarray["cc"] = $this->get_names($headers["cc"]);
		$myarray["reply-to"] = $this->get_names($headers["reply-to"]);
		$myarray["status"] = $headers["status"];
		$myarray["read"] = $headers["x-um-status"];

		return $myarray;

	}

	function build_mime_date($mydate,$timezone = "+0000") {
		if(!ereg("((\\+|-)[0-9]{4})",$timezone)) $timezone = "+0000";
		$parts = explode(" ",$mydate);
		if(count($parts) < 4) { return time(); }
		$day = $parts[0];
		switch(strtolower($parts[1])) {
			case "jan": $mon = 1; break;
			case "feb":	$mon = 2; break;
			case "mar":	$mon = 3; break;
			case "apr":	$mon = 4; break;
			case "may":	$mon = 5; break;
			case "jun": $mon = 6; break;
			case "jul": $mon = 7; break;
			case "aug": $mon = 8; break;
			case "sep": $mon = 9; break;
			case "oct": $mon = 10; break;
			case "nov": $mon = 11; break;
			case "dec": $mon = 12; break;
		}
		$year = $parts[2];
		$ahours = explode(":",$parts[3]);
		$hour = $ahours[0]; $min = $ahours[1]; $sec = $ahours[2];
		$timezone_oper	= $timezone[0];
		$timezone_hour	= intval("$timezone_oper".substr($timezone,1,2))*3600;
		$timezone_min	= intval("$timezone_oper".substr($timezone,3,2))*60;
		$timezone_diff	= $timezone_hour+$timezone_min;
		$user_timezone_oper	= $this->timezone[0];
		$user_timezone_hour	= intval("$user_timezone_oper".substr($this->timezone,1,2))*3600;
		$user_timezone_min	= intval("$user_timezone_oper".substr($this->timezone,3,2))*60;
		$user_timezone_diff	= $user_timezone_hour+$user_timezone_min;
		$diff 				= $timezone_diff-$user_timezone_diff;
		$mytimestamp	= mktime ($hour, $min, $sec, $mon, $day, $year)-$diff;
		return $mytimestamp;
	}

	function Decode($email) {
		$email = $this->fetch_structure($email);
		$this->_msgbody = "";
		$body = $email["body"];
		$header = $email["header"];
		$mail_info = $this->get_mail_info($header);
		$this->process_message($header,$body);
		$this->_content["headers"] = $header;
		$this->_content["date"] = $mail_info["date"];
		$this->_content["subject"] = $mail_info["subject"];
		$this->_content["message-id"] = $mail_info["message-id"];
		$this->_content["from"] = $mail_info["from"];
		$this->_content["to"] = $mail_info["to"];
		$this->_content["cc"] = $mail_info["cc"];
		$this->_content["reply-to"] = $mail_info["reply-to"];
		$this->_content["body"] = $this->_msgbody;
		$this->_content["read"] = $mail_info["read"];
		$this->_content["priority"] = $mail_info["priority"];
		return $this->_content;
	}

	function split_parts($boundary,$body) {
		$startpos = strpos($body,$boundary)+strlen($boundary)+2;
		$lenbody = strpos($body,"\r\n$boundary--") - $startpos;
		$body = substr($body,$startpos,$lenbody);
		return explode($boundary."\r\n",$body);
	}

	function fetch_structure($email) {
		$ARemail = Array();
		$separador = "\r\n\r\n";
		$header = trim(substr($email,0,strpos($email,$separador)));
		$bodypos = strlen($header)+strlen($separador);
		$body = substr($email,$bodypos,strlen($email)-$bodypos);
		$ARemail["header"] = $header; $ARemail["body"] = $body;
		return $ARemail;
	}

	function get_boundary($ctype){
		if(preg_match('/boundary[ ]?=[ ]?(["]?.*)/i',$ctype,$regs)) {
			$boundary = preg_replace('/^\"(.*)\"$/', "\\1", $regs[1]);
			return trim("--$boundary");
		}
	}

	function _filter_tag($str) {
		$matches = Array(
					"'(%[0-9A-Za-z]{2})+'e", 						//unicode
					"'(\bON\w+)'i",									//events
					"'(HREF)( *= *[\"\']?\w+SCRIPT *:[^\"\' >]+)'i" //links
					);
		$replaces = Array("chr(hexdec('\\1'))","\\1_filtered","\\1_filtered\\2");
		return stripslashes(preg_replace($matches, $replaces, $str));
	}

	function filter_scripts($str) {
		return preg_replace(
					Array("'(<\/?\w+[^>]*>)'e","'<SCRIPT[^>]*?>.*?</SCRIPT[^>]*?>'si"), 
					Array("\$this->_filter_tag('\\1')",""), $str);
	}

	function unhtmlentities ($string) {
		$trans_tbl = get_html_translation_table (HTML_ENTITIES);
		$trans_tbl = array_flip ($trans_tbl);
		return strtr ($string, $trans_tbl);
	}

	function html2text($str) {
		return $this->unhtmlentities(preg_replace(
				Array(	"'<(SCRIPT|STYLE)[^>]*?>.*?</(SCRIPT|STYLE)[^>]*?>'si",
						"'(\r|\n)'",
						"'<BR[^>]*?>'i",
						"'<P[^>]*?>'i",
						"'<\/?\w+[^>]*>'e"
						),
				Array(	"",
						"",
						"\r\n",
						"\r\n\r\n",
						""),
				$str));
	}
}
require("./inc/class.uebimiau_mail.php");
?>