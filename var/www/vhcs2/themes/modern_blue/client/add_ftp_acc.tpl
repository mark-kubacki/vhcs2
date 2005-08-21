<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={THEME_CHARSET}">
<title>{TR_CLIENT_ADD_FTP_ACC_PAGE_TITLE}</title>
<link href="{THEME_COLOR_PATH}/css/vhcs.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{THEME_COLOR_PATH}/css/vhcs.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
<!--
function over(number) {
  document.images["image"+number+"_1"].src='{THEME_COLOR_PATH}/images/bars/menu_button_left.gif';
  document.images["image"+number+"_2"].src='{THEME_COLOR_PATH}/images/bars/menu_button_right.gif';
  if (document.layers) {
    document.layers["m"+number].background.src='{THEME_COLOR_PATH}/images/bars/menu_button_background.gif';
  }
  else if (document.all) {
    window.document.all["id"+number].style.backgroundImage = 'url({THEME_COLOR_PATH}/images/bars/menu_button_background.gif)';
  }
}
function out(number) {
  document.images["image"+number+"_1"].src='../images/menubutton_left.gif';
  document.images["image"+number+"_2"].src='../images/menubutton_right.gif';
  if (document.layers) {
    document.layers["m"+number].background.src='../images/menubutton_background.gif';
  }
  else if (document.all) {
    window.document.all["id"+number].style.backgroundImage = 'url(../images/menubutton_background.gif)';
  }
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function sbmt(form, uaction) {

    form.uaction.value = uaction;
    form.submit();
    
    return false;

}

			
			

<!-- BDP: js_to_all_domain -->
    function begin_js(){
			document.forms[0].sub_id.disabled = true;
            document.forms[0].als_id.disabled = true;
            document.forms[0].username.focus();
    }

    
    function changeDom(wath) {

        if (wath == "real"){
            document.forms[0].sub_id.disabled = true;
            document.forms[0].als_id.disabled = true;
        }
        else if(wath == "subdom"){
            document.forms[0].sub_id.disabled = false;
            document.forms[0].als_id.disabled = true;
        }
        else {
            document.forms[0].sub_id.disabled = true;
			
            document.forms[0].als_id.disabled = false;
        }
    }
<!-- EDP: js_to_all_domain -->

<!-- BDP: js_not_domain -->
    function begin_js(){
            document.forms[0].username.focus();
    }

<!-- EDP: js_not_domain -->


<!-- BDP: js_to_subdomain -->
function begin_js(){
			document.forms[0].sub_id.disabled = true;
            document.forms[0].username.focus();
    }

    
    function changeDom(wath) {

        if (wath == "real"){
            document.forms[0].sub_id.disabled = true;
        }
        else if(wath == "subdom"){
            document.forms[0].sub_id.disabled = false;
        }
        else {
            document.forms[0].sub_id.disabled = true;
        }
    }
<!-- EDP: js_to_subdomain -->


<!-- BDP: js_to_alias_domain -->
    function begin_js(){
            document.forms[0].als_id.disabled = true;
            document.forms[0].username.focus();
    }

    
    function changeDom(wath) {

        if (wath == "real"){
            document.forms[0].als_id.disabled = true;
        }
        else if(wath == "subdom"){
            document.forms[0].als_id.disabled = true;
        }
        else {
            document.forms[0].als_id.disabled = false;
        }
    }
<!-- EDP: js_to_alias_domain -->
function OpenTree()
{
  libwindow=window.open("ftp_choose_dir.php","Hello","menubar=no,width=470,height=350,scrollbars=yes");
  
}
//-->
</script>
</head>

<body onLoad="MM_preloadImages('{THEME_COLOR_PATH}/images/icons/database_a.gif','{THEME_COLOR_PATH}/images/icons/domains_a.gif','{THEME_COLOR_PATH}/images/icons/ftp_a.gif','{THEME_COLOR_PATH}/images/icons/general_a.gif','{THEME_COLOR_PATH}/images/icons/logout_a.gif','{THEME_COLOR_PATH}/images/icons/email_a.gif','{THEME_COLOR_PATH}/images/icons/webtools_a.gif','{THEME_COLOR_PATH}/images/icons/statistics_a.gif','{THEME_COLOR_PATH}/images/icons/support_a.gif'); begin_js();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr>
    <td height="80" align="left" valign="top">
	<!-- BDP: logged_from --><table width="100%"  border="00" cellspacing="0" cellpadding="0">
      <tr>
        <td height="20" nowrap background="{THEME_COLOR_PATH}/images/button.gif">&nbsp;&nbsp;&nbsp;<a href="change_user_interface.php?action=go_back"><img src="{THEME_COLOR_PATH}/images/icons/close_interface.gif" width="18" height="18" border="0" align="absmiddle"></a> <font color="red">{YOU_ARE_LOGGED_AS}</font> </td>
      </tr>
    </table>
	<!-- EDP: logged_from --><table width="100%"  border="0" cellspacing="0" cellpadding="0">
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
            <td width="60" background="{THEME_COLOR_PATH}/images/menu/menu_top_left_bckgr.jpg"><img src="{THEME_COLOR_PATH}/images/icons/ftp_big.gif" width="60" height="62"></td>
            <td width="151" background="{THEME_COLOR_PATH}/images/menu/menu_top_bckgr.jpg" class="title">{TR_MENU_FTP_ACCOUNTS}</td>
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
          <!-- BDP: dmn_mngmnt -->
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
		   <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="manage_domains.php" onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/domains_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="manage_domains.php" class="menu"  onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/domains_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_MANAGE_DOMAINS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="manage_domains.php" onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/domains_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/domain.gif" name="domains" width="36" height="36" border="0" id="domains"></a></td>
          </tr>
		  <!-- EDP: dmn_mngmnt -->
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
		   <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="email_accounts.php" onMouseOver="MM_swapImage('email','','{THEME_COLOR_PATH}/images/icons/email_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="email_accounts.php" class="menu" onMouseOver="MM_swapImage('email','','{THEME_COLOR_PATH}/images/icons/email_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_EMAIL_ACCOUNTS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="email_accounts.php" onMouseOver="MM_swapImage('email','','{THEME_COLOR_PATH}/images/icons/email_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/email.gif" name="email" width="36" height="36" border="0" id="email"></a></td>
          </tr>
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
		   <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="ftp_accounts.php" onMouseOver="MM_swapImage('ftp','','{THEME_COLOR_PATH}/images/icons/ftp_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/open_pointer.jpg" name="Image1" width="28" height="36" border="0" id="Image1"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/open_background.gif" class="menu"><a href="ftp_accounts.php" class="menu_active"  onMouseOver="MM_swapImage('ftp','','{THEME_COLOR_PATH}/images/icons/ftp_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_FTP_ACCOUNTS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/menu/open_icon_bcgr.jpg" class="menu"><a href="ftp_accounts.php" onMouseOver="MM_swapImage('ftp','','{THEME_COLOR_PATH}/images/icons/ftp_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/ftp_a.gif" name="ftp" width="36" height="36" border="0" id="ftp"></a></td>
          </tr>
		   <tr background="{THEME_COLOR_PATH}/images/menu/open_background.jpg">
		     <td colspan="3" class="menu" background="{THEME_COLOR_PATH}/images/menu/open_background.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td width="5" rowspan="6" background="{THEME_COLOR_PATH}/images/menu/open_background_left.gif"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="12" height="1"></td>
                 <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                 <td><a href="ftp_accounts.php" class="submenu">{TR_MENU_OVERVIEW}</a></td>
                 <td width="5" rowspan="6" background="{THEME_COLOR_PATH}/images/menu/open_background_right.gif"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="5" height="1"></td>
               </tr>
               <tr>
                 <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
               </tr>
               <tr>
                 <td width="15"><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                 <td><a href="add_ftp_acc.php" class="submenu">{TR_MENU_ADD_FTP_USER}</a></td>
               </tr>
               <tr>
                 <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
                 </tr>
               <tr>
                 <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                 <td><a href="{FILEMANAGER_PATH}" target="{FILEMANAGER_TARGET}" class="submenu">{TR_FILEMANAGER}</a></td>
               </tr>
               <tr>
                 <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
               </tr>
             </table></td>
		     </tr>
		   <tr>
		     <td class="menu"><img src="{THEME_COLOR_PATH}/images/menu/open_down_left.gif" width="28" height="7"></td>
		     <td background="{THEME_COLOR_PATH}/images/menu/open_down.gif" class="menu"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="20" height="7"></td>
		     <td align="right" class="menu"><img src="{THEME_COLOR_PATH}/images/menu/open_down_right.gif" width="36" height="7"></td>
		     </tr>
          <!-- BDP: sql_support -->
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
		   <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="manage_sql.php" onMouseOver="MM_swapImage('databases','','{THEME_COLOR_PATH}/images/icons/database_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="manage_sql.php" class="menu" onMouseOver="MM_swapImage('databases','','{THEME_COLOR_PATH}/images/icons/database_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_MANAGE_SQL}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="manage_sql.php" onMouseOver="MM_swapImage('databases','','{THEME_COLOR_PATH}/images/icons/database_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/database.gif" name="databases" width="36" height="36" border="0" id="databases"></a></td>
          </tr>
		  <!-- EDP: sql_support -->
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
		   <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="webtools.php" onMouseOver="MM_swapImage('webtools','','{THEME_COLOR_PATH}/images/icons/webtools_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="webtools.php" class="menu" onMouseOver="MM_swapImage('webtools','','{THEME_COLOR_PATH}/images/icons/webtools_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_WEBTOOLS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="webtools.php" onMouseOver="MM_swapImage('webtools','','{THEME_COLOR_PATH}/images/icons/webtools_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/webtools.gif" name="webtools" width="36" height="36" border="0" id="webtools"></a></td>
          </tr>
		   <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
            </tr>
		   <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="domain_statistics.php" onMouseOver="MM_swapImage('statistics','','{THEME_COLOR_PATH}/images/icons/statistics_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="domain_statistics.php" class="menu" onMouseOver="MM_swapImage('statistics','','{THEME_COLOR_PATH}/images/icons/statistics_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_DOMAIN_STATISTICS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="domain_statistics.php" onMouseOver="MM_swapImage('statistics','','{THEME_COLOR_PATH}/images/icons/statistics_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/statistics.gif" name="statistics" width="36" height="36" border="0" id="statistics"></a></td>
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
        <td height="500" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="62" align="left" background="{THEME_COLOR_PATH}/images/content/table_background.jpg" class="title"><img src="{THEME_COLOR_PATH}/images/content/table_icon_ftp.jpg" width="85" height="62" align="absmiddle">{TR_ADD_FTP_USER}</td>
            <td width="27" align="right" background="{THEME_COLOR_PATH}/images/content/table_background.jpg"><img src="{THEME_COLOR_PATH}/images/content/table_icon_close.jpg" width="27" height="62"></td>
          </tr>
          <tr>
            <td><table width="100%"  border="00" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="20">&nbsp;</td>
                  <td valign="top">
				  
		<form name="add_ftp_acc_frm" method="post" action="add_ftp_acc.php">
            <table width="100%" cellspacing="7">
              <!-- BDP: page_message -->
              <tr> 
                <td colspan="2" class="title"><font color="#FF0000">{MESSAGE}</font></td>
              </tr>
              <!-- EDP: page_message -->
              <tr> 
                <td nowrap class="content2" width="200">{TR_USERNAME}</td>
                <td class="content" nowrap> 
                  <input type="text" name="username" value="{USERNAME}" style="width:170px" class="textinput">
                </td>
              </tr>
              <tr> 
                <td nowrap class="content2" width="200"> 
                  <input type="radio" name="dmn_type" value="dmn" onfocus="changeDom('real');" {DMN_TYPE_CHECKED}>{TR_TO_MAIN_DOMAIN}</td>
                <td class="content" nowrap>{FTP_SEPARATOR}{DOMAIN_NAME}</td>
              </tr>
              <!-- BDP: to_alias_domain -->
			  <tr> 
                <td nowrap class="content2" width="200"> 
                  <input type="radio" name="dmn_type" value="als"  onfocus="changeDom('alias');" {ALS_TYPE_CHECKED}>{TR_TO_DOMAIN_ALIAS}</td>
                <td class="content" nowrap> 
                  <select name="als_id">
                    <!-- BDP: als_list -->
                    <option value="{ALS_ID}" {ALS_SELECTED}>{FTP_SEPARATOR}{ALS_NAME}</option>
                    <!-- EDP: als_list -->
                  </select>
                </td>
              </tr>
			  <!-- EDP: to_alias_domain -->
			  <!-- BDP: to_subdomain -->
              <tr> 
                <td nowrap class="content2" width="200"> 
                  <input type="radio" name="dmn_type" value="sub" onfocus="changeDom('subdom');" {SUB_TYPE_CHECKED}>{TR_TO_SUBDOMAIN}</td>
                <td class="content" nowrap> 
                  <select name="sub_id">
                    <!-- BDP: sub_list -->
                    <option value="{SUB_ID}" {SUB_SELECTED}>{FTP_SEPARATOR}{SUB_NAME}</option>
                    <!-- EDP: sub_list -->
                  </select>
                </td>
              </tr>
			  <!-- EDP: to_subdomain -->
              <tr> 
                <td nowrap class="content2" width="200">{TR_PASSWORD}</td>
                <td class="content" nowrap> 
                  <input type="password" name="pass" value="" style="width:170px" class="textinput">
                </td>
              </tr>
              <tr> 
                <td nowrap class="content2" width="200">{TR_PASSWORD_REPEAT}</td>
                <td nowrap class=content> 
                  <input type="password" name="pass_rep" value="" style="width:170px" class="textinput">
                </td>
              </tr>
              <tr> 
                <td nowrap class="content2" width="200"> 
                  <input type="checkbox" name="use_other_dir" {USE_OTHER_DIR_CHECKED}>{TR_USE_OTHER_DIR}</td>
                <td nowrap class=content> 
                  <input type="text" name="other_dir" value="{OTHER_DIR}" style="width:170px" class="textinput">
                  <br>
                  <a href="javascript:OpenTree();" class="link">{CHOOSE_DIR}
                  </a> </td>
              </tr>
            </table>
            <input name="Submit" type="submit" class="button" value=" {TR_ADD} ">
            <input type="hidden" name="uaction" value="add_user">
            </form>  

                    </td>
                </tr>
            </table></td>
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
