<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={THEME_CHARSET}">
<title>{TR_CLIENT_CHANGE_PERSONAL_DATA_PAGE_TITLE}</title>
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
function sbmt(form, uaction) {

    form.details.value = uaction;
    form.submit();
    
    return false;

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
            <td height="62" align="left" background="{THEME_COLOR_PATH}/images/content/table_background.jpg" class="title"><img src="{THEME_COLOR_PATH}/images/content/table_icon_users.jpg" width="85" height="62" align="absmiddle">{TR_MANAGE_USERS}</td>
            <td width="27" align="right" background="{THEME_COLOR_PATH}/images/content/table_background.jpg"><img src="{THEME_COLOR_PATH}/images/content/table_icon_close.jpg" width="27" height="62"></td>
          </tr>
          <tr>
            <td>
			<form name="search_user" method="post" action="users.php">
            <table width="100%" cellspacing="3">
			  

              <tr>
                <td colspan="9" nowrap>&nbsp;</td>
              </tr>
			  <!-- BDP: page_message -->
              <tr>
                <td>&nbsp;</td>
                <td colspan="8" class="title"><font color="#FF0000">{MESSAGE}</font></td>
                </tr>
              <tr>
			  <!-- EDP: page_message -->
                <td>&nbsp;</td>
                <td colspan="6"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td nowrap><input name="search_for" type="text" class="textinput" value="{SEARCH_FOR}" style="width:140px">
                        <select name="search_common" class="textinput">
                          <option value="domain_name" {M_DOMAIN_NAME_SELECTED}>{M_DOMAIN_NAME}</option>
                          <option value="customer_id" {M_CUSTOMER_ID_SELECTED}>{M_CUSTOMER_ID}</option>
                          <option value="lname" {M_LAST_NAME_SELECTED}>{M_LAST_NAME}</option>
                          <option value="firm" {M_COMPANY_SELECTED}>{M_COMPANY}</option>
                          <option value="city" {M_CITY_SELECTED}>{M_CITY}</option>
                          <option value="country" {M_COUNTRY_SELECTED}>{M_COUNTRY}</option>
                        </select>
                        <select name="search_status" class="textinput">
                          <option value="all" {M_ALL_SELECTED}>{M_ALL}</option>
                          <option value="ok" {M_OK_SELECTED}>{M_OK}</option>
                          <option value="disabled" {M_SUSPENDED_SELECTED}>{M_SUSPENDED}</option>
                      </select></td>
                    <td nowrap><input name="Submit" type="submit" class="button" value=" {TR_SEARCH} ">
                    </td>
                  </tr>
                </table></td>
                <td colspan="2" align="right">
				<input type="hidden" name="details" value="">
				<img src="{THEME_COLOR_PATH}/images/icons/show_alias.jpg" width="15" height="16" align="absmiddle"> <a href="#" class="link" onClick="return sbmt(document.forms[0],'{SHOW_DETAILS}');">{TR_VIEW_DETAILS}</a></td>
                </tr>
              <tr>
                <td width="20">&nbsp;</td> 
                <td class="content3" width="20" align="center"><b>{TR_NO}</b></td>
                <td class="content3"><b>{TR_USERNAME}</b></td>
                <td class="content3" width="90" align="center"><b>{TR_CREATION_DATE}</b></td>
                <td colspan="5" align="center" class="content3"><b>{TR_ACTION}</b></td>
				</tr>
			  <!-- BDP: users_list -->
			  <!-- BDP: user_entry -->
              <tr>
                <td align="center">&nbsp;</td> 
                <td class="{CLASS_TYPE_ROW}" align="center"><a href="#" onClick="change_status('{URL_CHNAGE_STATUS}')"><img src="{THEME_COLOR_PATH}/images/icons/{STATUS_ICON}" width="18" height="18" border="0"></a></td>
                <td class="{CLASS_TYPE_ROW}"><a href="edit_user.php?edit_id={USER_ID}" class="link">{NAME}</a></td>
                <td class="{CLASS_TYPE_ROW}" width="90" align="center">{CREATION_DATE}</td>
                <td nowrap width="80" align="center" class="{CLASS_TYPE_ROW}"><img src="{THEME_COLOR_PATH}/images/icons/bullet.gif" width="18" height="18" border="0" align="absmiddle"> <a href="domain_details.php?domain_id={DOMAIN_ID}" class="link">{TR_DETAILS}</a></td>
				<td nowrap width="120" align="center" class="{CLASS_TYPE_ROW}" ><img src="{THEME_COLOR_PATH}/images/icons/edit.gif" width="18" height="18" border="0" align="absmiddle"> <a href="edit_domain.php?edit_id={DOMAIN_ID}" class="link">{TR_EDIT}</a></td>
				<td nowrap width="80" align="center" class="{CLASS_TYPE_ROW}" ><img src="{THEME_COLOR_PATH}/images/icons/stats.gif" width="18" height="18" border="0" align="absmiddle"> <a href="domain_statistics.php?month={VL_MONTH}&year={VL_YEAR}&domain_id={DOMAIN_ID}" class="link">{TR_STAT}</a></td>
				<td nowrap width="80" align="center" class="{CLASS_TYPE_ROW}" ><img src="{THEME_COLOR_PATH}/images/icons/details.gif" width="18" height="18" border="0" align="absmiddle"> <a href="change_user_interface.php?to_id={USER_ID}" class="link">{CHANGE_INTERFACE}</a></td>
				<td nowrap width="80" align="center" class="{CLASS_TYPE_ROW}" ><img src="{THEME_COLOR_PATH}/images/icons/delete.gif" width="16" height="16" border="0" align="absmiddle"> <a href="#" onClick="delete_account('druser.php?id={USER_ID}')" class="link">{ACTION}</a></td>
              </tr>
			  <!-- BDP: user_details -->
              <tr>
                <td align="center">&nbsp;</td>
                <td class="content4" align="center">&nbsp;</td>
                <td colspan="7" class="content4">&nbsp;&nbsp;<img src="{THEME_COLOR_PATH}/images/icons/show_alias.jpg" width="15" height="16" align="absmiddle">&nbsp;{ALIAS_DOMAIN}</td>
                </tr>
			  <!-- EDP: user_details -->
			  
			  <!-- EDP: user_entry -->
              
			  <!-- EDP: users_list -->
			  
			  
            </table>
			<input type="hidden" name="uaction" value="go_search">
		  </form>
			<div align="right"><br>
                <!-- BDP: scroll_prev_gray --><img src="{THEME_COLOR_PATH}/images/icons/flip/prev_gray.gif" width="20" height="20" border="0"><!-- EDP: scroll_prev_gray --><!-- BDP: scroll_prev --><a href="users.php?psi={PREV_PSI}"><img src="{THEME_COLOR_PATH}/images/icons/flip/prev.gif" width="20" height="20" border="0"></a><!-- EDP: scroll_prev --><!-- BDP: scroll_next_gray -->&nbsp;<img src="{THEME_COLOR_PATH}/images/icons/flip/next_gray.gif" width="20" height="20" border="0"><!-- EDP: scroll_next_gray --><!-- BDP: scroll_next -->&nbsp;<a href="users.php?psi={NEXT_PSI}"><img src="{THEME_COLOR_PATH}/images/icons/flip/next.gif" width="20" height="20" border="0"></a><!-- EDP: scroll_next -->
            </div></td>
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
