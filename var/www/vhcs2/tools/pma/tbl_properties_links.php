<?php
/* $Id: tbl_properties_links.php,v 2.11.4.1 2005/06/30 17:27:22 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

// Check parameters

require_once('./libraries/common.lib.php');

PMA_checkParameters(array('db', 'table'));

echo '<!-- top menu -->' . "\n";

/**
 * Count amount of navigation tabs
 */
$db_details_links_count_tabs = 0;


/**
 * Prepares links
 */
require_once('./libraries/bookmark.lib.php');
$book_sql_query = PMA_queryBookmarks($db, $cfg['Bookmark'], '\'' . PMA_sqlAddslashes($table) . '\'', 'label');

if ($table_info_num_rows > 0 || $tbl_is_view) {
    $lnk2    = 'sql.php';
    $arg2    = $url_query
             . '&amp;sql_query=' . (isset($book_sql_query) && $book_sql_query != FALSE ? urlencode($book_sql_query) : urlencode('SELECT * FROM ' . PMA_backquote($table)))
             . '&amp;pos=0';
    $lnk4    = 'tbl_select.php';
    $arg4    = $url_query;
    if ($tbl_is_view) {
        $lnk8    = '';
        $arg8    = '';
        $att8    = '';
        $class8  = '';
    } else {
        $ln8_stt = (PMA_MYSQL_INT_VERSION >= 40000)
                 ? 'TRUNCATE TABLE '
                 : 'DELETE FROM ';
        $lnk8    = 'sql.php';
        $arg8    = $url_query . '&amp;sql_query='
                 . urlencode($ln8_stt . PMA_backquote($table))
                 .  '&amp;zero_rows='
                 .  urlencode(sprintf($strTableHasBeenEmptied, htmlspecialchars($table)));
        $att8    = 'onclick="return confirmLink(this, \'' . $ln8_stt . PMA_jsFormat($table) . '\')"';
        $class8  = 'Drop';
    }
} else {
    $lnk2    = '';
    $arg2    = '';
    $lnk4    = '';
    $arg4    = '';
    $lnk8    = '';
    $arg8    = '';
    $att8    = '';
    $class8  = 'Drop';
}

$arg9 = $url_query . '&amp;reload=1&amp;purge=1&amp;sql_query=' . urlencode('DROP ' . ($tbl_is_view ? 'VIEW' : 'TABLE') . ' ' . PMA_backquote($table) ) . '&amp;zero_rows=' . urlencode(sprintf($strTableHasBeenDropped, htmlspecialchars($table)));
$att9 = 'onclick="return confirmLink(this, \'DROP TABLE ' . PMA_jsFormat($table) . '\')"';
$class9 = 'Drop';


/**
 * Displays links
 */

if ($cfg['LightTabs']) {
    echo '&nbsp;';
} else {
    echo '<table border="0" cellspacing="0" cellpadding="0" width="100%" id="topmenu">' . "\n"
       . '    <tr>' . "\n"
       . '        <td class="nav" align="left" nowrap="nowrap" valign="bottom">'
       . '            <table border="0" cellpadding="0" cellspacing="0"><tr>'
       . '                <td nowrap="nowrap"><img src="' . $GLOBALS['pmaThemeImage'] . 'spacer.png' . '" width="2" height="1" border="0" alt="" /></td>'
       . '                <td class="navSpacer"><img src="' . $GLOBALS['pmaThemeImage'] . 'spacer.png' . '" width="1" height="1" border="0" alt="" /></td>';
}

echo PMA_printTab(($GLOBALS['cfg']['MainPageIconic'] ? '<img src="' . $GLOBALS['pmaThemeImage'] . 'b_props.png" width="16" height="16" border="0" hspace="2" align="middle" alt="'.$strStructure.'" />' : '') . $strStructure, 'tbl_properties_structure.php', $url_query)
   . PMA_printTab(($GLOBALS['cfg']['MainPageIconic'] ? '<img src="' . $GLOBALS['pmaThemeImage'] . 'b_browse.png" width="16" height="16" border="0" hspace="2" align="middle" alt="'.$strBrowse.'" />' : '') . $strBrowse, $lnk2, $arg2)
   . PMA_printTab(($GLOBALS['cfg']['MainPageIconic'] ? '<img src="' . $GLOBALS['pmaThemeImage'] . 'b_sql.png" width="16" height="16" border="0" hspace="2" align="middle" alt="'.$strSQL.'" />' : '') . $strSQL, 'tbl_properties.php', $url_query)
   . PMA_printTab(($GLOBALS['cfg']['MainPageIconic'] ? '<img src="' . $GLOBALS['pmaThemeImage'] . 'b_search.png" width="16" height="16" border="0" hspace="2" align="middle" alt="'.$strSearch.'" />' : '') . $strSearch, $lnk4, $arg4)
   . PMA_printTab(($GLOBALS['cfg']['MainPageIconic'] ? '<img src="' . $GLOBALS['pmaThemeImage'] . 'b_insrow.png" width="16" height="16" border="0" hspace="2" align="middle" alt="'.$strInsert.'" />' : '') . $strInsert, 'tbl_change.php', $url_query);
/**
 * Don't display "Export", "Operations" and "Empty" for views.
 */
if (!$tbl_is_view) {
    echo PMA_printTab(($GLOBALS['cfg']['MainPageIconic'] ? '<img src="' . $GLOBALS['pmaThemeImage'] . 'b_tblexport.png" width="16" height="16" border="0" hspace="2" align="middle" alt="'.$strExport.'" />' : '') . $strExport, 'tbl_properties_export.php', $url_query . '&amp;single_table=true')
       . PMA_printTab(($GLOBALS['cfg']['MainPageIconic'] ? '<img src="' . $GLOBALS['pmaThemeImage'] . 'b_tblops.png" width="16" height="16" border="0" hspace="2" align="middle" alt="'.$strOperations.'" />' : '') . $strOperations, 'tbl_properties_operations.php', $url_query)
       . PMA_printTab(($GLOBALS['cfg']['MainPageIconic'] ? '<img src="' . $GLOBALS['pmaThemeImage'] . 'b_empty.png" width="16" height="16" border="0" hspace="2" align="middle" alt="'.$strEmpty.'" />' : '') . $strEmpty, $lnk8, $arg8, $att8, $class8);
}
echo PMA_printTab(($GLOBALS['cfg']['MainPageIconic'] ? '<img src="' . $GLOBALS['pmaThemeImage'] . 'b_deltbl.png" width="16" height="16" border="0" hspace="2" align="middle" alt="'.$strDrop.'" />' : '') . $strDrop, 'sql.php', $arg9, $att9, $class9)
   . "\n";

if (!$cfg['LightTabs']) {
    echo '                <td nowrap="nowrap"><img src="' .$GLOBALS['pmaThemeImage'] . 'spacer.png' . '" width="2" height="1" border="0" alt="" /></td>'
       . '            </tr></table>' . "\n"
       . '        </td>' . "\n"
       . '    </tr>' . "\n"
       . '</table>';
} else {
    echo '<br />';
}

/**
 * Displays table comment
 */
if (!empty($show_comment) && !isset($avoid_show_comment)) {
    ?>
<!-- Table comment -->
<p><i>
    <?php echo htmlspecialchars($show_comment) . "\n"; ?>
</i></p>
    <?php
} // end if

echo "\n\n";

/**
 * Displays a message
 */
if (!empty($message)) {
    PMA_showMessage($message);
    unset($message);
}

?><br />
