<?php
/*
  Weeble File Manager (c) Christopher Michaels & Jonathan Manna
  This software is released under the BSD License.  For a copy of
  the complete licensing agreement see the LICENSE file.
*/

  require_once ("settings.php");
  require_once ("tools/compat.php");
  require_once ("functions-ftp.php");
  require_once ("access_list.php");

  $cookie_array = array ( "", "", "" );
  $cookie_present = FALSE;

  if ( $ftp_disable_mcrypt ) {
    $ftp_remember_me = FALSE;
  } elseif ( extension_loaded ($mcrypt_mod) ) {
    if ( isset ($nocookie) ) {
      setcookie ( "WeebleFM_cookie", "", time(), "/", $HTTP_SERVER_VARS["SERVER_NAME"], 0);
      setcookie ( "WeebleFM_SID", "", time(), "/", $HTTP_SERVER_VARS["SERVER_NAME"], 0);
      setcookie ( "WeebleFM_Server", "", time(), "/", $HTTP_SERVER_VARS["SERVER_NAME"], 0);
    } elseif ( isset ($WeebleFM_cookie) && isset ($WeebleFM_SID) ) {
      $cookie_string = decrypt_string ( $WeebleFM_cookie, $key, $WeebleFM_SID, $pref_ciphers );
      $cookie_array = explode ( "::", $cookie_string, 2 );
      if ( isset ($WeebleFM_Server) ) $cookie_array[2] = $WeebleFM_Server;
      $cookie_present = TRUE;
    }
  } else {
    if (!isset ($ERROR)) $ERROR = 20;
    $ftp_remember_me = FALSE;
  }

  // If register_globals = off display an error.
  if ( !ini_get ("register_globals") && !isset ($ERROR) ) $ERROR = 21;
  elseif ( (phpversion() >= "4.0.3") && !ini_get ("file_uploads") && !isset ($ERROR) ) $ERROR = 22;
  elseif ( !extension_loaded ("ftp") && !isset ($ERROR) ) $ERROR = 23;
  elseif ( !isset ($ftp_Servers) && !isset ($ERROR) ) $ERROR = 10;

// Load the default theme into the login page.
  if ( @is_readable( "themes/" . $default_theme . ".thm" ) ) {
    $tp = fopen( "themes/" . $default_theme . ".thm", 'r' );
    $theme = load_theme( $tp );
    fclose ($tp);  
  }  
  $style = build_style_sheet( $theme );
  
  if (!isset($ERROR) ) $ERROR = 0;
?>
<html>
<head>
<title>VHCS File Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="/vhcs2/themes/modern_blue/css/vhcs.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/vhcs2/themes/modern_blue/css/css/vhcs.js"></script>
</head>
<body text="#000000">
<table width="100%" height="99%"  border="00" cellpadding="0" cellspacing="0" bgcolor="#334163">
  <tr>
    <td height="551"><table width="100%"  border="00" cellpadding="0" cellspacing="0">
      <tr bgcolor="#334163">
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td width="1" background="/vhcs2/themes/modern_blue/images/login/content_background.gif"><img src="/vhcs2/themes/modern_blue/images/login/content_background.gif" width="1" height="348"></td>
        <td height="348" align="center" background="/vhcs2/themes/modern_blue/images/login/content_background.gif">





<form name="form_Login" method="post" action="check_login.php">
  <p>&nbsp;</p>
  <table align="center" cellspacing="7">
    <tr >
      <td width="109"><div class="login_text"><strong>Username:</strong></div></td>
      <td width="209"><input name="ftp_User" type="text" style="width:210px" class="textinput" value="<?php echo $cookie_array[0] ?>" size="20">
      </td>
    </tr>
    <tr>
      <td><div class="login_text"><strong>Password:</strong></div></td>
      <td><input name="ftp_Pass" type="password" style="width:210px" class="textinput" value="<?php echo $cookie_array[1] ?>" size="20">
      </td>
    </tr>
    <?php
  if ( isset ($ftp_Servers) ) {
    echo "<tr><td align=\"left\" ><div class=\"login_text\"><strong>Server:</strong></div></td>";
    echo "<td><select name=\"login_server\">";
    while ( list ($key, $val) = each ($ftp_Servers) ) {
      echo "<option value=\"$key\"";
      if ( $cookie_array[2] == $key ) echo " SELECTED";
      echo ">$key</option>";
    }
    echo "</select></td></tr>";
  }
