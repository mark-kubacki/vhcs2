<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={THEME_CHARSET}">
<title>VHCS - Virtual Hosting Conrol System</title>
<link href="{THEME_COLOR_PATH}/css/vhcs.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{THEME_COLOR_PATH}/css/vhcs.js"></script>
<script>
function sbmt(form, uaction) {

    form.uaction.value = uaction;
    form.submit();
    
    return false;

}

</script>
</head>

<body onLoad="MM_preloadImages('{THEME_COLOR_PATH}/images/icons/database_a.gif','{THEME_COLOR_PATH}/images/icons/hosting_plans_a.gif','{THEME_COLOR_PATH}/images/icons/domains_a.gif','{THEME_COLOR_PATH}/images/icons/general_a.gif','{THEME_COLOR_PATH}/images/icons/logout_a.gif','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif','{THEME_COLOR_PATH}/images/icons/webtools_a.gif','{THEME_COLOR_PATH}/images/icons/statistics_a.gif','{THEME_COLOR_PATH}/images/icons/support_a.gif')">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr>
    <td height="80" align="left" valign="top">
    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="17"><img src="{THEME_COLOR_PATH}/images/top/left.jpg" width="17" height="80"></td>
          <td width="198" align="center" background="{THEME_COLOR_PATH}/images/top/logo_background.jpg"><img src="{ISP_LOGO}"></td>
          <td background="{THEME_COLOR_PATH}/images/top/left_fill.jpg"><img src="{THEME_COLOR_PATH}/images/top/left_fill.jpg" width="2" height="80"></td>
          <td width="766"><img src="{THEME_COLOR_PATH}/images/top/middle_background.jpg" width="766" height="80"></td>
          <td background="{THEME_COLOR_PATH}/images/top/right_fill.jpg"><img src="{THEME_COLOR_PATH}/images/top/right_fill.jpg" width="3" height="80"></td>
          <td width="9"><img src="{THEME_COLOR_PATH}/images/top/right.jpg" width="9" height="80"></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><table height="100%" width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="215" valign="top" bgcolor="#F5F5F5">
		<table width="211" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="60" background="{THEME_COLOR_PATH}/images/menu/menu_top_left_bckgr.jpg"><img src="{THEME_COLOR_PATH}/images/icons/general_big.gif" width="60" height="62"></td>
            <td width="151" background="{THEME_COLOR_PATH}/images/menu/menu_top_bckgr.jpg" class="title">{TR_MENU_GENERAL_INFORMATION}</td>
          </tr>
        </table>
		<table width="205" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F5F5F5">
          <tr background="{THEME_COLOR_PATH}/images/line.jpg">
            <td colspan="3" background="{THEME_COLOR_PATH}/images/line.jpg"><img src="{THEME_COLOR_PATH}/images/line.jpg" width="2" height="7"><img src="{THEME_COLOR_PATH}/images/line.jpg" width="2" height="7"></td>
            </tr>
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
          </tr>
          <tr>
            <td width="28" background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="#" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/open_pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/open_background.gif" class="menu"><a href="index.php" class="menu_active" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_GENERAL_INFORMATION}</a></td>
            <td width="36" align="right" background="{THEME_COLOR_PATH}/images/menu/open_icon_bcgr.jpg" class="menu"><a href="#" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/general_a.gif" name="general" width="36" height="36" border="0" id="general"></a></td>
          </tr>
          <tr background="{THEME_COLOR_PATH}/images/menu/open_background.jpg">
            <td colspan="3" class="menu" background="{THEME_COLOR_PATH}/images/menu/open_background.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5" rowspan="12" background="{THEME_COLOR_PATH}/images/menu/open_background_left.gif"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="12" height="1"></td>
                <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="index.php" class="submenu">{TR_MENU_OVERVIEW}</a></td>
                <td width="5" rowspan="12" background="{THEME_COLOR_PATH}/images/menu/open_background_right.gif"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="5" height="1"></td>
              </tr>
              <tr>
                <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
                </tr>
              <tr>
                <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="change_password.php" class="submenu">{TR_MENU_CHANGE_PASSWORD}</a></td>
                </tr>
              <tr>
                <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
              </tr>
              <tr>
                <td width="15"><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="change_personal.php" class="submenu">{TR_MENU_CHANGE_PERSONAL_DATA}</a></td>
              </tr>
              <tr>
                <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
              </tr>
              <tr>
                <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="multilanguage.php" class="submenu">{TR_MENU_I18N}</a></td>
              </tr>
              <tr>
                <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
                </tr>
              <tr>
                <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="layout.php" class="submenu">{TR_MENU_LAYOUT_TEMPLATES}</a></td>
              </tr>
              <tr>
                <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
                </tr>
              <tr>
                <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="custom_menus.php" class="submenu">{TR_CUSTOM_MENUS}</a></td>
              </tr>
              <tr>
                <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
              </tr>
            </table>
            </td>
          </tr>
          <tr>
            <td class="menu"><img src="{THEME_COLOR_PATH}/images/menu/open_down_left.gif" width="28" height="7"></td>
            <td background="{THEME_COLOR_PATH}/images/menu/open_down.gif" class="menu"><img src="{THEME_COLOR_PATH}/images/menu/open_down.gif" width="4" height="7"></td>
            <td align="right" class="menu"><img src="{THEME_COLOR_PATH}/images/menu/open_down_right.gif" width="36" height="7"></td>
          </tr>
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
			 <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="manage_users.php" onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" name="Image1" width="28" height="36" border="0" id="Image1"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="manage_users.php" class="menu"  onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_MANAGE_USERS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="manage_users.php" onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/manage_users.gif" name="domains" width="36" height="36" border="0" id="domains"></a></td>
          </tr>
		   <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
		   <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="sysinfo.php" onMouseOver="MM_swapImage('webtools','','{THEME_COLOR_PATH}/images/icons/webtools_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="sysinfo.php" class="menu"  onMouseOver="MM_swapImage('webtools','','{THEME_COLOR_PATH}/images/icons/webtools_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_SYSTEM_TOOLS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="sysinfo.php" onMouseOver="MM_swapImage('webtools','','{THEME_COLOR_PATH}/images/icons/webtools_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/webtools.gif" name="webtools" width="36" height="36" border="0" id="webtools"></a></td>
          </tr>
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
		   <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="server_statistic.php" onMouseOver="MM_swapImage('statistics','','{THEME_COLOR_PATH}/images/icons/statistics_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="server_statistic.php" class="menu" onMouseOver="MM_swapImage('statistics','','{THEME_COLOR_PATH}/images/icons/statistics_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_STATISTICS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="server_statistic.php" onMouseOver="MM_swapImage('statistics','','{THEME_COLOR_PATH}/images/icons/statistics_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/statistics.gif" name="statistics" width="36" height="36" border="0" id="statistics"></a></td>
          </tr>
		  <!-- BDP: support_system -->
		  <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
		   <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="{SUPPORT_SYSTEM_PATH}" target="{SUPPORT_SYSTEM_TARGET}"  onMouseOver="MM_swapImage('support','','{THEME_COLOR_PATH}/images/icons/support_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="{SUPPORT_SYSTEM_PATH}" target="{SUPPORT_SYSTEM_TARGET}"  class="menu" onMouseOver="MM_swapImage('support','','{THEME_COLOR_PATH}/images/icons/support_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_SUPPORT_SYSTEM}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="{SUPPORT_SYSTEM_PATH}" target="{SUPPORT_SYSTEM_TARGET}"  onMouseOver="MM_swapImage('support','','{THEME_COLOR_PATH}/images/icons/support_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/support.gif" name="support" width="36" height="36" border="0" id="support"></a></td>
          </tr>
		  <!-- EDP: support_system -->
		   <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
		   <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="../index.php" onMouseOver="MM_swapImage('logout','','{THEME_COLOR_PATH}/images/icons/logout_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="../index.php" class="menu" onMouseOver="MM_swapImage('logout','','{THEME_COLOR_PATH}/images/icons/logout_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_LOGOUT}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="../index.php" onMouseOver="MM_swapImage('logout','','{THEME_COLOR_PATH}/images/icons/logout_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/logout.gif" name="logout" width="36" height="36" border="0" id="logout"></a></td>
          </tr>
        </table></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="62" align="left" background="{THEME_COLOR_PATH}/images/content/table_background.jpg" class="title"><img src="{THEME_COLOR_PATH}/images/content/table_icon_layout.jpg" width="85" height="62" align="absmiddle">{TR_LAYOUT_SETTINGS}</td>
            <td width="27" align="right" background="{THEME_COLOR_PATH}/images/content/table_background.jpg"><img src="{THEME_COLOR_PATH}/images/content/table_icon_close.jpg" width="27" height="62"></td>
          </tr>
          <tr>
            <td>
			<!-- BDP: props_list -->
			
			<table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td width="30">&nbsp;</td>
                <td align="left"><form enctype="multipart/form-data" name="set_layout" method="post" action="layout.php"> 
			<!-- BDP: page_message -->
            <div align="lext" class="title"><font color="#FF0000">{MESSAGE}</font></span>
             <!-- EDP: page_message -->
             <table width="100%" cellpadding="5" cellspacing="5">
              <tr> 
                <td colspan="2" class="content3"><b>{TR_UPLOAD_LOGO}</b></td>
              </tr>
              <tr> 
                <td width="230" class="content2" nowrap>{TR_LOGO_FILE}</td>
                <td class="content" nowrap> 
                  <input type="file" name="logo_file">
                </td>
              </tr>
            </table>
			<input name="Button" type="button" class="button" value="  {TR_SAVE}  " onClick="return sbmt(document.forms[0],'upload_logo');">
			
            <input type="hidden" name="uaction" value="">
			</form>
            <!-- end of content -->
            <p><img src="{ISP_LOGO}" alt="reseller logo"><br>
            </p>
				
				
				</td>
                </tr>
            </table>
			<!-- EDP: props_list -->
			
			
			
			</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="71"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr><td width="17"><img src="{THEME_COLOR_PATH}/images/top/down_left.jpg" width="17" height="71"></td><td width="198" valign="top" background="{THEME_COLOR_PATH}/images/top/downlogo_background.jpg"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
          <tr>
            <td width="55"><a href="http://www.vhcs.net" target="_blank"><img src="{THEME_COLOR_PATH}/images/vhcs.gif" alt="" width="51" height="71" border="0"></a></td>
            <td class="bottom">{VHCS_LICENSE}</td>
          </tr>
        </table>          </td>
          <td background="{THEME_COLOR_PATH}/images/top/down_left_fill.jpg"><img src="{THEME_COLOR_PATH}/images/top/down_left_fill.jpg" width="2" height="71"></td><td width="766" background="{THEME_COLOR_PATH}/images/top/middle_background.jpg"><img src="{THEME_COLOR_PATH}/images/top/down_middle_background.jpg" width="766" height="71"></td>
          <td background="{THEME_COLOR_PATH}/images/top/down_right_fill.jpg"><img src="{THEME_COLOR_PATH}/images/top/down_right_fill.jpg" width="3" height="71"></td>
          <td width="9"><img src="{THEME_COLOR_PATH}/images/top/down_right.jpg" width="9" height="71"></td></tr>
    </table></td>
  </tr>
</table>
</body>
</html>
