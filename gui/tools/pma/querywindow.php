<?php
/* $Id: querywindow.php,v 2.16 2005/01/20 16:38:46 mkkeck Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:


/**
 * Gets the variables sent to this script, retains the db name that may have
 * been defined as startup option and include a core library
 */
require_once('./libraries/grab_globals.lib.php');
if (!empty($db)) {
    $db_start = $db;
}


/**
 * Gets a core script and starts output buffering work
 */
require_once('./libraries/common.lib.php');
require_once('./libraries/ob.lib.php');
if ($cfg['OBGzip']) {
    $ob_mode = PMA_outBufferModeGet();
    if ($ob_mode) {
        PMA_outBufferPre($ob_mode);
    }
}

require_once('./libraries/relation.lib.php');
$cfgRelation = PMA_getRelationsParam();

/**
 * Get the list and number of available databases.
 * Skipped if no server selected: in this case no database should be displayed
 * before the user choose among available ones at the welcome screen.
 */
if ($server > 0) {
    PMA_availableDatabases(); // this function is defined in "common.lib.php"
} else {
    $num_dbs = 0;
}

// garvin: For re-usability, moved http-headers and stylesheets
// to a seperate file. It can now be included by header.inc.php,
// queryframe.php, querywindow.php.

require_once('./libraries/header_http.inc.php');
require_once('./libraries/header_meta_style.inc.php');
?>

<script type="text/javascript" language="javascript">
<!--
function query_auto_commit() {
    document.sqlform.submit();
}

function query_tab_commit(tab) {
    document.querywindow.querydisplay_tab.value = tab;
    document.querywindow.submit();
    return false;
}

// js form validation stuff
/**/
var errorMsg0   = '<?php echo str_replace('\'', '\\\'', $GLOBALS['strFormEmpty']); ?>';
var errorMsg1   = '<?php echo str_replace('\'', '\\\'', $GLOBALS['strNotNumber']); ?>';
var errorMsg2   = '<?php echo str_replace('\'', '\\\'', $GLOBALS['strNotValidNumber']); ?>';
var noDropDbMsg = '<?php echo((!$GLOBALS['cfg']['AllowUserDropDatabase']) ? str_replace('\'', '\\\'', $GLOBALS['strNoDropDatabases']) : ''); ?>';
var confirmMsg  = '<?php echo(($GLOBALS['cfg']['Confirm']) ? str_replace('\'', '\\\'', $GLOBALS['strDoYouReally']) : ''); ?>';
/**/
//-->
</script>
<script src="libraries/functions.js" type="text/javascript" language="javascript"></script>
</head>

<body bgcolor="<?php echo ($cfg['QueryFrameJS'] ? $cfg['LeftBgColor'] : $cfg['RightBgColor']); ?>">
<?php
if ($cfg['QueryFrameJS'] && !isset($no_js)) {
    $querydisplay_tab = (isset($querydisplay_tab) ? $querydisplay_tab : $cfg['QueryWindowDefTab']);

    if ($cfg['LightTabs']) {
        echo '&nbsp;';
    } else {
    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%">' . "\n"
       . '    <tr>' . "\n"
       . '        <td class="nav" align="left" nowrap="nowrap" valign="bottom">'
       . '            <table border="0" cellpadding="0" cellspacing="0"><tr>'
       . '                <td nowrap="nowrap"><img src="' .$GLOBALS['pmaThemeImage'] . 'spacer.png'  . '" width="2" height="1" border="0" alt="" /></td>'
       . '                <td class="navSpacer"><img src="' .$GLOBALS['pmaThemeImage'] . 'spacer.png'  .'" width="1" height="1" border="0" alt="" /></td>';
    }
    echo "\n";
    echo PMA_printTab(($GLOBALS['cfg']['PropertiesIconic'] != false ? '<img src="' . $GLOBALS['pmaThemeImage'] . 'b_sql.png" width="16" height="16" border="0" hspace="2" align="middle" alt="'.$strSQL.'" />' : '') . $strSQL, '#', '', ' onclick="javascript:query_tab_commit(\'sql\');return false;"', '', '', (isset($querydisplay_tab) && $querydisplay_tab == 'sql' ? TRUE : FALSE));
    echo PMA_printTab(($GLOBALS['cfg']['PropertiesIconic'] != false ? '<img src="' . $GLOBALS['pmaThemeImage'] . 'b_import.png" width="16" height="16" border="0" hspace="2" align="middle" alt="'.$strImportFiles.'" />' : '') . $strImportFiles, '#', '', ' onclick="javascript:query_tab_commit(\'files\');return false;"', '', '', (isset($querydisplay_tab) && $querydisplay_tab == 'files' ? TRUE : FALSE));
    echo PMA_printTab($strQuerySQLHistory, '#', '', ' onclick="javascript:query_tab_commit(\'history\');return false;"', '', '', (isset($querydisplay_tab) && $querydisplay_tab == 'history' ? TRUE : FALSE));

    if ($cfg['QueryWindowDefTab'] == 'full') {
        echo PMA_printTab($strAll, '#', '', ' onclick="javascript:query_tab_commit(\'full\');return false;"', '', '', (isset($querydisplay_tab) && $querydisplay_tab == 'full' ? TRUE : FALSE));
    }

    if (!$cfg['LightTabs']) {
    echo '                <td nowrap="nowrap"><img src="' .$GLOBALS['pmaThemeImage'] . 'spacer.png'  . '" width="2" height="1" border="0" alt="" /></td>'
       . '            </tr></table>' . "\n"
       . '        </td>' . "\n"
       . '    </tr>' . "\n"
       . '</table>';
    } else {
        echo '<br />';
    }
} else {
    $querydisplay_tab = 'full';
}