?>
    <tr>
      <td colspan=2 align="center" class="buttonBar"><input name="Submit" type="submit" class="button" value="Login" <?php if ($ERROR >= 10) echo "DISABLED"?>>
          <input name="Reset" type="reset" class="button" value="Reset">
      </td>
    </tr>
    <tr>
      <td colspan=2 align="center"><input type="checkbox" name="ftp_Remember" value="TRUE"
        <?php 
          if ( $cookie_present ) echo " CHECKED";
          if ( !$ftp_remember_me ) echo " DISABLED";  
        ?>
        >
      Remember Me </td>
    </tr>
    <?php
  if ( $cookie_present == TRUE ) {
    echo "    <tr class=\"alt_row\">";
    echo "      <td colspan=2 align=\"center\" style=\"font-size: smaller\">";
    echo "        <A href=\"$PHP_SELF?nocookie=1\">Remove Login Cookie</A>";
    echo "      </td>";
    echo "    </tr>";
  }
?>
  </table>
  <p>&nbsp;</p>
</form>
<P align="center">
  <?php 
    /*
      Error message definitions:
          0 = No error
       1- 9 = Non-fatal errors, login will still be allowed.
      10-19 = Fatal: Configuration (settings.php) based errors.
      20-29 = Fatal: PHP based errors (e.g. required module isn't installed.
      30-39 = Fatal: UnKnown
         99 = Fatal: Access Denied by configuration.
    */
    switch ( $ERROR )
    {
      case 1:
        echo "<B>Missing username or password.</B>";
        break;
      case 2:
        echo "<B>Server could not be found.</B>";
        break;
      case 3:
        echo "<B>Incorrect username or password.</B>";
        break;
      case 10:
        echo "<B>No FTP servers have been defined.</B><BR>Please contact your system administrator to correct this error.";
        break;
      case 20:
        echo "<B><EM>Encryption (mcrypt) support is broken or not compiled into PHP4.</EM><BR>Please contact your system administrator to correct this error.</B>";
        break;
      case 21:
        echo "<B><EM>register_globals=off</EM><BR>Please contact your system administrator to correct this error.</B>";
        break;
      case 22:
        echo "<B><EM>file_uploads=off</EM><BR>Please contact your system administrator to correct this error.</B>";
        break;
      case 23:
        echo "<B><EM>FTP module is broken or not compiled into PHP4.</EM><BR>Please contact your system administrator to correct this error.</B>";
        break;
      case 99:
        echo "<B><EM>Access denied by WeebleFM configuration.</EM></B>";
        break;
    }
  ?>
  
  
  
  
  
  
</td>
      </tr>
      <tr>
        <td width="1" height="2" background="/vhcs2/themes/modern_blue/images/login/content_down.gif"><img src="/vhcs2/themes/modern_blue/images/login/content_down.gif" width="2" height="2"></td>
        <td height="2" background="/vhcs2/themes/modern_blue/images/login/content_down.gif"><img src="/vhcs2/themes/modern_blue/images/login/content_down.gif" width="2" height="2"></td>
      </tr>
      <tr>
        <td width="1" bgcolor="#334163">&nbsp;</td>
        <td bgcolor="#334163"><a href="http://www.vhcs.net" target="_blank"><img src="/vhcs2/themes/modern_blue/images/login/vhcs_logo.gif" alt="VHCS - Virtual Hosting Control System - Control Panel" width="68" height="60" border="0"></a><br><span class="login_bottom">VHCS FileManager by <br>Jon Manna & Chris Michaels</span></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
