<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={THEME_CHARSET}">
<title>{TR_ADMIN_USER_STATISTICS_PAGE_TITLE}</title>
<link href="{THEME_COLOR_PATH}/css/vhcs.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{THEME_COLOR_PATH}/css/vhcs.js"></script>
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
            <td width="60" background="{THEME_COLOR_PATH}/images/menu/menu_top_left_bckgr.jpg"><img src="{THEME_COLOR_PATH}/images/icons/statistics_big.gif" width="60" height="62"></td>
            <td width="151" background="{THEME_COLOR_PATH}/images/menu/menu_top_bckgr.jpg" class="title">{TR_MENU_DOMAIN_STATISTICS}</td>
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
            <td width="28" background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="index.php" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="index.php" class="menu" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_GENERAL_INFORMATION}</a></td>
            <td width="36" align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="index.php" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/general.gif" name="general" width="36" height="36" border="0" id="general"></a></td>
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
			<td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="orders.php" onMouseOver="MM_swapImage('orders','','{THEME_COLOR_PATH}/images/icons/purchasing_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
			<td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="orders.php" class="menu"  onMouseOver="MM_swapImage('orders','','{THEME_COLOR_PATH}/images/icons/purchasing_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_ORDERS}</a></td>
			<td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="orders.php" onMouseOver="MM_swapImage('orders','','{THEME_COLOR_PATH}/images/icons/purchasing_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/purchasing.gif" name="orders" width="36" height="36" border="0" id="hosting_plans"></a></td>
		  </tr>
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
		   <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="users.php" onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" name="Image1" width="28" height="36" border="0" id="Image1"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="users.php" class="menu"  onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_MANAGE_USERS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="users.php" onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/manage_users_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/manage_users.gif" name="domains" width="36" height="36" border="0" id="domains"></a></td>
          </tr>
		   <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
		   <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="reseller_user_statistics.php" onMouseOver="MM_swapImage('statistics','','{THEME_COLOR_PATH}/images/icons/statistics_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/open_pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/open_background.gif" class="menu"><a href="reseller_user_statistics.php" class="menu_active" onMouseOver="MM_swapImage('statistics','','{THEME_COLOR_PATH}/images/icons/statistics_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_DOMAIN_STATISTICS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/menu/open_icon_bcgr.jpg" class="menu"><a href="reseller_user_statistics.php" onMouseOver="MM_swapImage('statistics','','{THEME_COLOR_PATH}/images/icons/statistics_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/statistics_a.gif" name="statistics" width="36" height="36" border="0" id="statistics"></a></td>
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
            <td height="62" align="left" background="{THEME_COLOR_PATH}/images/content/table_background.jpg" class="title"><img src="{THEME_COLOR_PATH}/images/content/table_icon_stats.jpg" width="85" height="62" align="absmiddle">{TR_RESELLER_USER_STATISTICS}</td>
            <td width="27" align="right" background="{THEME_COLOR_PATH}/images/content/table_background.jpg"><img src="{THEME_COLOR_PATH}/images/content/table_icon_close.jpg" width="27" height="62"></td>
          </tr>
          <tr>
            <td valign="top">

			<table width="100%" cellspacing="7">
  <tr>
    <td width="20" nowrap>&nbsp;&nbsp;&nbsp;</td>
    <td>
	<!-- BDP: props_list -->
			
			
			<form name="rs_frm" method="post" action="reseller_user_statistics.php?psi={POST_PREV_PSI}">
              <table width="100%">
                <tr>
                  <td width="80" class="content">{TR_MONTH}</td>
                  <td width="80" class="content"><select name="month">
                      <!-- BDP: month_list -->
                      <option {OPTION_SELECTED}>{MONTH_VALUE}</option>
                      <!-- EDP: month_list -->
                    </select>
                  </td>
                  <td width="80" class="content">{TR_YEAR}</td>
                  <td width="80" class="content"><select name="year">
                      <!-- BDP: year_list -->
                      <option {OPTION_SELECTED}>{YEAR_VALUE}</option>
                      <!-- EDP: year_list -->
                    </select>
                  </td>
                  <td class="content"><input name="Submit" type="submit" class="button" value=" {TR_SHOW} ">
                  </td>
                </tr>
              </table>
              <input type="hidden" name="uaction" value="show">
              <input type="hidden" name="name" value="{VALUE_NAME}">
              <input type="hidden" name="rid" value="{VALUE_RID}">
            </form>
			<br>
            <table cellspacing="3">
              <!-- BDP: no_domains -->
              <tr>
                <td class="title" colspan="13" width="550" align="center"><font color="#FF0000"> {TR_NO_DOMAINS}</font> </td>
              </tr>
              <!-- EDP: no_domains -->
              <!-- BDP: domain_list -->
              <tr>
                <td height="25" colspan="13" nowrap class="content">{RESELLER_NAME}</td>
              </tr>
              <tr align="center">
                <td class="content3" nowrap height="25"><b>{TR_DOMAIN_NAME}</b></td>
                <td class="content3" nowrap height="25"><b>{TR_TRAFF}</b></td>
                <td class="content3" nowrap height="25"><b>{TR_DISK}</b></td>
                <td class="content3" nowrap height="25"><b>{TR_WEB}</b></td>
                <td class="content3" nowrap height="25"><b>{TR_FTP_TRAFF}</b></td>
                <td class="content3" nowrap height="25"><b>{TR_SMTP}</b></td>
                <td class="content3" nowrap height="25"><b>{TR_POP3}</b></td>
                <td class="content3" nowrap height="25"><b>{TR_SUBDOMAIN}</b></td>
                <td class="content3" nowrap height="25"><b>{TR_ALIAS}</b> </td>
                <td class="content3" nowrap height="25"><b>{TR_MAIL}</b></td>
                <td class="content3" nowrap height="25"><b>{TR_FTP}</b></td>
                <td class="content3" nowrap height="25"><b>{TR_SQL_DB}</b></td>
                <td class="content3" nowrap height="25"><b>{TR_SQL_USER}</b></td>
              </tr>
              <!-- BDP: domain_entry -->
              <tr>
                <td class="{ITEM_CLASS}" nowrap align="center"><b><a href="domain_statistics.php?month={MONTH}&year={YEAR}&domain_id={DOMAIN_ID}" class="link">{DOMAIN_NAME}</a></b></td>
                <td class="{ITEM_CLASS}" nowrap align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="13"><img src="{THEME_COLOR_PATH}/images/stats_left_small.gif" width="13" height="20"></td>
                      <td background="{THEME_COLOR_PATH}/images/stats_background.gif"><table border="0" cellspacing="0" cellpadding="0" align="left">
                          <tr>
                            <td width="7"><img src="{THEME_COLOR_PATH}/images/bars/stats_left.gif" width="7" height="13"></td>
                            <td background="{THEME_COLOR_PATH}/images/bars/stats_background.gif"><img src="{THEME_COLOR_PATH}/trans.gif" width="{TRAFF_PERCENT}" height="1"></td>
                            <td width="7"><img src="{THEME_COLOR_PATH}/images/bars/stats_right.gif" width="7" height="13"></td>
                          </tr>
                      </table></td>
                      <td width="13"><img src="{THEME_COLOR_PATH}/images/stats_right_small.gif" width="13" height="20"></td>
                    </tr>
                  </table>
                    <b>{TRAFF_SHOW_PERCENT}&nbsp;%</b><br>
      {TRAFF_USED}<br>
      {TR_OF}<br>
      <b>{TRAFF_MAX}</b></td>
                <td class="{ITEM_CLASS}" nowrap align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="13"><img src="{THEME_COLOR_PATH}/images/stats_left_small.gif" width="13" height="20"></td>
                      <td background="{THEME_COLOR_PATH}/images/stats_background.gif"><table border="0" cellspacing="0" cellpadding="0" align="left">
                          <tr>
                            <td width="7"><img src="{THEME_COLOR_PATH}/images/bars/stats_left.gif" width="7" height="13"></td>
                            <td background="{THEME_COLOR_PATH}/images/bars/stats_background.gif"><img src="{THEME_COLOR_PATH}/trans.gif" width="{DISK_PERCENT}" height="1"></td>
                            <td width="7"><img src="{THEME_COLOR_PATH}/images/bars/stats_right.gif" width="7" height="13"></td>
                          </tr>
                      </table></td>
                      <td width="13"><img src="{THEME_COLOR_PATH}/images/stats_right_small.gif" width="13" height="20"></td>
                    </tr>
                  </table>
                    <b>{DISK_SHOW_PERCENT}&nbsp;%</b><br>
      {DISK_USED}<br>
      {TR_OF}<br>
      <b>{DISK_MAX}</b></td>
                <td class="{ITEM_CLASS}" nowrap align="center">{WEB}</td>
                <td class="{ITEM_CLASS}" nowrap align="center">{FTP}</td>
                <td class="{ITEM_CLASS}" nowrap align="center">{SMTP}</td>
                <td class="{ITEM_CLASS}" nowrap align="center">{POP3}</td>
                <td class="{ITEM_CLASS}" nowrap align="center">{SUB_USED}<br>
      {TR_OF}<br>
      <b>{SUB_MAX}</b></td>
                <td class="{ITEM_CLASS}" nowrap align="center">{ALS_USED}</td>
                <td class="{ITEM_CLASS}" nowrap align="center">{MAIL_USED}<br>
      {TR_OF}<br>
      <b>{MAIL_MAX}</b></td>
                <td class="{ITEM_CLASS}" nowrap align="center">{FTP_USED}<br>
      {TR_OF}<br>
      <b>{FTP_MAX}</b></td>
                <td class="{ITEM_CLASS}" nowrap align="center">{SQL_DB_USED}<br>
      {TR_OF}<br>
      <b>{SQL_DB_MAX}</b></td>
                <td class="{ITEM_CLASS}" nowrap align="center">{SQL_USER_USED}<br>
      {TR_OF}<br>
      <b>{SQL_USER_MAX}</b></td>
              </tr>
              <!-- EDP: domain_entry -->
              <!-- EDP: domain_list -->
            </table>
            <table width="100%"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><div align="left"><br>
                        <!-- BDP: scroll_prev_gray -->
                        <img src="{THEME_COLOR_PATH}/images/icons/flip/prev_gray.gif" width="20" height="20" border="0">
                        <!-- EDP: scroll_prev_gray -->
                        <!-- BDP: scroll_prev -->
                        <a href="reseller_user_statistics.php?psi={PREV_PSI}&month={MONTH}&year={YEAR}"><img src="{THEME_COLOR_PATH}/images/icons/flip/prev.gif" width="20" height="20" border="0"></a>
                        <!-- EDP: scroll_prev -->
                        <!-- BDP: scroll_next_gray -->
                &nbsp;<img src="{THEME_COLOR_PATH}/images/icons/flip/next_gray.gif" width="20" height="20" border="0">
                        <!-- EDP: scroll_next_gray -->
                        <!-- BDP: scroll_next -->
                &nbsp;<a href="reseller_user_statistics.php?psi={NEXT_PSI}&month={MONTH}&year={YEAR}"><img src="{THEME_COLOR_PATH}/images/icons/flip/next.gif" width="20" height="20" border="0"></a>
                        <!-- EDP: scroll_next -->
                </div></td>
                <td><div align="right"><br>
                        <!-- BDP: scroll_prev_gray -->
                        <img src="{THEME_COLOR_PATH}/images/icons/flip/prev_gray.gif" width="20" height="20" border="0">
                        <!-- EDP: scroll_prev_gray -->
                        <!-- BDP: scroll_prev -->
                        <a href="reseller_user_statistics.php?psi={PREV_PSI}&month={MONTH}&year={YEAR}"><img src="{THEME_COLOR_PATH}/images/icons/flip/prev.gif" width="20" height="20" border="0"></a>
                        <!-- EDP: scroll_prev -->
                        <!-- BDP: scroll_next_gray -->
                &nbsp;<img src="{THEME_COLOR_PATH}/images/icons/flip/next_gray.gif" width="20" height="20" border="0">
                        <!-- EDP: scroll_next_gray -->
                        <!-- BDP: scroll_next -->
                &nbsp;<a href="reseller_user_statistics.php?psi={NEXT_PSI}&month={MONTH}&year={YEAR}"><img src="{THEME_COLOR_PATH}/images/icons/flip/next.gif" width="20" height="20" border="0"></a>
                        <!-- EDP: scroll_next -->
                </div></td>
              </tr>
            </table>
            <!-- EDP: props_list -->
	</td>
  </tr>
</table>

			
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
