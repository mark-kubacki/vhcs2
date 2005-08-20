<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={THEME_CHARSET}">
<title>{TR_CLIENT_ADD_ALIAS_PAGE_TITLE}</title>
<link href="{THEME_COLOR_PATH}/css/vhcs.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{THEME_COLOR_PATH}/css/vhcs.js"></script>
<script>
<!--
function sbmt(form, uaction) {

    form.uaction.value = uaction;
    form.submit();
    
    return false;

}

    var emptyData = 'Empty data or wrong field!';
		var passerr   = 'Password not match !';

var wdname    = 'Wrong domain name !';

var mpointError = 'Please write mount point !';
		    function checkForm(){
            var dname  = document.forms[0].elements['ndomain_name'].value;
            var dmount = document.forms[0].elements['ndomain_mpoint'].value;
            var dd = new String(dmount);
            if ( dname == "" || dmount == "") {
                alert(emptyData);
            }
            else if (dname.indexOf('.') == -1) {
                alert(wdname);
            }
            else if(dd.length < 2){
                alert(mpointError);
            }
            else {
                document.forms[0].submit();
            }
    }

    function makeUser(){

            document.forms[0].elements['ndomain_mpoint'].value = "/" + document.forms[0].elements['ndomain_name'].value.replace('.','_');
    }

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body onLoad="MM_preloadImages('{THEME_COLOR_PATH}/images/icons/database_a.gif','{THEME_COLOR_PATH}/images/icons/domains_a.gif','{THEME_COLOR_PATH}/images/icons/general_a.gif','{THEME_COLOR_PATH}/images/icons/logout_a.gif','{THEME_COLOR_PATH}/images/icons/webtools_a.gif','{THEME_COLOR_PATH}/images/icons/statistics_a.gif','{THEME_COLOR_PATH}/images/icons/support_a.gif','{THEME_COLOR_PATH}/images/icons/email_a.gif','{THEME_COLOR_PATH}/images/icons/ftp_a.gif','{THEME_COLOR_PATH}/images/icons/custom_link_a.gif')">
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
            <td width="28" background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="index.php" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="index.php" class="menu" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_GENERAL_INFORMATION}</a></td>
            <td width="36" align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="index.php" onMouseOver="MM_swapImage('general','','{THEME_COLOR_PATH}/images/icons/general_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/general.gif" name="general" width="36" height="36" border="0" id="general"></a></td>
          </tr>
		  <!-- BDP: dmn_mngmnt -->
          <tr>
            <td colspan="3"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
          </tr>
          <tr>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="#" onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/domains_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/open_pointer.jpg" width="28" height="36" border="0"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/open_background.gif" class="menu"><a href="manage_domains.php" class="menu_active"  onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/domains_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_MANAGE_DOMAINS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/menu/open_icon_bcgr.jpg" class="menu"><a href="manage_domains.php" onMouseOver="MM_swapImage('domains','','{THEME_COLOR_PATH}/images/icons/domains_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/domains_a.gif" name="domains" width="36" height="36" border="0" id="domains"></a></td>
          </tr>
          <tr background="{THEME_COLOR_PATH}/images/menu/open_background.jpg">
            <td colspan="3" class="menu" background="{THEME_COLOR_PATH}/images/menu/open_background.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="5" rowspan="6" background="{THEME_COLOR_PATH}/images/menu/open_background_left.gif"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="12" height="1"></td>
                  <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                  <td><a href="manage_domains.php" class="submenu">{TR_MENU_OVERVIEW}</a></td>
                  <td width="5" rowspan="6" background="{THEME_COLOR_PATH}/images/menu/open_background_right.gif"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="5" height="1"></td>
                </tr>
                <tr>
                  <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
                </tr>
                <tr>
                  <td width="15"><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                  <td><a href="add_subdomain.php" class="submenu">{TR_MENU_ADD_SUBDOMAIN}</a></td>
                </tr>
                <!-- BDP: domainalias_support -->
                <tr>
                  <td colspan="2"><img src="{THEME_COLOR_PATH}/images/trans.gif" width="30" height="4"></td>
                </tr>
                <tr>
                  <td><img src="{THEME_COLOR_PATH}/images/icons/document.gif" width="12" height="15"></td>
                  <td><a href="add_alias.php" class="submenu">{TR_MENU_ADD_ALIAS}</a></td>
                </tr>
                <!-- EDP: domainalias_support -->
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
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="ftp_accounts.php" onMouseOver="MM_swapImage('ftp','','{THEME_COLOR_PATH}/images/icons/ftp_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/menu/pointer.jpg" name="Image1" width="28" height="36" border="0" id="Image1"></a></td>
            <td background="{THEME_COLOR_PATH}/images/menu/button_background.jpg" class="menu"><a href="ftp_accounts.php" class="menu"  onMouseOver="MM_swapImage('ftp','','{THEME_COLOR_PATH}/images/icons/ftp_a.gif',1)" onMouseOut="MM_swapImgRestore()">{TR_MENU_FTP_ACCOUNTS}</a></td>
            <td align="right" background="{THEME_COLOR_PATH}/images/icons/icon_bcgr.gif" class="menu"><a href="ftp_accounts.php" onMouseOver="MM_swapImage('ftp','','{THEME_COLOR_PATH}/images/icons/ftp_a.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="{THEME_COLOR_PATH}/images/icons/ftp.gif" name="ftp" width="36" height="36" border="0" id="ftp"></a></td>
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
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="62" align="left" background="{THEME_COLOR_PATH}/images/content/table_background.jpg" class="title"><img src="{THEME_COLOR_PATH}/images/content/table_icon_domains.jpg" width="85" height="62" align="absmiddle">{TR_MANAGE_DOMAIN_ALIAS}</td>
            <td width="27" align="right" background="{THEME_COLOR_PATH}/images/content/table_background.jpg"><img src="{THEME_COLOR_PATH}/images/content/table_icon_close.jpg" width="27" height="62"></td>
          </tr>
          <tr>
            <td valign="top">
			
			   <form name="add_alias_frm" method="post" action="add_alias.php?edit_id={ID}">
            <table width="100%" cellpadding="5" cellspacing="5">
              <tr>
                <td width="20">&nbsp;</td> 
                <td colspan="2" class="content3"><b>{TR_ADD_ALIAS}</b></td>
                </tr>
				<!-- BDP: page_message -->
              <tr>
                <td width="20">&nbsp;</td>
                <td colspan="2" class="title"><font color="#FF0000">{MESSAGE}</font></td>
                </tr>
              <!-- EDP: page_message -->
              <tr>
                <td width="20">&nbsp;</td> 
                <td width="200" class="content2">{TR_DOMAIN_NAME}</td>
                <td class="content"><input name="ndomain_name" type="text" class="textinput" style="width:170px" value="{DOMAIN}" onBlur="makeUser();"></td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td>
                <td class="content2">{TR_MOUNT_POINT}</td>
                <td class="content"><input name="ndomain_mpoint" type="text" class="textinput" id="ndomain_mpoint" value='{MP}' style="width:170px"></td>
              </tr>
              <tr>
                <td width="20" nowrap>&nbsp;</td> 
                <td width="200" nowrap class="content2">{TR_FORWARD}</td>
                <td class="content"> 
                  <input name="forward" type="text" class="textinput" id="forward" style="width:170px" value="{FORWARD}">
                </td>
              </tr>
              <tr>
                <td width="20">&nbsp;</td> 
                <td colspan="2"> 
                  <input name="Submit" type="submit" class="button" value="  {TR_ADD}  ">                  </td>
                </tr>
            </table>
	    <input type="hidden" name="uaction" value="add_alias">
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
