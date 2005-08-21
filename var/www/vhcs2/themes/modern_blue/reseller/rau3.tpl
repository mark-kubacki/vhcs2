<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={THEME_CHARSET}">
<title>{TR_ADD_USER_PAGE_TITLE}</title>
<link href="{THEME_COLOR_PATH}/css/vhcs.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{THEME_COLOR_PATH}/css/vhcs.js"></script>
<script>
<!--
function change_status(dom_id) {
	if (!confirm("{TR_MESSAGE_CHANGE_STATUS}"))
		return false;

	location = ('change_status.php?domain_id=' + dom_id);
}

function delete_account(url) {
	if (!confirm("{TR_MESSAGE_DELETE_ACCOUNT}"))
		return false;

	location = url;
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
//-->
</script>

</head>
<body onLoad="MM_preloadImages('{THEME_COLOR_PATH}/images/icons/database_a.gif','{THEME_COLOR_PATH}/images/icons/hosting_plans_a.gif','{THEME_COLOR_PATH}/images/icons/domains_a.gif','{THEME_COLOR_PATH}/images/icons/general_a.gif','{THEME_COLOR_PATH}/images/icons/logout_a.gif','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif','{THEME_COLOR_PATH}/images/icons/webtools_a.gif','{THEME_COLOR_PATH}/images/icons/statistics_a.gif','{THEME_COLOR_PATH}/images/icons/support_a.gif')">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr>
    <td height="80" align="left" valign="top">
	<!-- BDP: logged_from --><table width="100%"  border="00" cellspacing="0" cellpadding="0">
      <tr>
        <td height="20" nowrap background="{THEME_COLOR_PATH}/images/button.gif">&nbsp;&nbsp;&nbsp;<a href="change_user_interface.php?action=go_back"><img src="{THEME_COLOR_PATH}/images/icons/close_interface.gif" width="18" height="18" border="0" align="absmiddle"></a> <font color="red">{YOU_ARE_LOGGED_AS}</font> </td>
      </tr>
    </table>
	<!-- EDP: logged_from -->
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
            <td width="60" background="{THEME_COLOR_PATH}/images/menu/menu_top_left_bckgr.jpg"><img src="{THEME_COLOR_PATH}/images/icons/manage_users_big.gif" width="60" height="62"></td>
            <td width="151" background="{THEME_COLOR_PATH}/images/menu/menu_top_bckgr.jpg" class="title">{TR_MENU_MANAGE_USERS}</td>
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
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="index.php" onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" name="Image1" width="28" height="36" border="0" id="Image1"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="index.php" class="menu"  onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_GENERAL_INFORMATION}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="index.php" onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/general.gif" name="domains" width="36" height="36" border="0" id="domains"></a></td>
          </tr>
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
          </tr>
  <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="hp.php" onMouseOver="MM_swapImage('hosting_plans','','{THEME_COLOR_PATH}/images/icons/hosting_plans_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
      <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="hp.php" class="menu"  onMouseOver="MM_swapImage('hosting_plans','','{THEME_COLOR_PATH}/images/icons/hosting_plans_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_HOSTING_PLANS}</a></td>
      <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="hp.php" onMouseOver="MM_swapImage('hosting_plans','','{THEME_COLOR_PATH}/images/icons/hosting_plans_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/hosting_plans.gif" name="hosting_plans" width="36" height="36" border="0" id="hosting_plans"></a></td>
  </tr>
  <tr>
    <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
  </tr>
  <tr>
    <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="orders.php" onMouseOver="MM_swapImage('orders','','{THEME_COLOR_PATH}/images/icons/purchasing_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
    <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="orders.php" class="menu"  onMouseOver="MM_swapImage('orders','','{THEME_COLOR_PATH}/images/icons/purchasing_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_ORDERS}</a></td>
    <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="orders.php" onMouseOver="MM_swapImage('orders','','{THEME_COLOR_PATH}/images/icons/purchasing_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/purchasing.gif" name="orders" width="36" height="36" border="0" id="hosting_plans"></a></td>
  </tr>
  <tr>
    <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
  </tr>
  <tr>
  <tr>
    <td width="28" background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="users.php" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/open_pointer.jpg" width="28" height="36" border="0"></a></td>
    <td background="{THEME_COLOR_PATH}/images/menu/open_background.gif" class="menu"><a href="users.php" class="menu_active" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_MANAGE_USERS}</a></td>
    <td width="36" align="right" background="{THEME_COLOR_PATH}/images/menu/open_icon_bcgr.jpg" class="menu"><a href="users.php" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/manage_users_a.gif" name="general" width="36" height="36" border="0" id="general"></a></td>
  </tr>
  <tr background="{THEME_COLOR_PATH}/images/menu/open_background.jpg">
    <td colspan="3" class="menu" background="{THEME_COLOR_PATH}/images/menu/open_background.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="5" rowspan="10" background="{THEME_COLOR_PATH}/images/menu/open_background_left.gif"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="12" height="1"></td>
          <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
          <td><a href="users.php" class="submenu">{TR_MENU_OVERVIEW}</a></td>
          <td width="5" rowspan="10" background="{THEME_COLOR_PATH}/images/menu/open_background_right.gif"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="5" height="1"></td>
        </tr>
        <tr>
          <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
        </tr>
        <tr>
          <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
          <td><a href="rau1.php" class="submenu">{TR_MENU_ADD_USER}</a></td>
        </tr>
        <tr>
          <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
        </tr>
        <tr>
          <td width="15"><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
          <td><a href="domain_alias.php" class="submenu">{TR_MENU_DOMAIN_ALIAS}</a></td>
        </tr>
        <tr>
          <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
        </tr>
        <tr>
          <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
          <td><a href="email_setup.php" class="submenu">{TR_MENU_E_MAIL_SETUP}</a></td>
        </tr>
        <tr>
          <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
        </tr>
        <tr>
          <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
          <td><a href="circular.php" class="submenu">{TR_MENU_CIRCULAR}</a></td>
        </tr>
        <tr>
          <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
        </tr>
    </table></td>
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
  <tr>
    <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="reseller_user_statistics.php" onMouseOver="MM_swapImage('statistics','','{THEME_COLOR_PATH}/images/icons/statistics_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
    <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="reseller_user_statistics.php" class="menu" onMouseOver="MM_swapImage('statistics','','{THEME_COLOR_PATH}/images/icons/statistics_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_DOMAIN_STATISTICS}</a></td>
    <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="reseller_user_statistics.php" onMouseOver="MM_swapImage('statistics','','{THEME_COLOR_PATH}/images/icons/statistics_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/statistics.gif" name="statistics" width="36" height="36" border="0" id="statistics"></a></td>
  </tr>
  <!-- BDP: support_system -->
  <tr>
    <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
  </tr>
  <tr>
    <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="{SUPPORT_SYSTEM_PATH}" target="{SUPPORT_SYSTEM_TARGET}"  onMouseOver="MM_swapImage('support','','{THEME_COLOR_PATH}/images/icons/support_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
    <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="{SUPPORT_SYSTEM_PATH}" target="{SUPPORT_SYSTEM_TARGET}"  class="menu" onMouseOver="MM_swapImage('support','','{THEME_COLOR_PATH}/images/icons/support_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_QUESTIONS_AND_COMMENTS}</a></td>
    <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="{SUPPORT_SYSTEM_PATH}" target="{SUPPORT_SYSTEM_TARGET}"  onMouseOver="MM_swapImage('support','','{THEME_COLOR_PATH}/images/icons/support_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/support.gif" name="support" width="36" height="36" border="0" id="support"></a></td>
  </tr>
  <!-- EDP: support_system -->
  <tr>
    <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
  </tr>
  <!-- BDP: custom_buttons -->
  <tr>
    <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="{BUTTON_LINK}" {BUTTON_TARGET}  onMouseOver="MM_swapImage('custom_link_{BUTTON_ID}','','{THEME_COLOR_PATH}/images/icons/custom_link_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
    <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="{BUTTON_LINK}" {BUTTON_TARGET} class="menu" onMouseOver="MM_swapImage('custom_link_{BUTTON_ID}','','{THEME_COLOR_PATH}/images/icons/custom_link_a.gif',1)" onMouseOut="MM_swapImgRestore()">{BUTTON_NAME}</a></td>
    <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="{BUTTON_LINK}" {BUTTON_TARGET}  onMouseOver="MM_swapImage('custom_link_{BUTTON_ID}','','{THEME_COLOR_PATH}/images/icons/custom_link_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/custom_link.gif" name="custom_link_{BUTTON_ID}" width="36" height="36" border="0" id="custom_link_{BUTTON_ID}"></a></td>
  </tr>
  <tr>
    <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
  </tr>
  <!-- EDP: custom_buttons -->
  <tr>
    <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="../index.php" onMouseOver="MM_swapImage('logout','','{THEME_COLOR_PATH}/images/icons/logout_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
    <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="../index.php" class="menu" onMouseOver="MM_swapImage('logout','','{THEME_COLOR_PATH}/images/icons/logout_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_LOGOUT}</a></td>
    <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="../index.php" onMouseOver="MM_swapImage('logout','','{THEME_COLOR_PATH}/images/icons/logout_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/logout.gif" name="logout" width="36" height="36" border="0" id="logout"></a></td>
  </tr>
        </table></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="62" align="left" background="{THEME_COLOR_PATH}/images/content/table_background.jpg" class="title"><img src="{THEME_COLOR_PATH}/images/content/table_icon_user.jpg" width="85" height="62" align="absmiddle">{TR_ADD_USER}</td>
            <td width="27" align="right" background="{THEME_COLOR_PATH}/images/content/table_background.jpg"><img src="{THEME_COLOR_PATH}/images/content/table_icon_close.jpg" width="27" height="62"></td>
          </tr>
          <tr>
            <td valign="top">
			
			<!-- BDP: add_user -->
			<form name="reseller_add_users_first_frm" method="post" action="rau3.php">
			  <input type="hidden" name="uaction" value="rau3_nxt">
              <table width="100%" cellpadding="5" cellspacing="5">
                <!-- BDP: page_message -->
				<tr>
                  <td width="20">&nbsp;</td>
                  <td colspan="2" class="title"><font color="#FF0000">{MESSAGE}</font></td>
                </tr>
				<!-- EDP: page_message -->
                <tr>
                  <td width="20">&nbsp;</td>
                  <td colspan="2" class="content3"><b>{TR_CORE_DATA}</b></td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td class="content2" width="200">{TR_USERNAME}</td>
                  <td class="content">{VL_USERNAME}</td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td class="content2" width="200">{TR_PASSWORD}</td>
                  <td class="content"><input type="password" name=userpassword value="{VL_USR_PASS}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td class="content2" width="200">{TR_REP_PASSWORD}</td>
                  <td class="content"><input type="password" name=userpassword_repeat value="{VL_USR_PASS_REP}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td class="content2" width="200">{TR_DMN_IP}</td>
                  <td class="content"><select name="domain_ip">
                      <!-- BDP: ip_entry -->
                      <option value="{IP_VALUE}" {ip_selected}>{IP_NUM}&nbsp;({IP_NAME})</option>
                      <!-- EDP: ip_entry -->
                    </select>
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td class="content2" width="200">{TR_USREMAIL}</td>
                  <td class="content"><input type="text" name=useremail value="{VL_MAIL}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="content2">{TR_ADD_ALIASES}</td>
                  <td class="content"><input name="add_alias" type="checkbox" id="add_alias" value="on"></td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td colspan="2" class="content3"><b>{TR_ADDITIONAL_DATA}</b></td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td width="200" class="content2">{TR_CUSTOMER_ID}</td>
                  <td class="content"><input type="text" name=useruid value="{VL_USR_ID}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td width="200" class="content2">{TR_FIRSTNAME}</td>
                  <td class="content"><input type="text" name=userfname value="{VL_USR_NAME}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td width="200" class="content2">{TR_LASTNAME}</td>
                  <td class="content"><input type="text" name=userlname value="{VL_LAST_USRNAME}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td width="200" class="content2">{TR_COMPANY}</td>
                  <td class="content"><input type="text" name=userfirm value="{VL_USR_FIRM}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td width="200" class="content2">{TR_POST_CODE}</td>
                  <td class="content"><input type="text" name=userzip value="{VL_USR_POSTCODE}" style="width:80px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td width="200" class="content2">{TR_CITY}</td>
                  <td class="content"><input type="text" name=usercity value="{VL_USRCITY}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td width="200" class="content2">{TR_COUNTRY}</td>
                  <td class="content"><input type="text" name=usercountry value="{VL_COUNTRY}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td width="200" class="content2">{TR_STREET1}</td>
                  <td class="content"><input type="text" name=userstreet1 value="{VL_STREET1}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td width="200" class="content2">{TR_STREET2}</td>
                  <td class="content"><input type="text" name=userstreet2 value="{VL_STREET2}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td width="200" class="content2">{TR_PHONE}</td>
                  <td class="content"><input type="text" name=userphone value="{VL_PHONE}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td width="20">&nbsp;</td>
                  <td width="200" class="content2">{TR_FAX}</td>
                  <td class="content"><input type="text" name=userfax value="{VL_FAX}" style="width:210px" class="textinput">
                  </td>
                </tr>
                <tr>
                  <td>&nbsp;
                    </td>
                  <td colspan="2"><font color="#FF0000">
                    <input name="Submit" type="submit" class="button" value="  {TR_BTN_ADD_USER}  ">
                  </font></td>
                  </tr>
              </table>
			</form>
			<!-- EDP: add_user -->
			
			
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
