<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={THEME_CHARSET}">
<title>{TR_ADMIN_MANAGE_USERS_PAGE_TITLE}</title>
<link href="{THEME_COLOR_PATH}/css/vhcs.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{THEME_COLOR_PATH}/css/vhcs.js"></script>
<script>
<!--
function action_status(url) {
	if (!confirm("{TR_MESSAGE_CHANGE_STATUS}"))
		return false;

	location = url;
}

function action_delete(url) {
	if (!confirm("{TR_MESSAGE_DELETE}"))
		return false;

	location = url;
}

function sbmt(form, uaction) {

    form.details.value = uaction;
    form.submit();
    
    return false;

}

//-->
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
			 <tr>
            <td width="28" background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="manage_users.php" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/open_pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/open_background.gif" class="menu"><a href="manage_users.php" class="menu_active" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_MANAGE_USERS}</a></td>
            <td width="36" align="right" background="{THEME_COLOR_PATH}/images/menu/open_icon_bcgr.jpg" class="menu"><a href="manage_users.php" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/manage_users_a.gif" name="general" width="36" height="36" border="0" id="general"></a></td>
          </tr>
          <tr background="{THEME_COLOR_PATH}/images/menu/open_background.jpg">
            <td colspan="3" class="menu" background="{THEME_COLOR_PATH}/images/menu/open_background.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="5" rowspan="16" background="{THEME_COLOR_PATH}/images/menu/open_background_left.gif"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="12" height="1"></td>
                <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="manage_users.php" class="submenu">{TR_MENU_OVERVIEW}</a></td>
                <td width="5" rowspan="16" background="{THEME_COLOR_PATH}/images/menu/open_background_right.gif"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="5" height="1"></td>
              </tr>
              <tr>
                <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
                </tr>
              <tr>
                <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="add_user.php" class="submenu">{TR_MENU_ADD_ADMIN}</a></td>
                </tr>
              <tr>
                <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
              </tr>
              <tr>
                <td width="15"><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="add_reseller.php" class="submenu">{TR_MENU_ADD_RESELLER}</a></td>
              </tr>
              <tr>
                <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
                </tr>
              <tr>
                <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="manage_sessions.php" class="submenu">{TR_MENU_MANAGE_SESSIONS}</a></td>
              </tr>
              <tr>
                <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
              </tr>
              <tr>
                <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="manage_reseller_owners.php" class="submenu">{TR_MENU_RESELLER_ASIGNMENT}</a></td>
              </tr>
              <tr>
                <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
                </tr>
              <tr>
                <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="manage_reseller_users.php" class="submenu">{TR_MENU_USER_ASIGNMENT}</a></td>
              </tr>
              <tr>
                <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
                </tr>
              <tr>
                <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                <td><a href="email_setup.php" class="submenu">{TR_MENU_EMAIL_SETUP}</a></td>
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
            <td height="62" align="left" background="{THEME_COLOR_PATH}/images/content/table_background.jpg" class="title"><img src="{THEME_COLOR_PATH}/images/content/table_icon_users.jpg" width="85" height="62" align="absmiddle">{TR_ADMINISTRATORS}</td>
            <td width="27" align="right" background="{THEME_COLOR_PATH}/images/content/table_background.jpg"><img src="{THEME_COLOR_PATH}/images/content/table_icon_close.jpg" width="27" height="62"></td>
          </tr>
          <tr>
            <td valign="top">
			<!-- BDP: props_list -->
			<table width="100%" cellpadding="5" cellspacing="5">
              <!-- BDP: page_message -->
              <tr>
                <td width="20">&nbsp;</td>
                <td colspan="3" class="title"><font color="#FF0000">{MESSAGE}</font></td>
                </tr>
              <!-- EDP: page_message -->
              <!-- BDP: admin_message -->
              <tr>
                <td width="20" nowrap>&nbsp;</td>
                <td colspan="3" nowrap class="title"><font color="#FF0000">{ADMIN_MESSAGE}</font></td>
                </tr>
              <!-- EDP: admin_message -->
              <!-- BDP: admin_list -->
              <tr>
                <td width="20">&nbsp;</td>
                <td class="content3"><b>{TR_ADMIN_USERNAME}</b></td>
                <td class="content3"><b>{TR_ADMIN_CREATED_BY}</b></td>
                <td width="150" class="content3"><b>{TR_ADMIN_OPTIONS}</b></td>
              </tr>
              <!-- BDP: admin_item -->
              <tr>
                <td width="20">&nbsp;</td>
                <td class="{ADMIN_CLASS}"><a href="{URL_EDIT_ADMIN}" class="link">{ADMIN_USERNAME}</a> </td>
                <td class="{ADMIN_CLASS}">{ADMIN_CREATED_BY}</td>
                
                <td width="150" class="{ADMIN_CLASS}">
				<!-- BDP: admin_delete_show -->
				{TR_DELETE}
				<!-- EDP: admin_delete_show -->
				<!-- BDP: admin_delete_link -->
				<img src="{THEME_COLOR_PATH}/images/icons/delete.gif" width="16" height="16" border="0" align="absmiddle"> <a href="#" onClick="action_delete('{URL_DELETE_ADMIN}')" class="link">{TR_DELETE}</a>
				<!-- EDP: admin_delete_link -->
				</td>
              </tr>
              <!-- EDP: admin_item -->
              <!-- EDP: admin_list -->
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
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="62" align="left" background="{THEME_COLOR_PATH}/images/content/table_background.jpg" class="title"><img src="{THEME_COLOR_PATH}/images/content/table_icon_users.jpg" width="85" height="62" align="absmiddle">{TR_RESELLERS}</td>
              <td width="27" align="right" background="{THEME_COLOR_PATH}/images/content/table_background.jpg"><img src="{THEME_COLOR_PATH}/images/content/table_icon_close.jpg" width="27" height="62"></td>
            </tr>
            <tr>
              <td><table width="100%" cellpadding="5" cellspacing="5">
                <!-- BDP: rsl_message -->
                <tr>
                  <td width="20" nowrap>&nbsp;</td>
                  <td colspan="5" nowrap class="title"><font color="#FF0000">{RSL_MESSAGE}</font></td>
                  </tr>
                <!-- EDP: rsl_message -->
                <!-- BDP: rsl_list -->
                <tr>
                  <td width="20">&nbsp;</td>
                  <td class="content3"><b>{TR_RSL_USERNAME}</b></td>
                  <td width="150" align="center" class="content3"><b>{TR_CREATED_ON}</b></td>
                  <td width="150" class="content3"><b>{TR_RSL_CREATED_BY}</b></td>
                  <td colspan="2" align="center" class="content3"><b>{TR_RSL_OPTIONS}</b></td>
                  </tr>
                <!-- BDP: rsl_item -->
                <tr>
                  <td width="20">&nbsp;</td>
                  <td class="{RSL_CLASS}"><a href="{URL_EDIT_RSL}" class="link">{RSL_USERNAME} </a> </td>
                  <td class="{RSL_CLASS}" align="center">{RESELLER_CREATED_ON}</td>
                  <td class="{RSL_CLASS}">{RSL_CREATED_BY}</td>
                  <td width="100" align="center" class="{RSL_CLASS}"><img src="{THEME_COLOR_PATH}/images/icons/delete.gif" width="16" height="16" border="0" align="absmiddle"> <a href="#" onClick="action_delete('{URL_DELETE_RSL}')" class="link">{TR_DELETE}</a></td>
                  <td width="150" align="center" class="{RSL_CLASS}"><img src="{THEME_COLOR_PATH}/images/icons/details.gif" width="18" height="18" border="0" align="absmiddle"> <a href="{URL_CHANGE_INTERFACE}" class="link">{GO_TO_USER_INTERFACE}</a></td>
                </tr>
                <!-- EDP: rsl_item -->
                <!-- EDP: rsl_list -->
              </table>
                <br></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="62" align="left" background="{THEME_COLOR_PATH}/images/content/table_background.jpg" class="title"><img src="{THEME_COLOR_PATH}/images/content/table_icon_users.jpg" width="85" height="62" align="absmiddle">{TR_USERS}</td>
              <td width="27" align="right" background="{THEME_COLOR_PATH}/images/content/table_background.jpg"><img src="{THEME_COLOR_PATH}/images/content/table_icon_close.jpg" width="27" height="62"></td>
            </tr>
            <tr>
              <td>
			  <form name="search_user" method="post" action="manage_users.php">
            <table width="100%" cellpadding="5" cellspacing="5">

              <tr>
                <td width="20" nowrap>&nbsp;</td>
                <td colspan="5" nowrap class="title">
				  <table border="0" cellspacing="0" cellpadding="0">
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
                    <td nowrap><input name="Submit" type="submit" class="button" value="  {TR_SEARCH}  ">
                    </td>
                  </tr>
                </table>
				
				
				</td>
                <td colspan="2" align="right" nowrap>
				<input type="hidden" name="details" value="">
				<img src="{THEME_COLOR_PATH}/images/icons/show_alias.jpg" width="15" height="16" align="absmiddle"> <a href="#" class="link" onClick="return sbmt(document.forms[0],'{SHOW_DETAILS}');">{TR_VIEW_DETAILS}</a>
				</td>
                </tr>
			  <!-- BDP: usr_message -->
              <tr>
                <td width="20" nowrap>&nbsp;</td> 
                <td colspan="7" nowrap class="title"><font color="#FF0000">{USR_MESSAGE}</font></td>
                </tr>
              <!-- EDP: usr_message -->
              <!-- BDP: usr_list -->
              <tr>
                <td width="20">&nbsp;</td>
                <td width="20" align="center" class="content3"><b>{TR_USER_STATUS}</b></td> 
                <td class="content3"><b>{TR_USR_USERNAME}</b></td>
                <td width="100" align="center" class="content3"><b>{TR_CREATED_ON}</b></td>
                <td width="100" align="center" class="content3"><b>{TR_USR_CREATED_BY}</b></td>
                <td colspan="3" align="center" class="content3"><b>{TR_USR_OPTIONS}</b></td>
                </tr>
              <!-- BDP: usr_item -->
              <tr>
                <td width="20" align="center">&nbsp;</td>
                <td class="{USR_CLASS}" align="center"><a href="#" onClick="action_status('{URL_CHNAGE_STATUS}')" class="link"><img src="{THEME_COLOR_PATH}/images/icons/{STATUS_ICON}" width="18" height="18" border="0"></a></td> 
                <td class="{USR_CLASS}"><a href="{URL_EDIT_USR}" class="link">{USR_USERNAME} </a> </td>
                <td class="{USR_CLASS}" align="center">{USER_CREATED_ON}</td>
                <td class="{USR_CLASS}" align="center">{USR_CREATED_BY}</td>
		
		        <td width="80" align="center" nowrap class="{USR_CLASS}"><img src="{THEME_COLOR_PATH}/images/icons/bullet.gif" width="18" height="18" border="0" align="absmiddle"> <a href="domain_details.php?domain_id={DOMAIN_ID}" class="link">{TR_DETAILS}</a></td>
		        <td width="80" align="center" nowrap class="{USR_CLASS}">
		<!-- BDP: usr_delete_show -->
		{TR_DELETE}
		<!-- EDP: usr_delete_show -->
		<!-- BDP: usr_delete_link -->
		<img src="{THEME_COLOR_PATH}/images/icons/delete.gif" width="16" height="16" border="0" align="absmiddle"> <a href="#" onClick="action_delete('{URL_DELETE_USR}')" class="link">{TR_DELETE}</a>
		<!-- EDP: usr_delete_link -->
		</td>
		<td width="80" align="center" nowrap class="{USR_CLASS}"><img src="{THEME_COLOR_PATH}/images/icons/details.gif" width="18" height="18" border="0" align="absmiddle"> <a href="{URL_CHANGE_INTERFACE}" class="link">{GO_TO_USER_INTERFACE}</a></td>
		
              </tr>
			  <!-- BDP: user_details -->
              <tr>
                <td align="center">&nbsp;</td>
                <td class="content4" align="center">&nbsp;</td>
                <td colspan="7" class="content4">&nbsp;&nbsp;<img src="{THEME_COLOR_PATH}/images/icons/show_alias.jpg" width="15" height="16" align="absmiddle">&nbsp;{ALIAS_DOMAIN}</td>
                </tr>
			  <!-- EDP: user_details -->
			  
			  
              <!-- EDP: usr_item -->
              <!-- EDP: usr_list -->
            </table>
			<input type="hidden" name="uaction" value="go_search">
		  </form>
			<div align="right"><br>
                <!-- BDP: scroll_prev_gray --><img src="{THEME_COLOR_PATH}/images/icons/flip/prev_gray.gif" width="20" height="20" border="0"><!-- EDP: scroll_prev_gray --><!-- BDP: scroll_prev --><a href="manage_users.php?psi={PREV_PSI}"><img src="{THEME_COLOR_PATH}/images/icons/flip/prev.gif" width="20" height="20" border="0"></a><!-- EDP: scroll_prev --><!-- BDP: scroll_next_gray -->&nbsp;<img src="{THEME_COLOR_PATH}/images/icons/flip/next_gray.gif" width="20" height="20" border="0"><!-- EDP: scroll_next_gray --><!-- BDP: scroll_next -->&nbsp;<a href="manage_users.php?psi={NEXT_PSI}"><img src="{THEME_COLOR_PATH}/images/icons/flip/next.gif" width="20" height="20" border="0"></a><!-- EDP: scroll_next -->
            </div>
			  </td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
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
