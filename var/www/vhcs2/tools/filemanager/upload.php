<?php
/*
  Weeble File Manager (c) Christopher Michaels & Jonathan Manna
  This software is released under the BSD License.  For a copy of
  the complete licensing agreement see the LICENSE file.
*/

  require_once ("settings.php");
  require_once ("tools/compat.php");
  require_once ("functions-ftp.php");
  require_once ("header.php");

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>VHCS File Manager</title>
<link href="/vhcs2/tools/filemanager/themes/vhcs.css" rel="stylesheet" type="text/css">

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr>
    <td height="80" align="left" valign="top">
    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="17"><img src="/vhcs2/themes/modern_blue/images/top/left.jpg" width="17" height="80"></td>
          <td width="198" align="center" background="/vhcs2/themes/modern_blue/images/top/logo_background.jpg"><img src="/vhcs2/images/isp_logo.gif"></td>
          <td background="/vhcs2/themes/modern_blue/images/top/left_fill.jpg"><img src="/vhcs2/themes/modern_blue/images/top/left_fill.jpg" width="2" height="80"></td>
          <td width="766"><img src="/vhcs2/themes/modern_blue/images/top/middle_background.jpg" width="766" height="80"></td>
          <td background="/vhcs2/themes/modern_blue/images/top/right_fill.jpg"><img src="/vhcs2/themes/modern_blue/images/top/right_fill.jpg" width="3" height="80"></td>
          <td width="9"><img src="/vhcs2/themes/modern_blue/images/top/right.jpg" width="9" height="80"></td>
        </tr>
    </table></td>
  </tr>
  <tr background="images/content_background_mainpage.gif">
    <td valign="top">




	  <form name="form_listing" method="post" action="crossover.php" enctype="multipart/form-data">
      <input type=hidden name="SID" value="<?php echo $SID ?>">
      <table border=0 cellspacing=0 cellpadding=2 width="99%">
       <tr>
        <td class="border">






  <table border=0 align="center" cellpadding=2 cellspacing=0>
   <tr>
    <td class="border">
      <table width="100%"  border="0" cellspacing="2" cellpadding="1">
        <tr>
          <td align="right"><span class="content"><a href="crossover.php?SID=<?php echo $SID ?>&submit=LOGOUT"><b>Logout</b></a></span></td>
        </tr>
      </table>
     <table cellspacing=2 cellpadding=1 border=0 width="100%" class="manager">
      <form name="form_listing" method="post" action="crossover.php" enctype="multipart/form-data">
      <input type=hidden name="SID" value="<?php echo $SID ?>">
      <tr>
       <td class="content" colspan=2><?php echo $sess_Data["user"] ." @ ".$sess_Data["Server Name"] ?></td>
      </tr>
      <tr>
       <td class="content2">Current Directory: <input type="text" class="textinput" value="<?php echo ftp_pwd($fp) ?>" size=40 readonly></td>
       <td align="right" class="content2"><input name="submit" type="submit" class="button" value="Cancel"></td>
      </tr>
      </form>
     </table>
    </td>
   </tr>
   <form name="form_listing" method="post" action="crossover.php" enctype="multipart/form-data">
   <tr>
    <td class="border">
     <table cellspacing=2 cellpadding=1 border=0 width="100%" class="manager">
<?php
  for ( $x=1; $x <= $ftp_max_uploads; $x++ ) {
    $iName = "UPLOAD_FILE_".$x;
    echo "      <tr><td align=\"right\" class=\"".$alt_class[($x % 2)]."\"><input type=\"file\" class=\"textinput\" name=\"$iName\" size=".$editor_prefs["cols"]."></td></tr>\n";
  }
?>
     </table>
    </td>
   </tr>
   <tr class="buttonBar">
    <td align="center" class="content2"><input name="submit" type="submit" class="button" value="Upload"> | | <input type="reset" class="button" value="Reset"></td>
   </tr>
   <input type=hidden name="SID" value="<?php echo $SID ?>">
   </form>
  </table>
  
  
  
  
  
  
  
  
  
  
  
  
 </td>
  </tr>
  <tr>
    <td height="71" background="images/background_down.gif"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr><td width="17"><img src="/vhcs2/themes/modern_blue/images/top/down_left.jpg" width="17" height="71"></td><td width="198" valign="top" background="/vhcs2/themes/modern_blue/images/top/downlogo_background.jpg"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="55"><a href="http://www.vhcs.net" target="_blank"><img src="/vhcs2/themes/modern_blue/images/vhcs.gif" alt="" width="51" height="71" border="0"></a></td>
            <td class="bottom">VHCS FileManager by <br>Jon Manna & Chris Michaels</td>
          </tr>
        </table>          </td>
          <td background="/vhcs2/themes/modern_blue/images/top/down_left_fill.jpg"><img src="/vhcs2/themes/modern_blue/images/top/down_left_fill.jpg" width="2" height="71"></td><td width="766" background="/vhcs2/themes/modern_blue/images/top/middle_background.jpg"><img src="/vhcs2/themes/modern_blue/images/top/down_middle_background.jpg" width="766" height="71"></td>
          <td background="/vhcs2/themes/modern_blue/images/top/down_right_fill.jpg"><img src="/vhcs2/themes/modern_blue/images/top/down_right_fill.jpg" width="3" height="71"></td>
          <td width="9"><img src="/vhcs2/themes/modern_blue/images/top/down_right.jpg" width="9" height="71"></td></tr>
    </table></td>
  </tr>
</table>
</body>
</html>