<html>
<head>
<title>{TR_MAIN_INDEX_PAGE_TITLE}</title>
<meta http-equiv="Content-Type" content="text/html; charset={THEME_CHARSET}">
<link href="themes/modern_blue/css/vhcs.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="themes/modern_blue/css/vhcs.js"></script>
</head>
<body text="#000000">
<table width="100%" height="99%"  border="00" cellpadding="0" cellspacing="0" bgcolor="#334163">
  <tr>
    <td height="551"><table width="100%"  border="00" cellpadding="0" cellspacing="0">
      <tr bgcolor="#334163">
        <td>&nbsp;</td>
        <td align="right"><span class="login_time">{TR_TIME}</span>&nbsp;&nbsp;&nbsp;<br>
          <span class="login_bottom">{TR_DATE}</span>&nbsp;&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td width="1" background="themes/modern_blue/images/login/content_background.gif"><img src="themes/modern_blue/images/login/content_background.gif" width="1" height="348"></td>
        <td height="348" align="center" background="themes/modern_blue/images/login/content_background.gif">
		<form name="frm" action="chk_login.php" method="post">
		  <table border="00" cellspacing="0" cellpadding="0">
            <tr>
              <td width="20" rowspan="5"><img src="images/isp_logo.gif"></td>
              <td width="20" rowspan="5">&nbsp;</td>
              <td width="2" rowspan="5" background="themes/modern_blue/images/login/content_line.gif"><img src="themes/modern_blue/images/trans.gif" width="2" height="2"></td>
              <td width="20" rowspan="5">&nbsp;</td>
              <td><strong><div class="login_text">{TR_USERNAME}</div></strong></td>
            </tr>
            <tr>
              <td width="161"><input type="text" name="uname" value="" style="width:210px" class="textinput"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><strong><div class="login_text">{TR_PASSWORD}</div></strong></td>
            </tr>
            <tr>
              <td><input type="password" name="upass" value="" style="width:210px" class="textinput"></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
              <td background="themes/modern_blue/images/login/content_line.gif">&nbsp;</td>
              <td colspan="2">&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td background="themes/modern_blue/images/login/content_line.gif">&nbsp;</td>
              <td>&nbsp;</td>
              <td><input hidden type="submit" name="Submit" class="button" value="   {TR_LOGIN}   "></td>
            </tr>
          </table>
		  </form></td>
      </tr>
      <tr>
        <td width="1" height="2" background="themes/modern_blue/images/login/content_down.gif"><img src="themes/modern_blue/images/login/content_down.gif" width="2" height="2"></td>
        <td height="2" background="themes/modern_blue/images/login/content_down.gif"><img src="themes/modern_blue/images/login/content_down.gif" width="2" height="2"></td>
      </tr>
      <tr>
        <td width="1" bgcolor="#334163">&nbsp;</td>
        <td bgcolor="#334163"><a href="http://www.vhcs.net" target="_blank"><img src="themes/modern_blue/images/login/vhcs_logo.gif" alt="VHCS - Virtual Hosting Control System - Control Panel" width="68" height="60" border="0"></a><br><span class="login_bottom">{TR_VHCS_LICENSE}</span></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

