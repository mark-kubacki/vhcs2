<?
class UebiMiau extends UebiMiau_core {

	var $_current_folder = "";
	var $_system_folders = Array("inbox","trash","sent");

	function UebiMiau() {
		$this->_sid = uniqid("");
	}

	function mail_connected() {
        if(!empty($this->mail_connection)) {
            $sock_status = @socket_get_status($this->mail_connection);
			
            if($sock_status["eof"]) {
                @fclose($this->mail_connection);
                return 0;
            }
            return 1; 
        } 
        return 0;
	}

	function mail_get_line() {
		$buffer = chop(fgets($this->mail_connection,1024));
		if($this->debug) {
			$sendtodebug = true;
			if(eregi("^(\\* )",$buffer) || eregi("^([A-Za-z0-9]+ (OK|NO|BAD))",$buffer) || eregi("^(\\+OK|\\-ERR)",$buffer)) {
				$output = "<- <b>".htmlspecialchars($buffer)."</b>";
			} else {
				$sendtodebug = ($this->debug > 1)?false:true;
				$output = htmlspecialchars($buffer);
			}
			if ($sendtodebug)
				echo("<font style=\"font-size:12px; font-family: Courier New; background-color: white; color: black;\"> $output</font><br>\r\n");
			flush();
		}
		return $buffer;
	}

	function mail_send_command($cmd) {
		if($this->mail_connected()) {
			$output = (eregi("^(PASS|LOGIN)",$cmd,$regs))?$regs[1]." ****":$cmd;
			if($this->mail_protocol == "imap") {
				$cmd = $this->_sid." ".$cmd;
				$output = $this->_sid." ".$output;
			}
			fwrite($this->mail_connection,"$cmd\r\n");
			if($this->debug) {
				echo("<font style=\"font-size:12px; font-family: Courier New; background-color: white; color: black;\">-&gt; <em><b>".htmlspecialchars($output)."</b></em></font><br>\r\n");
				flush();
			}
			return 1;
		}
		return 0;
	}

	function mail_connect() {
		if($this->debug)
			for($i=0;$i<20;$i++)
				echo("<!-- buffer sux -->\r\n");


		if(!$this->mail_connected()) {
	
			$this->mail_connection = fsockopen($this->mail_server, $this->mail_port, $errno, $errstr, 15);


			if($this->mail_connection) {

				$buffer = $this->mail_get_line();


				if($this->mail_protocol == "imap") $regexp = "^([ ]?\\*[ ]?OK)";
				else $regexp = "^(\\+OK)";

				if(ereg($regexp,$buffer)) return 1;
				else return 0;
			}
			return 0;
		} else return 1;
	}


	function mail_auth($checkfolders=false) {
		if($this->mail_connected()) {
			if ($this->mail_protocol == "imap") {
				$this->mail_send_command("LOGIN ".$this->mail_user." ".$this->mail_pass);
				$buffer = $this->mail_get_line();
				if(ereg("^(".$this->_sid." OK)",$buffer)) { 
					if($checkfolders)
						$this->_check_folders();
					return 1;
				} else { 
					$this->mail_error_msg = $buffer; 
					return 0; 
				}
			} else {
				$this->mail_send_command("USER ".$this->mail_user);
				$buffer = $this->mail_get_line();
				if(ereg("^(\+OK)",$buffer)) {
					$this->mail_send_command("PASS ".$this->mail_pass);
					$buffer = $this->mail_get_line();
					if(ereg("^(\+OK)",$buffer)) { 
						if($checkfolders)
							$this->_check_folders();
						return 1;
					} else { 
						$this->mail_error_msg = $buffer; 
						return 0; 
					}
				} else 
					return 0;
			}
		}
		return 0;
	}