?>
<br />
<?php
if ($cfg['PropertiesIconic'] == true) {
    // We need to copy the value or else the == 'both' check will always return true
    $propicon = (string)$cfg['PropertiesIconic'];

    if ($propicon == 'both') {
        $iconic_spacer = '<div class="nowrap">';
    } else {
        $iconic_spacer = '';
    }

    $titles['Change']        = $iconic_spacer . '<img hspace="2" width="16" height="16" src="' . $pmaThemeImage . 'b_edit.png" alt="' . $strChange . '" title="' . $strChange . '" border="0" />';

    if ($propicon == 'both') {
        $titles['Change']        .= '&nbsp;' . $strChange . '&nbsp;</div>';
    }
} else {
    $titles['Change']        = $strChange;
}

// Hidden forms and query frame interaction stuff
if ($cfg['QueryFrame'] && $cfg['QueryFrameJS']) {

    $input_query_history = array();
    $sql_history = array();
    $dup_sql = array();

    if (isset($query_history_latest) && isset($query_history_latest_db) && $query_history_latest != '' && $query_history_latest_db != '') {
        if ($cfg['QueryHistoryDB'] && $cfgRelation['historywork']) {
            PMA_setHistory((isset($query_history_latest_db) ? $query_history_latest_db : ''), (isset($query_history_latest_table) ? $query_history_latest_table : ''), $cfg['Server']['user'], $query_history_latest);
        }

        $input_query_history[] = '<input type="hidden" name="query_history[]" value="' . $query_history_latest . '" />';
        $input_query_history[] = '<input type="hidden" name="query_history_db[]" value="' . htmlspecialchars($query_history_latest_db) . '" />';
        $input_query_history[] = '<input type="hidden" name="query_history_table[]" value="' . (isset($query_history_latest_table) ? htmlspecialchars($query_history_latest_table) : '') . '" />';

        $sql_history[] = '<li>'
                       . '<a href="#" onclick="document.querywindow.querydisplay_tab.value = \'' . (isset($querydisplay_tab) && $querydisplay_tab != 'full' ? 'sql' : 'full') . '\'; document.querywindow.query_history_latest.value = \'' . preg_replace('/(\n)/i', ' ', addslashes(htmlspecialchars($query_history_latest))) . '\'; document.querywindow.auto_commit.value = \'false\'; document.querywindow.db.value = \'' . htmlspecialchars($query_history_latest_db) . '\'; document.querywindow.query_history_latest_db.value = \'' . htmlspecialchars($query_history_latest_db) . '\'; document.querywindow.table.value = \'' . (isset($query_history_latest_table) ? htmlspecialchars($query_history_latest_table) : '') . '\'; document.querywindow.query_history_latest_table.value = \'' . (isset($query_history_latest_table) ? htmlspecialchars($query_history_latest_table) : '') . '\'; document.querywindow.submit(); return false;">' . $titles['Change'] . '</a>'
                       . '&nbsp;<a href="#" onclick="document.querywindow.querydisplay_tab.value = \'' . (isset($querydisplay_tab) && $querydisplay_tab != 'full' ? 'sql' : 'full') . '\'; document.querywindow.query_history_latest.value = \'' . preg_replace('/(\n)/i', ' ', addslashes(htmlspecialchars($query_history_latest))) . '\'; document.querywindow.auto_commit.value = \'true\'; document.querywindow.db.value = \'' . htmlspecialchars($query_history_latest_db) . '\'; document.querywindow.query_history_latest_db.value = \'' . htmlspecialchars($query_history_latest_db) . '\'; document.querywindow.table.value = \'' . (isset($query_history_latest_table) ? htmlspecialchars($query_history_latest_table) : '') . '\'; document.querywindow.query_history_latest_table.value = \'' . (isset($query_history_latest_table) ? htmlspecialchars($query_history_latest_table) : '') . '\'; document.querywindow.submit(); return false;">[' . htmlspecialchars($query_history_latest_db) . '] ' . urldecode($query_history_latest) . '</a>'
                       . '</li>' . "\n";

        $sql_query = urldecode($query_history_latest);
        $db = $query_history_latest_db;
        $table = $query_history_latest_table;
        $dup_sql[$query_history_latest] = true;
    } elseif (isset($query_history_latest) && $query_history_latest != '') {
        $sql_query = urldecode($query_history_latest);
    }

    if (isset($sql_query)) {
        $show_query = 1;
    }

    if ($cfg['QueryHistoryDB'] && $cfgRelation['historywork']) {

        $temp_history = PMA_getHistory($cfg['Server']['user']);
        if (is_array($temp_history) && count($temp_history) > 0) {
            foreach ($temp_history AS $history_nr => $history_array) {
                if (!isset($dup_sql[$history_array['sqlquery']])) {
                    $sql_history[] = '<li>'
                                   . '<a href="#" onclick="document.querywindow.querydisplay_tab.value = \'' . (isset($querydisplay_tab) && $querydisplay_tab != 'full' ? 'sql' : 'full') . '\'; document.querywindow.query_history_latest.value = \'' . preg_replace('/(\n)/i', ' ', addslashes(htmlspecialchars($history_array['sqlquery']))) . '\'; document.querywindow.auto_commit.value = \'false\'; document.querywindow.db.value = \'' . htmlspecialchars($history_array['db']) . '\'; document.querywindow.query_history_latest_db.value = \'' . htmlspecialchars($history_array['db']) . '\'; document.querywindow.table.value = \'' . (isset($history_array['table']) ? htmlspecialchars($history_array['table']) : '') . '\'; document.querywindow.query_history_latest_table.value = \'' . (isset($history_array['table']) ? htmlspecialchars($history_array['table']) : '') . '\'; document.querywindow.submit(); return false;">' . $titles['Change'] . '</a>'
                                   . '<a href="#" onclick="document.querywindow.querydisplay_tab.value = \'' . (isset($querydisplay_tab) && $querydisplay_tab != 'full' ? 'sql' : 'full') . '\'; document.querywindow.query_history_latest.value = \'' . preg_replace('/(\n)/i', ' ', addslashes(htmlspecialchars($history_array['sqlquery']))) . '\'; document.querywindow.auto_commit.value = \'true\'; document.querywindow.db.value = \'' . htmlspecialchars($history_array['db']) . '\'; document.querywindow.query_history_latest_db.value = \'' . htmlspecialchars($history_array['db']) . '\'; document.querywindow.table.value = \'' . (isset($history_array['table']) ? htmlspecialchars($history_array['table']) : '') . '\'; document.querywindow.query_history_latest_table.value = \'' . (isset($history_array['table']) ? htmlspecialchars($history_array['table']) : '') . '\'; document.querywindow.submit(); return false;">[' . htmlspecialchars($history_array['db']) . '] ' . urldecode($history_array['sqlquery']) . '</a>'
                                   . '</li>' . "\n";
                    $dup_sql[$history_array['sqlquery']] = true;
                }
            }
        }

    } else {

        if (isset($query_history) && is_array($query_history)) {
            $current_index = count($query_history);
            foreach ($query_history AS $query_no => $query_sql) {
                if (!isset($dup_sql[$query_sql])) {

                    $input_query_history[] = '<input type="hidden" name="query_history[]" value="' . $query_sql . '" />';
                    $input_query_history[] = '<input type="hidden" name="query_history_db[]" value="' . htmlspecialchars($query_history_db[$query_no]) . '" />';
                    $input_query_history[] = '<input type="hidden" name="query_history_table[]" value="' . (isset($query_history_table[$query_no]) ? htmlspecialchars($query_history_table[$query_no]) : '') . '" />';

                    $sql_history[] = '<li>'
                                   . '<a href="#" onclick="document.querywindow.querydisplay_tab.value = \'' . (isset($querydisplay_tab) && $querydisplay_tab != 'full' ? 'sql' : 'full') . '\'; document.querywindow.query_history_latest.value = \'' . htmlspecialchars($query_sql) . '\'; document.querywindow.auto_commit.value = \'false\'; document.querywindow.db.value = \'' . htmlspecialchars($query_history_db[$query_no]) . '\'; document.querywindow.query_history_latest_db.value = \'' . htmlspecialchars($query_history_db[$query_no]) . '\'; document.querywindow.table.value = \'' . (isset($query_history_table[$query_no]) ? htmlspecialchars($query_history_table[$query_no]) : '') . '\'; document.querywindow.query_history_latest_table.value = \'' . (isset($query_history_table[$query_no]) ? htmlspecialchars($query_history_table[$query_no]) : '') . '\'; document.querywindow.submit(); return false;">' . $titles['Change'] . '</a>'
                                   . '<a href="#" onclick="document.querywindow.querydisplay_tab.value = \'' . (isset($querydisplay_tab) && $querydisplay_tab != 'full' ? 'sql' : 'full') . '\'; document.querywindow.query_history_latest.value = \'' . htmlspecialchars($query_sql) . '\'; document.querywindow.auto_commit.value = \'true\'; document.querywindow.db.value = \'' . htmlspecialchars($query_history_db[$query_no]) . '\'; document.querywindow.query_history_latest_db.value = \'' . htmlspecialchars($query_history_db[$query_no]) . '\'; document.querywindow.table.value = \'' . (isset($query_history_table[$query_no]) ? htmlspecialchars($query_history_table[$query_no]) : '') . '\'; document.querywindow.query_history_latest_table.value = \'' . (isset($query_history_table[$query_no]) ? htmlspecialchars($query_history_table[$query_no]) : '') . '\'; document.querywindow.submit(); return false;">[' . htmlspecialchars($query_history_db[$query_no]) . '] ' . urldecode($query_sql) . '</a>'
                                   . '</li>' . "\n";
                    $dup_sql[$query_sql] = true;
                } // end if check if this item exists
            } // end while print history
        } // end if history exists

    } // end if DB-based history
}

