<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={THEME_CHARSET}">
<title>{TR_RESELLER_MAIN_INDEX_PAGE_TITLE}</title>
<link href="{THEME_COLOR_PATH}/css/vhcs.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{THEME_COLOR_PATH}/css/vhcs.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function delete_order(url) {
	if (!confirm("{TR_MESSAGE_DELETE_ACCOUNT}"))
		return false;

	location = url;
}

function sbmt(form, uaction) {

    form.uaction.value = uaction;
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
            <td width="60" background="{THEME_COLOR_PATH}/images/menu/menu_top_left_bckgr.jpg"><img src="{THEME_COLOR_PATH}/images/icons/purchasing_big.gif" width="60" height="62"></td>
            <td width="151" background="{THEME_COLOR_PATH}/images/menu/menu_top_bckgr.jpg" class="title">{TR_MANAGE_ORDERS}</td>
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
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="index.php" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" name="Image1" width="28" height="36" border="0" id="Image1"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="index.php" class="menu"  onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_GENERAL_INFORMATION}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="index.php" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/general.gif" name="general" width="36" height="36" border="0" id="domains"></a></td>
          </tr>
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
          </tr>
          <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="hp.php" onMouseOver="MM_swapImage('hosting_plans','','{THEME_COLOR_PATH}/images/icons/hosting_plans_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="hp.php" class="menu"  onMouseOver="MM_swapImage('hosting_plans','','{THEME_COLOR_PATH}/images/icons/hosting_plans_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_HOSTING_PLANS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="hp.php" onMouseOver="MM_swapImage('hosting_plans','','{THEME_COLOR_PATH}/images/icons/hosting_plans_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/hosting_plans.gif" name="hosting_plans" width="36" height="36" border="0" id="hosting_plans"></a></td>
          </tr>
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
          </tr>
          <tr>
            <td width="28" background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="orders.php" onMouseOver="MM_swapImage('orders','','{THEME_COLOR_PATH}/images/icons/purchasing_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/open_pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/open_background.gif" class="menu"><a href="orders.php" class="menu_active" onMouseOver="MM_swapImage('orders','','{THEME_COLOR_PATH}/images/icons/purchasing_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_ORDERS}</a></td>
            <td width="36" align="right" background="{THEME_COLOR_PATH}/images/menu/open_icon_bcgr.jpg" class="menu"><a href="orders.php" onMouseOver="MM_swapImage('orders','','{THEME_COLOR_PATH}/images/icons/purchasing_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/purchasing_a.gif" name="orders" width="36" height="36" border="0" id="orders"></a></td>
          </tr>
          <tr>
            <td colspan="3" background="{THEME_COLOR_PATH}/images/menu/open_background.jpg" class="menu"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="5" rowspan="6" background="{THEME_COLOR_PATH}/images/menu/open_background_left.gif"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="12" height="1"></td>
                  <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                  <td><a href="orders.php" class="submenu">{TR_MENU_OVERVIEW}</a></td>
                  <td width="5" rowspan="6" background="{THEME_COLOR_PATH}/images/menu/open_background_right.gif"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="5" height="1"></td>
                </tr>
                <tr>
                  <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
                </tr>
                <tr>
                  <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                  <td><a href="order_settings.php" class="submenu">{TR_MENU_ORDER_SETTINGS}</a></td>
                </tr>
                <tr>
                  <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
                </tr>
                <tr>
                  <td width="15"><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                  <td><a href="order_email.php" class="submenu">{TR_MENU_ORDER_EMAIL}</a></td>
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
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="users.php" onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" name="domains_1" width="28" height="36" border="0" id="domains_1"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="users.php" class="menu"  onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_MANAGE_USERS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="users.php" onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/manage_users.gif" name="domains" width="36" height="36" border="0" id="domains"></a></td>
          </tr>
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
          </tr>
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
            <td height="62" align="left" background="{THEME_COLOR_PATH}/images/content/table_background.jpg" class="title"><img src="{THEME_COLOR_PATH}/images/content/table_icon_domains.jpg" width="85" height="62" align="absmiddle">{TR_ORDER_DETAILS}</td>
            <td width="27" align="right" background="{THEME_COLOR_PATH}/images/content/table_background.jpg"><img src="{THEME_COLOR_PATH}/images/content/table_icon_close.jpg" width="27" height="62"></td>
          </tr>
          <tr>
            <td>
			<form name="order_details" method="post" action="orders_detailst.php?order_id={ID}">
			  <table width="100%" cellpadding="5" cellspacing="5">
			  <!-- BDP: page_message -->
					<tr>
                      <td>&nbsp;</td>
                      <td colspan="2" class=title><font color="#FF0000">{MESSAGE}</font></td>
                      </tr>
					 <!-- EDP: page_message -->
                     <tr>
                       <td>&nbsp;</td>
                       <td colspan="2" class="content3"><strong>{TR_HOSTING_INFO}</strong></td>
                      </tr>
                     <tr>
                       <td>&nbsp;</td>
                       <td class="content2">{TR_DATE}</td>
                       <td class="content"><span class="content2">
                        {DATE}</span></td>
                     </tr>
                     <tr>
                       <td>&nbsp;</td>
                       <td class="content2">{TR_HP}</td>
                       <td class="content">{HP}</td>
                     </tr>
                     <tr>
                       <td>&nbsp;</td>
                       <td class="content2">{TR_DOMAIN}</td>
                       <td class="content"><input name="domain" type="text" class="textinput" id="domain" style="width:210px" value="{DOMAINNAME}">                        </td>
                     </tr>
                     <tr>
                       <td>&nbsp;</td>
                       <td class="content2">{TR_DMN_IP}</td>
                       <td class="content">
					   <select name="domain_ip">
                      <!-- BDP: ip_entry -->
                      <option value="{IP_VALUE}" {ip_selected}>{IP_NUM}&nbsp;({IP_NAME})</option>
                      <!-- EDP: ip_entry -->
                    </select>
					   </td>
                     </tr>
                     <tr>
                       <td>&nbsp;</td>
                       <td colspan="2" class="content3"><b>{TR_CUSTOMER_DATA}</b></td>
                      </tr>
                     <tr>
                       <td>&nbsp;</td>
                       <td class="content2">{TR_CUSTOMER_ID}</td>
                       <td class="content"><input name="customer_id" type="text" class="textinput" id="customer_id" style="width:210px" value="{CUSTOMER_ID}"></td>
                     </tr>
                     <tr>
                  <td width="20">&nbsp;</td>
                  <td width="203" class="content2"> {TR_FIRST_NAME}</td>
                  <td class="content"><input type="text" name="fname" value="{FNAME}" style="width:210px" class="textinput"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="content2"> {TR_LAST_NAME}</td>
                  <td width="516" class="content"><input type="text" name="lname" value="{LNAME}" style="width:210px" class="textinput"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="content2">{TR_COMPANY}</td>
                  <td class="content"><input type="text" name="firm" value="{FIRM}" style="width:210px" class="textinput"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="content2">{TR_ZIP_POSTAL_CODE}</td>
                  <td class="content"><input type="text" name="zip" value="{ZIP}" style="width:80px" class="textinput"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="content2">{TR_CITY}</td>
                  <td class="content"><input type="text" name="city" value="{CITY}" style="width:210px" class="textinput"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="content2">{TR_COUNTRY}</td>
                  <td class="content"><input type="text" name="country" value="{COUNTRY}" style="width:210px" class="textinput"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="content2">{TR_STREET_1}</td>
                  <td class="content"><input type="text" name="street1" value="{STREET1}" style="width:210px" class="textinput"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="content2">{TR_STREET_2}</td>
                  <td class="content"><input type="text" name="street2" value="{STREET2}" style="width:210px" class="textinput"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="content2">{TR_EMAIL}</td>
                  <td class="content"><input type="text" name="email" value="{EMAIL}" style="width:210px" class="textinput"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="content2">{TR_PHONE}</td>
                  <td class="content"><input type="text" name="phone" value="{PHONE}" style="width:210px" class="textinput"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td class="content2">{TR_FAX}</td>
                  <td class="content"><input type="text" name="fax" value="{FAX}" style="width:210px" class="textinput"></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="2">
				<input name="add" type="button" onClick="return sbmt(document.forms[0],'add_user');" class="button" value="{TR_ADD}">
				&nbsp;&nbsp;
				<input name="update" type="button" onClick="return sbmt(document.forms[0],'update_data');" class="button" value="{TR_UPDATE_DATA}">
				&nbsp;&nbsp;
                <input name="delete" type="button" onClick="delete_order('orders_delete.php?order_id={ID}')" class="button" value="{TR_DELETE_ORDER}">
                
				    <input type="hidden" name="uaction" value="">
                    <input name="order_id" type="hidden" value="{ID}"></td>
                </tr>
              </table>
			</form>
			
			
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