	function _check_folders() {

		$userfolder = $this->user_folder;
		$temporary_directory = $this->temp_folder;
		$idle_timeout = $this->timeout;

		if(!file_exists($this->user_folder))
			if(!@mkdir($this->user_folder,0777)) die("<h1><br><br><br><center>$error_permiss</center></h1>");

		$boxes = $this->mail_list_boxes();


		if($this->mail_protocol == "imap") {
			$tmp = $this->_system_folders;

			for($i=0;$i<count($boxes);$i++) {
				$current_folder = $boxes[$i]["name"];

				if(in_array(strtolower($current_folder),$this->_system_folders)) 
					$current_folder = strtolower($current_folder);

				while(list($index,$value) = each($tmp)) {
					if(strtolower($current_folder) == strtolower($value)) {
						unset($tmp[$index]);
					}
				}

				reset($tmp);
			}

			while(list($index,$value) = each($tmp)) {
				$this->mail_create_box($value);
			}

			for($i=0;$i<count($boxes);$i++) {
				$current_folder = $boxes[$i]["name"];
				if(!in_array(strtolower($current_folder),$this->_system_folders))
					if(!file_exists($this->user_folder.$current_folder))
						mkdir($this->user_folder.$current_folder,0777);
			}

		}

		$system_folders = array_merge($this->_system_folders,Array("_attachments","_infos"));

		while(list($index,$value) = each($system_folders)) {
			if(!file_exists($this->user_folder.$value)) {
				if(in_array(strtolower($value),$this->_system_folders)) 
					$value = strtolower($value);
				mkdir($this->user_folder.$value,0777);
			}
		}


		$sessiondir = $temporary_directory."_sessions/";

		// Clean old sessions
		$all=opendir($sessiondir); 
		while ($file=readdir($all)) { 
			$thisfile = $sessiondir.$file;
			if (is_file($thisfile)) {
				$idle = intval((time()-@filemtime($thisfile))/60);
				if(($idle_timeout+10) < $idle)
					@unlink($thisfile);
			}
		}

		closedir($all); 
		unset($all);

	}
	
	
	function mail_retr_msg($msg,$check=1) {

		global $mail_use_top,$appname,$appversion,$error_retrieving;
		$msgheader = $msg["header"];

		if($this->mail_protocol == "imap") {

			if($check) {
				if(strtolower($this->_current_folder) != strtolower($msg["folder"]))
					$boxinfo = $this->mail_select_box($msg["folder"]);

				$this->mail_send_command("FETCH ".$msg["id"].":".$msg["id"]." BODY.PEEK[HEADER.FIELDS (Message-Id)]");
				$buffer = $this->mail_get_line();

				if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
				while(!eregi("^(".$this->_sid." OK)",$buffer)) {
					if(eregi("message-id: (.*)",$buffer,$regs))
						$current_id = ereg_replace("<(.*)>","\\1",$regs[1]);
					$buffer = $this->mail_get_line();
				}
				if(base64_encode($current_id) != base64_encode($msg["message-id"])) {
					$this->mail_error_msg = $error_retrieving;
					return 0;
				}
			}

			if(file_exists($msg["localname"])) {
				$msgcontent = $this->_read_file($msg["localname"]);
			} else {
				$this->mail_send_command("FETCH ".$msg["id"].":".$msg["id"]." BODY[TEXT]");
				$buffer = $this->mail_get_line();
				if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
				if(ereg("\\{(.*)\\}",$buffer,$regs))
					$bytes = $regs[1];

				$buffer = $this->mail_get_line();
				while(!eregi("^(".$this->_sid." OK)",$buffer)) {
					if(!eregi("[ ]?\\*[ ]?[0-9]+[ ]?FETCH",$buffer))
						$msgbody .= "$buffer\r\n";
					$buffer = $this->mail_get_line();
				}

				$pos = strrpos($msgbody, ")");
				if(!($pos === false))
					$msgbody = substr($msgbody,0,$pos);

				$msgcontent = "$msgheader\r\n\r\n$msgbody";
				$this->_save_file($msg["localname"],$msgcontent);

			}

		} else {

			if($check && strtolower($msg["folder"]) == "inbox") {
				$this->mail_send_command("TOP ".$msg["id"]." 0");
				$buffer = $this->mail_get_line();

				if(!ereg("^(\+OK)",$buffer))  { $this->mail_error_msg = $buffer; return 0; }

				unset($header);

				while (!feof($this->mail_connection)) {
					$buffer = $this->mail_get_line();
					if(trim($buffer) == ".") break;
					$header .= "$buffer\r\n";
				}
				$mail_info = $this->get_mail_info($header);

				if(base64_encode($mail_info["message-id"]) != base64_encode($msg["message-id"])) {
					$this->mail_error_msg = $error_retrieving;
					return 0;
				}

			}

			if(file_exists($msg["localname"])) {
				$msgcontent = $this->_read_file($msg["localname"]);

			} elseif (strtolower($msg["folder"]) == "inbox") {
				$command = ($mail_use_top)?"TOP ".$msg["id"]." ".$msg["size"]:"RETR ".$msg["id"];
				$this->mail_send_command($command);
				$buffer = $this->mail_get_line();
	
				if(!ereg("^(\+OK)",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
				$last_buffer = 0;

				while (!feof($this->mail_connection)) {
					$buffer = ereg_replace("(\n|\r)","",$this->mail_get_line());
					if(trim($buffer) == ".") break;
					if($body_started)
						$msgbody .= "$buffer\r\n";
					if(!$body_started && trim($buffer) == "") $body_started = true;
				}
				$msgcontent = "$msgheader\r\n\r\n$msgbody";
				$this->_save_file($msg["localname"],$msgcontent);
			}
		}

		return $msgcontent;
	}


	function mail_delete_msg($msg, $send_to_trash = 1, $save_only_read = 0) {

		$read = (ereg("\\SEEN",$msg["flags"]))?1:0;

		/* choose your protocol */
		if($this->mail_protocol == "imap") {
			
			
			/* check the message id to make sure that the messages still in the server */
			if(strtolower($this->_current_folder) != strtolower($msg["folder"]))
				$boxinfo = $this->mail_select_box($msg["folder"]);
	
			$this->mail_send_command("FETCH ".$msg["id"].":".$msg["id"]." BODY.PEEK[HEADER.FIELDS (Message-Id)]");
			$buffer = $this->mail_get_line();

			/* if any problem with the server, stop the function */
			if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }

			while(!eregi("^(".$this->_sid." OK)",$buffer)) {
				/* we need only the message id yet */

				if(eregi("message-id: (.*)",$buffer,$regs))
					$current_id = ereg_replace("<(.*)>","\\1",$regs[1]);

				$buffer = $this->mail_get_line();
			}


			/* compare the old and the new message id, if different, stop*/
			if(base64_encode($current_id) != base64_encode($msg["message-id"])) {
				$this->mail_error_msg = $error_retrieving;
				return 0;
			}

			/*if the pointer is here, no one problem occours*/

			
			if( $send_to_trash && 
				strtoupper($msg["folder"]) != "TRASH" &&
				(!$save_only_read || ($save_only_read && $read))) {

				$this->mail_send_command("COPY ".$msg["id"].":".$msg["id"]." \"trash\"");
				$buffer = $this->mail_get_line();

				/* if any problem with the server, stop the function */
				if(!eregi("^(".$this->_sid." OK)",$buffer)) { $this->mail_error_msg = $buffer; return 0; }

				if(file_exists($msg["localname"])) {
					$currentname = $msg["localname"];
					$basename = basename($currentname);
					$newfilename = $this->user_folder."trash/$basename";
					copy($currentname,$newfilename);
					unlink($currentname);
				}
			}
			$this->mail_set_flag($msg,"\\DELETED","+");

			$this->_require_expunge = true;

			return 1;

		} else {
			/* now we are working with POP3 */
			/* check the message id to make sure that the messages still in the server */
			if(strtoupper($msg["folder"]) == "INBOX") {

				$this->mail_send_command("TOP ".$msg["id"]." 0");
				$buffer = $this->mail_get_line();
	
				/* if any problem with the server, stop the function */
				if(!ereg("^(\+OK)",$buffer))  { $this->mail_error_msg = $buffer; return 0; }
	
				unset($header);
	
				while (!feof($this->mail_connection)) {
					$buffer = $this->mail_get_line();
					if(trim($buffer) == ".") break;
					$header .= "$buffer\r\n";
				}
				$mail_info = $this->get_mail_info($header);
	
	
				/* compare the old and the new message id, if different, stop*/
				if(base64_encode($mail_info["message-id"]) != base64_encode($msg["message-id"])) {
					$this->mail_error_msg = $error_retrieving;
					return 0;
				}

				if(!file_exists($msg["localname"])) {
					if(!$this->mail_retr_msg($msg,0)) return 0;
					$this->mail_set_flag($msg,"\\SEEN","-");
				}
				$this->mail_send_command("DELE ".$msg["id"]);
				$buffer = $this->mail_get_line();
				if(!ereg("^(\+OK)",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
			}

			if( $send_to_trash && 
				strtoupper($msg["folder"]) != "TRASH" &&
				(!$save_only_read || ($save_only_read && $read))) {

				if(file_exists($msg["localname"])) {
					$currentname = $msg["localname"];
					$basename = basename($currentname);
					$newfilename = $this->user_folder."trash/$basename";
					copy($currentname,$newfilename);
					unlink($currentname);
				}
			} else {
				unlink($msg["localname"]);
			}

		}
		return 1;
	}


	function mail_move_msg($msg,$tofolder) {

		/* choose your protocol */

		if($this->mail_protocol == "imap") {

			if(strtolower($tofolder) != strtolower($msg["folder"])) {
				/* check the message id to make sure that the messages still in the server */
				if(strtolower($this->_current_folder) != strtolower($msg["folder"]))
					$boxinfo = $this->mail_select_box($msg["folder"]);
		
				$this->mail_send_command("FETCH ".$msg["id"].":".$msg["id"]." BODY.PEEK[HEADER.FIELDS (Message-Id)]");
				$buffer = $this->mail_get_line();
	
				/* if any problem with the server, stop the function */
				if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
	
				while(!eregi("^(".$this->_sid." OK)",$buffer)) {
					/* we need only the message id yet */
	
					if(eregi("message-id: (.*)",$buffer,$regs))
						$current_id = ereg_replace("<(.*)>","\\1",$regs[1]);
	
					$buffer = $this->mail_get_line();
				}
	
	
				/* compare the old and the new message id, if different, stop*/
				if(base64_encode($current_id) != base64_encode($msg["message-id"])) {
					$this->mail_error_msg = $error_retrieving;
					return 0;
				}
				/*if the pointer is her, no one problem occours*/

				/* otherwise, get it from server */
				$this->mail_send_command("COPY ".$msg["id"].":".$msg["id"]." \"$tofolder\"");
				$buffer = $this->mail_get_line();

				/* if any problem with the server, stop the function */
				if(!eregi("^(".$this->_sid." OK)",$buffer)) { $this->mail_error_msg = $buffer; return 0; }

				if(file_exists($msg["localname"])) {
					$currentname = $msg["localname"];
					$basename = basename($currentname);
					$newfilename = $this->user_folder."$tofolder/$basename";
					copy($currentname,$newfilename);
					unlink($currentname);
				}
				$this->mail_set_flag($msg,"\\DELETED","+");
				$this->_require_expunge = true;
			}

			return 1;

		} else {

			if(strtoupper($tofolder) != "INBOX" && strtolower($tofolder) != strtolower($msg["folder"])) {
				/* now we are working with POP3 */
				/* check the message id to make sure that the messages still in the server */
				if(strtoupper($msg["folder"]) == "INBOX") {
	
					$this->mail_send_command("TOP ".$msg["id"]." 0");
					$buffer = $this->mail_get_line();
		
					/* if any problem with the server, stop the function */
					if(!ereg("^(\+OK)",$buffer))  { $this->mail_error_msg = $buffer; return 0; }
		
					unset($header);
		
					while (!feof($this->mail_connection)) {
						$buffer = $this->mail_get_line();
						if(trim($buffer) == ".") break;
						$header .= "$buffer\r\n";
					}
					$mail_info = $this->get_mail_info($header);
		
		
					/* compare the old and the new message id, if different, stop*/
					if(base64_encode($mail_info["message-id"]) != base64_encode($msg["message-id"])) {
						$this->mail_error_msg = $error_retrieving;
						return 0;
					}
	
					if(!file_exists($msg["localname"])) {
						if(!$this->mail_retr_msg($msg,0)) return 0;
						$this->mail_set_flag($msg,"\\SEEN","-");
					}
					$this->mail_send_command("DELE ".$msg["id"]);
					$buffer = $this->mail_get_line();
					if(!ereg("^(\+OK)",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
				}
				if(file_exists($msg["localname"])) {
					$currentname = $msg["localname"];
					$basename = basename($currentname);
					$newfilename = $this->user_folder."$tofolder/$basename";
					copy($currentname,$newfilename);
					unlink($currentname);
				}
			} else 
				return 0;
			
		}
		return 1;
	}

	function mail_list_msgs($boxname = "INBOX") {


		global $userfolder;

		if(in_array(strtolower($boxname),$this->_system_folders)) 
			$boxname = strtolower($boxname);

		$msglist = Array();

		/* choose the protocol */

		if($this->mail_protocol == "imap") {

			/* select the mail box and make sure that it exists */
			$boxinfo = $this->mail_select_box($boxname);

			if(is_array($boxinfo) && $boxinfo["exists"]) {

				/* if the box is ok, fetch the first to the last message, getting the size and the header */
	
				$this->mail_send_command("FETCH 1:".$boxinfo["exists"]." (FLAGS RFC822.SIZE RFC822.HEADER)");
				$buffer = $this->mail_get_line();
	
				/* if any problem, stop the procedure */
	
				if(!eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { 
	
					$counter = 0;
					
					/* the end mark is <sid> OK FETCH, we are waiting for it*/
					while(!eregi("^(".$this->_sid." OK)",$buffer)) {
						/* if the return is something such as * N FETCH, a new message will displayed  */
						if(eregi("[ ]?\\*[ ]?([0-9]+)[ ]?FETCH",$buffer,$regs)) {
							$curmsg	= $regs[1];
							eregi("SIZE[ ]?([0-9]+)",$buffer,$regs);
							$size	= $regs[1];
							eregi("FLAGS[ ]?\\((.*)\\)",$buffer,$regs);
							$flags 	= $regs[1];
						/* if any problem, add the current line to buffer */
						} elseif(trim($buffer) != ")" && trim($buffer) != "") {
							$header .= "$buffer\r\n";
		
						/*	the end of message header was reached, increment the counter and store the last message */
						} elseif(trim($buffer) == ")") {
							$msglist[$counter]["id"] = $counter+1; //$msgs[0];
							$msglist[$counter]["msg"] = $curmsg;
							$msglist[$counter]["size"] = $size;
							$msglist[$counter]["flags"] = strtoupper($flags);
							$msglist[$counter]["header"] = $header;
							$counter++;
							$header = "";
						}
						$buffer = $this->mail_get_line();
					}
				}
			}
		} else {
			/* 
			now working with POP3
			if the boxname is "INBOX", we can check in the server for messsages 
			*/
			if(strtoupper($boxname) == "INBOX") {
				$this->mail_send_command("LIST");
				$buffer = $this->mail_get_line();
				/* if any problem with this messages list, stop the procedure */

				if(!ereg("^(\+OK)",$buffer))  { $this->mail_error_msg = $buffer; return $msglist; }

				$counter = 0;

				while (!feof($this->mail_connection)) {
					$buffer = $this->mail_get_line();
					if(trim($buffer) == ".") break;
					$msgs = split(" ",$buffer);
					if(is_numeric($msgs[0])) {
						$msglist[$counter]["id"] = $counter+1; //$msgs[0];
						$msglist[$counter]["msg"] = $msgs[0];
						$msglist[$counter]["size"] = $msgs[1];
						$counter++;
					}
				}

				/* OK, now we have id and size of messages, but we need the headers too */
				if(count($msglist) == 0) return $msglist;
	
				for($i=0;$i<count($msglist);$i++) {
					$this->mail_send_command("TOP ".$msglist[$i]["msg"]." 0");
					$buffer = $this->mail_get_line();
		
					/* if any problem with this messages list, stop the procedure */
					if(!ereg("^(\+OK)",$buffer))  { $this->mail_error_msg = $buffer; return 0; }
		
					while (!feof($this->mail_connection)) {
						$buffer = $this->mail_get_line();
						if(trim($buffer) == ".") break;
						if(strlen($buffer) > 3) 
							$header .= "$buffer\r\n";
					}

					$msglist[$i]["header"] = $header;
					$header = "";
				}
			} else {
				/* otherwise, we need get the message list from a cache (currently, hard disk)*/
				$datapath = $userfolder.$boxname;
				$i = 0;
				$msglist = Array();
				$d = dir($datapath);
				$dirsize = 0;

				while($entry=$d->read()) {
					$fullpath = "$datapath/$entry";
					if(is_file($fullpath)) {
						$thisheader = $this->_get_headers_from_cache($fullpath);
						$msglist[$i]["id"]			= $i+1;
						$msglist[$i]["msg"]			= $i;
						$msglist[$i]["header"]		= $thisheader;
						$msglist[$i]["size"]		= filesize($fullpath);
						$msglist[$i]["localname"]	= $fullpath;
						$i++;
					}
				}

				$d->close();
			}
		}


		/* 
		OK, now we have the message list, that contains id, size and header
		this script will process the header to get subject, date and other
		informations formatted to be displayed in the message list when  needed
		*/

		for($i=0;$i<count($msglist);$i++) {
			$mail_info = $this->get_mail_info($msglist[$i]["header"]);
			$msglist[$i]["date"] = $mail_info["date"];
			$msglist[$i]["subject"] = $mail_info["subject"];
			$msglist[$i]["message-id"] = $mail_info["message-id"];
			$msglist[$i]["from"] = $mail_info["from"];
			$msglist[$i]["to"] = $mail_info["to"];
			$msglist[$i]["fromname"] = $mail_info["from"][0]["name"];
			$msglist[$i]["to"] = $mail_info["to"];
			$msglist[$i]["cc"] = $mail_info["cc"];
			$msglist[$i]["headers"] = $header;
			$msglist[$i]["priority"] = $mail_info["priority"];
			$msglist[$i]["attach"] = (eregi("(multipart/mixed|multipart/related|application)",$mail_info["content-type"]))?1:0;

			if ($msglist[$i]["localname"] == "") {
				$msglist[$i]["localname"] = $this->_get_local_name($mail_info,$boxname);
			}

			$msglist[$i]["read"] = file_exists($flocalname)?1:0;

			/* 
			ops, a trick. if the message is not imap, the flags are stored in
			a special field on headers 
			*/

			if($this->mail_protocol != "imap" && file_exists($msglist[$i]["localname"])) {

				$headers = $this->_get_headers_from_cache($msglist[$i]["localname"]);
				$headers = $this->decode_header($headers);
				$msglist[$i]["flags"] = strtoupper($headers["x-um-flags"]);
			}
			
			$msglist[$i]["folder"] = $boxname;
		}
		return $msglist;
	}

	function _get_local_name($message,$boxname) {
		$flocalname = trim($this->user_folder."$boxname/".md5(trim($message["subject"].$message["date"].$message["message-id"])).".eml");
		return $flocalname;
	}

	function mail_list_boxes($boxname = "*") {
		$boxlist = Array();
		/* choose the protocol*/
		if($this->mail_protocol == "imap") {
			$this->mail_send_command("LIST \"\" $boxname");
			$buffer = $this->mail_get_line();
			/* if any problem, stop the script */
			if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
			/* loop throught the list and split the parts */
			while(!eregi("^(".$this->_sid." OK)",$buffer)) {
				$tmp = Array();
				ereg("\\((.*)\\)",$buffer,$regs);
				$flags = $regs[1];
				$tmp["flags"] = $flags;

				ereg("\\((.*)\\)",$buffer,$regs);
				$flags = $regs[1];
				
				$pos = strpos($buffer,")");
				$rest = substr($buffer,$pos+2);
				$pos = strpos($rest," ");
				$tmp["prefix"] = ereg_replace("\"(.*)\"","\\1",substr($rest,0,$pos));
				$tmp["name"] = trim(ereg_replace("\"(.*)\"","\\1",substr($rest,$pos+1)));
				$buffer = $this->mail_get_line();
				$boxlist[] = $tmp;
			}
		} else {
			/* if POP3, only list the available folders */
			$d = dir($this->user_folder);
			while($entry=$d->read()) {
				if(in_array(strtolower($entry),$this->_system_folders)) 
					$entry = strtolower($entry);

				if(	is_dir($this->user_folder.$entry) && 
					$entry != ".." && 
					substr($entry,0,1) != "_" && 
					$entry != ".") {
					$boxlist[]["name"] = $entry;
				}
			}
			$d->close();
		}
		return $boxlist;
	}

	function mail_select_box($boxname = "INBOX") {
		/* this function is used only for IMAP servers */
		if($this->mail_protocol == "imap") {
			$boxname = ereg_replace("\"(.*)\"","\\1",$boxname);
			$this->mail_send_command("SELECT \"$boxname\"");
			$buffer = $this->mail_get_line();

			if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }

			$boxinfo = Array();
			/* get total, recent messages and flags */
			while(!eregi("^(".$this->_sid." OK)",$buffer)) {
				if(eregi("[ ]?\\*[ ]?([0-9]+)[ ]EXISTS",$buffer,$regs))
					$boxinfo["exists"] = $regs[1];
				if(eregi("[ ]?\\*[ ]?([0-9])+[ ]RECENT",$buffer,$regs))
					$boxinfo["recent"] = $regs[1];
				if(eregi("[ ]?\\*[ ]?FLAGS[ ]?\\((.*)\\)",$buffer,$regs))
					$boxinfo["flags"] = $regs[1];
				$buffer = $this->mail_get_line();
			}
		}
		$this->_current_folder = $boxname;
		return $boxinfo;
	}

	function mail_create_box($boxname) {
		/* create a new mailbox */
		/* choose the protocolor */
		if($this->mail_protocol == "imap") {
			$boxname = ereg_replace("\"(.*)\"","\\1",$boxname);
			$this->mail_send_command("CREATE \"$boxname\"");
			$buffer = $this->mail_get_line();

			if(eregi("^(".$this->_sid." OK)",$buffer)) {
				@mkdir($this->user_folder.$boxname,0777);
				return 1;
			} else { 
				$this->mail_error_msg = $buffer; return 0; 
			}

		} else {
			/* if POP3, only make a new folder */
			if(@mkdir($this->user_folder.$boxname,0777)) return 1;
			else return 0;

		}
	}

	function mail_delete_box($boxname) {
		if($this->mail_protocol == "imap") {

			$boxname = ereg_replace("\"(.*)\"","\\1",$boxname);
			$this->mail_send_command("DELETE \"$boxname\"");
			$buffer = $this->mail_get_line();

			if(eregi("^(".$this->_sid." OK)",$buffer)) {
				$this->_RmDirR($this->user_folder.$boxname);
				return 1;
			} else { 
				$this->mail_error_msg = $buffer; 
				return 0; 
			}

		} else {
			if(is_dir($this->user_folder.$boxname)) {
				$this->_RmDirR($this->user_folder.$boxname);
				return 1;
			} else {
				return 0;
			}
		}
	}


	function mail_save_message($boxname,$message,$flags = "") {

		if($this->mail_protocol == "imap") {
			$boxname = ereg_replace("\"(.*)\"","\\1",$boxname);
			$this->mail_send_command("APPEND \"$boxname\" ($flags) {".strlen($message)."}");
			$this->mail_send_command("$message\r\n");
			$buffer = $this->mail_get_line();
			if($buffer[0] == "+") {
				$this->mail_send_command("\r\n");
				$buffer = $this->mail_get_line();
			}
			if(!eregi("^(".$this->_sid." OK)",$buffer)) return 0; 
		}

		if(is_dir($this->user_folder.$boxname)) {
			$email = $this->fetch_structure($message);
			$mail_info = $this->get_mail_info($email["header"]);
			$filename = $this->_get_local_name($mail_info,$boxname);
			if(!empty($flags))
				$message = trim($email["header"])."\r\nX-UM-Flags: $flags\r\n\r\n".$email["body"];
			unset($email);
			$this->_save_file($filename,$message);
			return 1;
		}

	}

	function mail_set_flag(&$msg,$flagname,$flagtype = "+") {

		$flagname = strtoupper($flagname);
		if($this->mail_protocol == "imap") {

			if(strtolower($this->_current_folder) != strtolower($msg["folder"]))
				$this->mail_select_box($msg["folder"]);

			if($flagtype != "+") $flagtype = "-";
			$this->mail_send_command("STORE ".$msg["id"].":".$msg["id"]." ".$flagtype."FLAGS ($flagname)");
			$buffer = $this->mail_get_line();

			while(!eregi("^(".$this->_sid." (OK|NO|BAD))",$buffer)) { 
				$buffer = $this->mail_get_line();
			}

			if(!eregi("^(".$this->_sid." OK)",$buffer)) { $this->mail_error_msg = $buffer; return 0;}

		}


		if(file_exists($msg["localname"])) {
	
			$email 		= $this->_read_file($msg["localname"]);
			$email		= $this->fetch_structure($email);
			$header 	= $email["header"];
			$body	 	= $email["body"];
			$headerinfo	= $this->decode_header($header);

			$strFlags 	= trim(strtoupper($msg["flags"]));


			$flags = Array();
			if(!empty($strFlags))
				$flags = split(" ",$strFlags);


			if($flagtype == "+") {
				if(!in_array($flagname,$flags))
					$flags[] = $flagname;
			} else {
				while(list($key,$value) = each($flags))
					if(strtoupper($value) == $flagname) 
						$pos = $key;
				if(isset($pos)) unset($flags[$pos]);
			}

			$flags = join(" ",$flags);

			if(!eregi("X-UM-Flags",$header))
				$header .= "\r\nX-UM-Flags: $flags";
			else
				$header = eregi_replace("X-UM-Flags: (.*)","X-UM-Flags: $flags",$header);


			$msg["header"]  = $header;
			$msg["flags"]	= $flags;
			$email = "$header\r\n\r\n$body";

			$this->_save_file($msg["localname"],$email);

			unset($email,$header,$body,$flags,$headerinfo);
		}
		return 1;
	}

	function mail_disconnect() {
		if($this->mail_connected()) {
			if($this->mail_protocol == "imap") {

				if($this->_require_expunge)
					$this->mail_expunge();

				$this->mail_send_command("LOGOUT");
				$tmp = $this->mail_get_line();

			} else
				$this->mail_send_command("QUIT");
	
			$tmp = $this->mail_get_line();
	        fclose($this->mail_connection);
			$this->mail_connection = "";
			return 1;
		} else return 0;
	
	}


	function mail_expunge() {
		if($this->mail_protocol == "imap") {
			$this->mail_send_command("EXPUNGE");
			$buffer = $this->mail_get_line();
			if(eregi("^(".$this->_sid." (NO|BAD))",$buffer)) { $this->mail_error_msg = $buffer; return 0; }
			while(!eregi("^(".$this->_sid." OK)",$buffer)) {
				$buffer = $this->mail_get_line();
			}
		}
		return 1;
	}


}
?>