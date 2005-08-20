<html>
<head>
<title>{TR_CLIENT_CHANGE_PERSONAL_DATA_PAGE_TITLE}</title>
<meta http-equiv="Content-Type" content="text/html; charset={THEME_CHARSET}">
<link rel="stylesheet" href="{THEME_COLOR_PATH}/css/vhcs.css" type="text/css">


<script>
function over(number) {
  document.images["image"+number+"_1"].src='{THEME_COLOR_PATH}/images/menu_button_left.gif';
  document.images["image"+number+"_2"].src='{THEME_COLOR_PATH}/images/menu_button_right.gif';
  if (document.layers) {
    document.layers["m"+number].background.src='{THEME_COLOR_PATH}/images/menu_button_background.gif';
  }
  else if (document.all) {
    window.document.all["id"+number].style.backgroundImage = 'url({THEME_COLOR_PATH}/images/menu_button_background.gif)';
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

function sbmt(form, uaction) {
    
    form.uaction.value = uaction;
    form.submit();
    
    return false;
}

</script>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="82" width="34"><img src="../images/top1.jpg" width="34" height="82"></td>
    <td height="82" width="59"><img src="{THEME_COLOR_PATH}/images/vhcs.jpg" width="59" height="82"></td>
    <td height="82" width="17"><img src="../images/top3.jpg" width="17" height="82"></td>
    <td height="82" width="147"><img src="../images/top4.jpg" width="147" height="82"></td>
    <td height="82" width="150"><img src="../images/top5.jpg" width="150" height="82"></td>
    <td height="82" background="../images/top6.jpg"><img src="../images/top6.jpg" width="4" height="82"></td>
    <td height="82" background="../images/top6.jpg" align="right"><img src="{ISP_LOGO}" height="82"></td>
  </tr>
</table>
<!-- BDP: logged_from -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="34"><img src="../images/down_left.jpg" width="34" height="50"></td>
          <td align="left" background="../images/down_background.jpg"><table border="0" cellspacing="0" cellpadding="0" width="100">
            <tr>
              <td class="bottom" nowrap><font color =red><strong><blink></blink></strong></font></td>
              <td class="bottom" nowrap><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="23"><a href="change_user_interface.php?action=go_back" onMouseOver=over(99); onMouseOut=out(99);><img src="../images/menubutton_left.gif" name="image99_1" width="23" height="23" border="0"></a></td>
                  <td nowrap id="id99" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'"><a href="change_user_interface.php?action=go_back" class="menu" onMouseOver=over(99); onMouseOut=out(99);>{TR_GO_BACK}</a></td>
                  <td width="23"><a href="change_user_interface.php?action=go_back" onMouseOver=over(99); onMouseOut=out(99);><img src="../images/menubutton_right.gif" name="image99_2" width="23" height="23" border="0"></a></td>
                </tr>
              </table></td>
              <td class="bottom" nowrap>&nbsp;</td>
              <td class="bottom" nowrap><font color=red><strong>{YOU_ARE_LOGGED_AS}</strong></font></td>
            </tr>
          </table></td>
          <td width="34"><img src="../images/down_right.jpg" width="34" height="50"></td>
        </tr>
      </table>
<!-- EDP: logged_from -->	
<table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td valign="top" width="1"> 


<!--menutable -->


      <table border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="31"><img src="../images/menu_top_left.jpg" width="31" height="15"></td>
          <td background="../images/menu_top_background.jpg"><img src="../images/menu_top_background.jpg" width="5" height="15"></td>
          <td width="30"><img src="../images/menu_top_right.jpg" width="30" height="15"></td>
        </tr>
        <tr> 
          <td width="31"><img src="../images/menu_top_left2.jpg" width="31" height="19"></td>
          <td background="../images/menu_top.jpg" align="center"><img src="{THEME_COLOR_PATH}/images/menu_top.jpg" width="186" height="19"></td>
          <td width="30"><img src="../images/menu_top_right2.jpg" width="30" height="19"></td>
        </tr>
        <tr> 
          <td background="../images/menu_left_background.jpg"><img src="../images/trans.gif" width="31" height="1"></td>
          <td background="../images/menu_background.jpg" valign="top" nowrap> 


<!-- menus -->

            <table width="100" border="0" cellspacing="0" cellpadding="0" align="center">
              <tr>
                <td width="23" height="8"><img src="../images/trans.gif" width="10" height="15"></td>
                <td nowrap height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td width="23" height="8"><img src="../images/trans.gif" width="10" height="8"></td>
              </tr>
              <tr>
                <td width="23"><a href="index.php"  onMouseOver=over(1); onMouseOut=out(1);><img src="../images/menubutton_left.gif" name="image1_1" width="23" height="23" border="0"></a></td>
                <td nowrap id="id1" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'"><a href="index.php" class="menu"  onMouseOver=over(1); onMouseOut=out(1);>{TR_MENU_GENERAL_INFORMATION}</a></td>
                <td width="23"><a href="index.php"  onMouseOver=over(1); onMouseOut=out(1);><img src="../images/menubutton_right.gif" name="image1_2" width="23" height="23" border="0"></a></td>
              </tr>
              <tr>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td nowrap height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
              </tr>
              <tr>
                <td width="23"><a href="chpsswd.php"  onMouseOver=over(2); onMouseOut=out(2);><img src="../images/menubutton_left.gif" name="image2_1" width="23" height="23" border="0"></a></td>
                <td nowrap id="id2" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'"><a href="chpsswd.php" class="menu" onMouseOver=over(2); onMouseOut=out(2);>{TR_MENU_CHANGE_PASSWORD}</a></td>
                <td width="23"><a href="chpsswd.php"  onMouseOver=over(2); onMouseOut=out(2);><img src="../images/menubutton_right.gif" name="image2_2" width="23" height="23" border="0"></a></td>
              </tr>
              <tr>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td nowrap height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
              </tr>
              <tr>
                <td width="23"><a href="chpdata.php"  onMouseOver=over(3); onMouseOut=out(3);><img src="../images/menubutton_left.gif" name="image3_1" width="23" height="23" border="0"></a></td>
                <td nowrap id="id3" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'"><a href="chpdata.php" class="menu" onMouseOver=over(3); onMouseOut=out(3);>{TR_MENU_CHANGE_PERSONAL_DATA}</a></td>
                <td width="23"><a href="chpdata.php"  onMouseOver=over(3); onMouseOut=out(3);><img src="../images/menubutton_right.gif" name="image3_2" width="23" height="23" border="0"></a></td>
              </tr>
              <tr>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td nowrap height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
              </tr>
              <tr>
                <td width="23"><a href="hp.php"  onMouseOver=over(4); onMouseOut=out(4);><img src="../images/menubutton_left.gif" name="image4_1" width="23" height="23" border="0"></a></td>
                <td nowrap id="id4" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'"><a href="hp.php" class="menu" onMouseOver=over(4); onMouseOut=out(4);>{TR_MENU_HOSTING_PLANS}</a></td>
                <td width="23"><a href="hp.php"  onMouseOver=over(4); onMouseOut=out(4);><img src="../images/menubutton_right.gif" name="image4_2" width="23" height="23" border="0"></a></td>
              </tr>
              <tr>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td nowrap height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
              </tr>
              <tr>
                <td width="23"><a href="users.php"><img src="{THEME_COLOR_PATH}/images/menu_button_left.gif" name="image5_1" width="23" height="23" border="0"></a></td>
                <td nowrap id="id5" background="{THEME_COLOR_PATH}/images/menu_button_background.gif"><a href="users.php" class="menu">{TR_MENU_MANAGE_USERS}</a></td>
                <td width="23"><a href="users.php"><img src="{THEME_COLOR_PATH}/images/menu_button_right.gif" name="image5_2" width="23" height="23" border="0"></a></td>
              </tr>
              <tr>
                <td height="8"><img src="../images/trans.gif" width="23" height="23"></td>
                <td nowrap height="8" colspan="2" valign="top"><!-- Submenu -->
                    <table border="0" cellspacing="0" cellpadding="0" width="100%">
                      <tr>
                        <td width="23" height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                        <td height="8" nowrap><img src="../images/trans.gif" width="10" height="8"></td>
                        <td width="23" height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                      </tr>
                      <tr>
                        <td width="23"><a href="rau1.php"><img src="{THEME_COLOR_PATH}/images/menu_button_left.gif" name="image30_1" width="23" height="23" border="0"></a></td>
                        <td id="id30" background="{THEME_COLOR_PATH}/images/menu_button_background.gif"  nowrap><a href="rau1.php" class="menu">{TR_MENU_ADD_USER}</a></td>
                        <td width="23"><a href="rau1.php"><img src="{THEME_COLOR_PATH}/images/menu_button_right.gif" name="image30_2" width="23" height="23" border="0"></a></td>
                      </tr>
                      <tr>
                        <td width="23" height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                        <td height="8" nowrap><img src="../images/trans.gif" width="10" height="8"></td>
                        <td width="23" height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                      </tr>
                      <tr>
                        <td width="23"><a href="email_setup.php"  onMouseOver=over(31); onMouseOut=out(31);><img src="../images/menubutton_left.gif" name="image31_1" width="23" height="23" border="0"></a></td>
                        <td id="id31" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'" nowrap><a href="email_setup.php" class="menu" onMouseOver=over(31); onMouseOut=out(31);>{TR_MENU_E_MAIL_SETUP}</a></td>
                        <td width="23"><a href="email_setup.php"  onMouseOver=over(31); onMouseOut=out(31);><img src="../images/menubutton_right.gif" name="image31_2" width="23" height="23" border="0"></a></td>
                      </tr>
                      <tr>
                        <td width="23" height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                        <td height="8" nowrap><img src="../images/trans.gif" width="10" height="8"></td>
                        <td width="23" height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                      </tr>
                      <tr>
                        <td width="23"><a href="circular.php"  onMouseOver=over(32); onMouseOut=out(32);><img src="../images/menubutton_left.gif" name="image32_1" width="23" height="23" border="0"></a></td>
                        <td id="id32" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'" nowrap><a href="circular.php" class="menu" onMouseOver=over(32); onMouseOut=out(32);>{TR_MENU_CIRCULAR}</a></td>
                        <td width="23"><a href="circular.php"  onMouseOver=over(32); onMouseOut=out(32);><img src="../images/menubutton_right.gif" name="image32_2" width="23" height="23" border="0"></a></td>
                      </tr>
                      <tr>
                        <td width="23" height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                        <td height="8" nowrap><img src="../images/trans.gif" width="10" height="8"></td>
                        <td width="23" height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                      </tr>
                    </table>
                    <!-- end of Submenu -->
                </td>
              </tr>
              <tr>
                <td width="23"><a href="manage_domains.php"  onMouseOver=over(6); onMouseOut=out(6);><img src="../images/menubutton_left.gif" name="image6_1" width="23" height="23" border="0"></a></td>
                <td nowrap id="id6" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'"><a href="manage_domains.php" class="menu" onMouseOver=over(6); onMouseOut=out(6);>{TR_MENU_MANAGE_DOMAINS}</a></td>
                <td width="23"><a href="manage_domains.php"  onMouseOver=over(6); onMouseOut=out(6);><img src="../images/menubutton_right.gif" name="image6_2" width="23" height="23" border="0"></a></td>
              </tr>
              <tr>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td nowrap height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
              </tr>
              <tr>
                <td width="23"><a href="reseller_user_statistics.php"  onMouseOver=over(7); onMouseOut=out(7);><img src="../images/menubutton_left.gif" name="image7_1" width="23" height="23" border="0"></a></td>
                <td nowrap id="id7" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'"><a href="reseller_user_statistics.php" class="menu" onMouseOver=over(7); onMouseOut=out(7);>{TR_MENU_DOMAIN_STATISTICS}</a></td>
                <td width="23"><a href="reseller_user_statistics.php"  onMouseOver=over(7); onMouseOut=out(7);><img src="../images/menubutton_right.gif" name="image7_2" width="23" height="23" border="0"></a></td>
              </tr>
              <tr>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td nowrap height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
              </tr>
              <tr>
                <td width="23"><a href="support_system.php"  onMouseOver=over(8); onMouseOut=out(8);><img src="../images/menubutton_left.gif" name="image8_1" width="23" height="23" border="0"></a></td>
                <td nowrap id="id8" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'"><a href="support_system.php" class="menu" onMouseOver=over(8); onMouseOut=out(8);>{TR_MENU_QUESTIONS_AND_COMMENTS}</a></td>
                <td width="23"><a href="support_system.php"  onMouseOver=over(8); onMouseOut=out(8);><img src="../images/menubutton_right.gif" name="image8_2" width="23" height="23" border="0"></a></td>
              </tr>
              <tr>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td nowrap height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
              </tr>
              <tr>
                <td width="23"><a href="layout.php"  onMouseOver=over(9); onMouseOut=out(9);><img src="../images/menubutton_left.gif" name="image9_1" width="23" height="23" border="0"></a></td>
                <td nowrap id="id9" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'"><a href="layout.php" class="menu" onMouseOver=over(9); onMouseOut=out(9);>{TR_MENU_LAYOUT_SETTINGS}</a></td>
                <td width="23"><a href="layout.php"  onMouseOver=over(9); onMouseOut=out(9);><img src="../images/menubutton_right.gif" name="image9_2" width="23" height="23" border="0"></a></td>
              </tr>
              <!-- BDP: custom_buttons -->
              <tr>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td nowrap height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
              </tr>
              <tr>
                <td width="23"><a href="{BUTTON_LINK}" {BUTTON_TARGET} onMouseOver=over({BUTTON_ID}); onMouseOut=out({BUTTON_ID});><img src="../images/menubutton_left.gif" name="image{BUTTON_ID}_1" width="23" height="23" border="0"></a></td>
                <td nowrap id="id{BUTTON_ID}" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'"><a href="{BUTTON_LINK}" {BUTTON_TARGET} class="menu" onMouseOver=over({BUTTON_ID}); onMouseOut=out({BUTTON_ID});>{BUTTON_NAME}</a></td>
                <td width="23"><a href="{BUTTON_LINK}" {BUTTON_TARGET} onMouseOver=over({BUTTON_ID}); onMouseOut=out({BUTTON_ID});><img src="../images/menubutton_right.gif" name="image{BUTTON_ID}_2" width="23" height="23" border="0"></a></td>
              </tr>
              <!-- EDP: custom_buttons -->
              <tr>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td nowrap height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
              </tr>
              <tr>
                <td width="23"><a href="../index.php"  onMouseOver=over(10); onMouseOut=out(10);><img src="../images/menubutton_left.gif" name="image10_1" width="23" height="23" border="0"></a></td>
                <td nowrap id="id10" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)'" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'"><a href="../index.php" class="menu" onMouseOver=over(10); onMouseOut=out(10);>{TR_MENU_LOGOUT}</a></td>
                <td width="23"><a href="../index.php"  onMouseOver=over(10); onMouseOut=out(10);><img src="../images/menubutton_right.gif" name="image10_2" width="23" height="23" border="0"></a></td>
              </tr>
              <tr>
                <td height="8"><img src="../images/trans.gif" width="10" height="15"></td>
                <td nowrap height="8"><img src="../images/trans.gif" width="10" height="8"></td>
                <td height="8"><img src="../images/trans.gif" width="10" height="8"></td>
              </tr>
            </table>
            <!-- end of menus -->


          </td>
          <td background="../images/menu_right_background.jpg"><img src="../images/trans.gif" width="30" height="1"></td>
        </tr>
        <tr> 
          <td width="31"><img src="../images/menu_down_left2.jpg" width="31" height="16"></td>
          <td align="center" background="../images/menu_down.jpg"><img src="{THEME_COLOR_PATH}/images/menu_down.jpg" width="186" height="16"></td>
          <td width="30"><img src="../images/menu_down_right2.jpg" width="30" height="16"></td>
        </tr>
        <tr> 
          <td width="31"><img src="../images/menu_down_left.jpg" width="31" height="14"></td>
          <td background="../images/menu_down_background.jpg"><img src="../images/menu_down_background.jpg" width="1" height="14"></td>
          <td width="30"><img src="../images/menu_down_right.jpg" width="30" height="14"></td>
        </tr>
      </table>


<!-- end of menutable -->



    </td>
    <td width="20"><img src="../images/trans.gif" width="20" height="1"></td>
    <td valign="top"> 
	<form name="reseller_add_users_second_frm" method="post" action="rau2.php">
      <table width="100" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="18"><img src="../images/table/top_left.jpg" width="18" height="15"></td>
          <td background="../images/table/top_background.jpg"><img src="../images/table/top_background.jpg" width="1" height="15"></td>
          <td width="21"><img src="../images/table/top_right.jpg" width="21" height="15"></td>
        </tr>
        <tr> 
          <td width="18"><img src="../images/table/top_left2.jpg" width="18" height="23"></td>
          <td background="../images/table/title_background.jpg"> 
            
<!-- content -->


			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td rowspan="2" width="18" height="19"><img src="{THEME_COLOR_PATH}/images/point.gif" width="18" height="19"></td>
                <td class="title"> &nbsp;{TR_ADD_USER}</td>
              </tr>
              <tr> 
                <td background="../images/table/title_line.gif"><img src="../images/table/title_line.gif" width="1" height="4"></td>
              </tr>
            </table>
          </td>
          <td width="21"><img src="../images/table/top_right2.jpg" width="21" height="23"></td>
        </tr>
        <tr> 
          <td width="18" background="../images/table/left_background_small.jpg">&nbsp;</td>
          <td background="../images/table/background_small.jpg" valign="top" height="370"> 
            <table width="450" cellspacing="5">
              <tr> 
                <td colspan="2" class="title"><b>{TR_HOSTING_PLAN_PROPERTIES}</b></td>
              </tr>
			  <div align="center"><font color="#FF0000">{MESSAGE}</div>
              <tr> 
                <td class="content2" width="175">{TR_TEMPLATE_NAME}</td>
                <td class="content3" width="254"><input name=template type=hidden id="template" value="{VL_TEMPLATE_NAME}">
                  {VL_TEMPLATE_NAME}			
                </td>
              </tr>
              <!--<tr> 
                <td class="content2" width="175">{TR_MAX_DOMAIN}<b><i></i></b></td>
                <td width="254"> 
                  <input type="text" name=nreseller_max_domain_cnt value="{MAX_DMN_CNT}" style="width:140px" class="textinput">
                </td>
              </tr>-->
              <tr> 
                <td class="content2" width="175">{TR_MAX_SUBDOMAIN}<b><i></i></b></td>
                <td width="254"> 
                  <input type="text" name=nreseller_max_subdomain_cnt value="{MAX_SUBDMN_CNT}" style="width:140px" class="textinput">
                </td>
              </tr>
              <!--
			  <tr> 
                <td class="content2" width="175">{TR_MAX_DOMAIN_ALIAS}<b><i></i></b></td>
                <td width="254"> 
                  <input type="text" name=nreseller_max_alias_cnt value="{MAX_DMN_ALIAS_CNT}" style="width:140px" class="textinput">
                </td>
              </tr>
			  -->
              <tr> 
                <td class="content2" width="175">{TR_MAX_MAIL_COUNT}<b><i></i></b></td>
                <td width="254"> 
				  <input type=hidden name=nreseller_max_alias_cnt value="0" style="width:140px" class="textinput">
                  <input type="text" name=nreseller_max_mail_cnt value="{MAX_MAIL_CNT}" style="width:140px" class="textinput">
                </td>
              </tr>
              <tr> 
                <td class="content2" width="175">{TR_MAX_FTP}<b><i></i></b></td>
                <td width="254"> 
                  <input type="text" name=nreseller_max_ftp_cnt value="{MAX_FTP_CNT}" style="width:140px" class="textinput">
                </td>
              </tr>
              <tr> 
                <td class="content2" width="175">{TR_MAX_SQL_DB}<b><i></i></b></td>
                <td width="254"> 
                  <input type="text" name=nreseller_max_sql_db_cnt value="{MAX_SQL_CNT}" style="width:140px" class="textinput">
                </td>
              </tr>
              <tr> 
                <td class="content2" width="175">{TR_MAX_SQL_USERS}<b><i></i></b></td>
                <td width="254"> 
                  <input type="text" name=nreseller_max_sql_user_cnt value="{VL_MAX_SQL_USERS}" style="width:140px" class="textinput">
                </td>
              </tr>
              <tr> 
                <td class="content2" width="175">{TR_MAX_TRAFFIC}<b><i></i></b></td>
                <td width="254"> 
                  <input type="text" name=nreseller_max_traffic value="{VL_MAX_TRAFFIC}" style="width:140px" class="textinput">
                </td>
              </tr>
              <tr> 
                <td class="content2" width="175">{TR_MAX_DISK_USAGE}<b><i></i></b></td>
                <td width="254"> 
                  <input type="text" name=nreseller_max_disk value="{VL_MAX_DISK_USAGE}" style="width:140px" class="textinput">
                </td>
              </tr>
              <tr> 
                <td class="content2" width="175">{TR_PHP}</td>
                <td width="254" class="content3"> 
                  <input name="php" type="radio" value="yes" {VL_PHPY}>
                  {TR_YES}
                  <input type="radio" name="php" value="no" {VL_PHPN}>
                  {TR_NO}</td>
              </tr>
              <tr> 
                <td class="content2" width="175">{TR_CGI}</td>
                <td width="254" class="content3"> 
                  <input name="cgi" type="radio" value="yes" {VL_CGIY}>
                  {TR_YES}
                  <input type="radio" name="cgi" value="no" {VL_CGIN}>
                  {TR_NO}</td>
              </tr>
              <tr>
			  <!--
                <td class="content2" width="175" height="23">JSP</td>
                <td width="254" class="content3" height="23">
                  <input type="radio" name="jsp" value="yes" checked>
                  Yes 
                  <input type="radio" name="jsp" value="no">
                  No</td>
              </tr>
              <tr> 
                <td class="content2" width="175" height="23">SSI</td>
                <td width="254" class="content3" height="23"> 
                  <input type="radio" name="ssi" value="yes" checked>
                  Yes 
                  <input type="radio" name="ssi" value="no">
                  No</td>
				 
				  
              </tr>
              <tr> 
                <td class="content2" width="175">{TR_BACKUP_RESTORE}</td>
                <td width="254" class="content3"> 
                  <input name="backup_restore" type="radio" value="yes" checked>
                  {TR_YES}
                  <input type="radio" name="backup_restore" value="no">
                  {TR_NO}</td>
              </tr>
              <tr> 
                <td class="content2" width="175">Custom error pages</td>
                <td width="254" class="content3"> 
                  <input type="radio" name="error_pages" value="yes" checked>
                  Yes 
                  <input type="radio" name="error_pages" value="no">
                  No</td>
              </tr>
              <tr> 
                <td class="content2" width="175">Protected areas</td>
                <td width="254" class="content3"> 
                  <input type="radio" name="protected_areas" value="yes" checked>
                  Yes 
                  <input type="radio" name="protected_areas" value="no">
                  No</td>
				
				  
              </tr>
              <tr> 

                <td class="content2" width="175">Webmail</td>
                <td width="254" class="content3"> 
                  <input type="radio" name="webmail" value="yes" checked>
                  Yes 
                  <input type="radio" name="webmail" value="no">
                  No</td>
              </tr>
              <tr> 
                <td class="content2" width="175">DirectoryListing</td>
                <td width="254" class="content3"> 
                  <input type="radio" name="directorylisting" value="yes" checked>
                  Yes 
                  <input type="radio" name="directorylisting" value="no">
                  No</td>
              </tr>
			  
              <tr> 
                <td class="content2" width="175">{TR_APACHE_LOGS}</td>
                <td width="254" class="content3"> 
                  <input type="radio" name="apachelogfiles" value="yes" checked>
                  {TR_YES}
                  <input type="radio" name="apachelogfiles" value="no">
                  {TR_NO}</td>
              </tr>
              <tr> 
                <td class="content2" width="175">{TR_AWSTATS}</td>
                <td width="254" class="content3"> 
                  <input type="radio" name="awstats" value="yes" checked>
                  {TR_YES}
                  <input type="radio" name="awstats" value="no">
                  {TR_NO}</td>
              </tr>
			  -->
            </table>
            <table border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="23"><a href="#"  onMouseOver=over(40); onMouseOut=out(40); "onClick="return sbmt(document.forms[0],'rau2_nxt')" ><img src="../images/menubutton_left.gif" name="image40_1" width="23" height="23" border="0"></a></td>
                <td nowrap id="id40" background="../images/menubutton_background.gif" onMouseOver="this.style.backgroundImage='url({THEME_COLOR_PATH}/images/menu_button_background.gif)' "onClick="return sbmt(document.forms[0],'rau2_nxt')" onMouseOut="this.style.backgroundImage='url(../images/menubutton_background.gif)'"><a href="#" class="menu" onMouseOver=over(40); onMouseOut=out(40);>{TR_NEXT_STEP}</a></td>
                <td width="23"><a href="#"  onMouseOver=over(40); onMouseOut=out(40); onClick="return sbmt(document.forms[0],'rau2_nxt')"><img src="../images/menubutton_right.gif" name="image40_2" width="23"height="23" border="0"></a></td>
              </tr>
			  
            </table>
            <!-- end of content -->
          </td>
          <td background="../images/table/right_background_small.jpg" width="21">&nbsp;</td>
        </tr>
        <tr> 
          <td width="18"><img src="../images/table/down_left.jpg" width="18" height="24"></td>
          <td background="../images/table/down_background.jpg"><img src="../images/table/down_background.jpg" width="1" height="24"></td>
          <td width="21"><img src="../images/table/down_right.jpg" width="21" height="24"></td>
        </tr>
      </table>
	  <input type="hidden" name="uaction" value="">
	  </form>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="47" colspan="7"> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="34"><img src="../images/down_left.jpg" width="34" height="50"></td>
          <td background="../images/down_background.jpg"> 
            <table border="0" cellspacing="0" cellpadding="0" width="100" align="center">
              <tr>
                <td width="13"><img src="{THEME_COLOR_PATH}/images/down_content_left.jpg" width="13" height="24"></td>
                <td class="bottom" background="{THEME_COLOR_PATH}/images/down_content_background.jpg" nowrap>{VHCS_LICENSE}</td>
                <td width="13"><img src="{THEME_COLOR_PATH}/images/down_content_right.jpg" width="13" height="24"></td>
              </tr>
            </table></td>
          <td width="34"><img src="../images/down_right.jpg" width="34" height="50"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