$url_query = PMA_generate_common_url(isset($db) ? $db : '', isset($table) ? $table : '');
if (!isset($goto)) {
    $goto = '';
}

require_once './libraries/bookmark.lib.php';
$is_inside_querywindow = TRUE;
require './tbl_query_box.php';

// Hidden forms and query frame interaction stuff
if ($cfg['QueryFrame'] && $cfg['QueryFrameJS']) {
    if (isset($auto_commit) && $auto_commit == 'true') {
    ?>
        <script type="text/javascript" language="javascript">
        query_auto_commit();
        </script>
    <?php
    }

    if (isset($sql_history) && isset($querydisplay_tab) && ($querydisplay_tab == 'history' || $querydisplay_tab == 'full') && is_array($sql_history) && count($sql_history) > 0) {
    ?>
        <?php echo $strQuerySQLHistory . ':<br /><ul>' . implode('', $sql_history) . '</ul>'; ?>
    <?php
    }
?>
<form action="querywindow.php" method="post" name="querywindow">
<?php
    echo PMA_generate_common_hidden_inputs('', '');
    if (count($input_query_history) > 0) {
        echo implode("\n", $input_query_history);
    }
?>
    <input type="hidden" name="db" value="<?php echo (empty($db) ? '' : htmlspecialchars($db)); ?>" />
    <input type="hidden" name="table" value="<?php echo (empty($table) ? '' : htmlspecialchars($table)); ?>" />

    <input type="hidden" name="query_history_latest" value="" />
    <input type="hidden" name="query_history_latest_db" value="" />
    <input type="hidden" name="query_history_latest_table" value="" />

    <input type="hidden" name="previous_db" value="<?php echo htmlspecialchars($db); ?>" />

    <input type="hidden" name="auto_commit" value="false" />
    <input type="hidden" name="querydisplay_tab" value="<?php echo $querydisplay_tab; ?>" />
</form>

<?php
}

$tmp_querydisplay_tab =  (isset($querydisplay_tab) ? $querydisplay_tab : $cfg['QueryWindowDefTab']);
if ($tmp_querydisplay_tab == 'sql' || $tmp_querydisplay_tab == $cfg['QueryWindowDefTab']) {
?>
<script type="text/jscript" language="javascript">
<!--
    if (document.getElementById && typeof(document.getElementById('sqlcontainer'))!='undefined') {
        var newWidth  = document.getElementById('sqlcontainer').offsetWidth + 40;
        var newHeight = document.getElementById('sqlcontainer').offsetHeight + 100;
        self.resizeTo(newWidth, newHeight);
    }
//-->
</script>
<?php
}
?>
</body>
</html>

<?php
/**
 * Close MySql connections
 */
if (isset($dbh) && $dbh) {
    PMA_DBI_close($dbh);
}
if (isset($userlink) && $userlink) {
    PMA_DBI_close($userlink);
}


/**
 * Sends bufferized data
 */
if (isset($cfg['OBGzip']) && $cfg['OBGzip']
    && isset($ob_mode) && $ob_mode) {
     PMA_outBufferPost($ob_mode);
}
?>
