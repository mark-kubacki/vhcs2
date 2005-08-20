<?php
/* $Id: index.php,v 2.14 2004/10/19 17:23:09 nijel Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Gets core libraries and defines some variables
 */
require_once('./libraries/grab_globals.lib.php');
require_once('./libraries/common.lib.php');
/**
 * Includes the ThemeManager if it hasn't been included yet
 */
require_once('./libraries/select_theme.lib.php');

/**
 * Saves collation_connection (coming from main.php) in a cookie
 */

// (from grab_globals)
if (isset($collation_connection)) {
    if (!isset($pma_uri_parts)) {
        $pma_uri_parts = parse_url($cfg['PmaAbsoluteUri']);
        $cookie_path   = substr($pma_uri_parts['path'], 0, strrpos($pma_uri_parts['path'], '/'));
        $is_https      = (isset($pma_uri_parts['scheme']) && $pma_uri_parts['scheme'] == 'https') ? 1 : 0;
    }
    setcookie('pma_collation_connection', $collation_connection, time() + 60*60*24*30, $cookie_path, '', $is_https);
}
// Gets the default font sizes
PMA_setFontSizes();

// Gets the host name
// loic1 - 2001/25/11: use the new globals arrays defined with php 4.1+
if (empty($HTTP_HOST)) {
    if (!empty($_ENV) && isset($_ENV['HTTP_HOST'])) {
        $HTTP_HOST = $_ENV['HTTP_HOST'];
    }
    else if (@getenv('HTTP_HOST')) {
        $HTTP_HOST = getenv('HTTP_HOST');
    }
    else {
        $HTTP_HOST = '';
    }
}
/**
 * Defines the frameset
 */
// loic1: If left light mode -> urldecode the db name
if (isset($lightm_db)) {
// no longer urlencoded because of html entities in the db name
//    $db    = urldecode($lightm_db);
    $db    = $lightm_db;
    unset($lightm_db);
}
$url_query = PMA_generate_common_url(isset($db) ? $db : '');
header('Content-Type: text/html; charset=' . $GLOBALS['charset']);

require_once('./libraries/relation.lib.php');
$cfgRelation = PMA_getRelationsParam();

if ($cfg['QueryHistoryDB'] && $cfgRelation['historywork']) {
    PMA_purgeHistory($cfg['Server']['user']);
}

$phpmain_hash = md5($cfg['PmaAbsoluteUri']);
$phpmain_hash_js = time();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $available_languages[$lang][2]; ?>" lang="<?php echo $available_languages[$lang][2]; ?>" dir="<?php echo $text_dir; ?>">
<head>
<title>phpMyAdmin <?php echo PMA_VERSION; ?> - <?php echo $HTTP_HOST; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />
<link rel="stylesheet" type="text/css" href="./css/phpmyadmin.css.php?lang=<?php echo $lang; ?>&amp;js_frame=right" />
</head>

<?php
$logo_image = $GLOBALS['pmaThemeImage'] . 'logo_left.png';
$query_frame_height = 0;
if ($cfg['LeftDisplayLogo'] && @file_exists($logo_image)) {
    $tmp_imgsize = @getimagesize($logo_image);
    $query_frame_height = ($tmp_imgsize[1] + 60);
    // increase the height to take into account font size differences in
    // theme 'original'? (TODO: improve with a parameter in layout.inc.php)
    $query_frame_height += ((!isset($GLOBALS['theme']) || $GLOBALS['theme']=='original') ? 25 : 0);
}
if ($query_frame_height == 0) {
    $query_frame_height = 60;
}
// increase the height to take into account font size differences in
// theme 'original'? (TODO: improve with a parameter in layout.inc.php)
$query_frame_height += ((!isset($GLOBALS['theme']) || $GLOBALS['theme']=='original') ? 20 : 10);

if ($cfg['LeftDisplayServers'] && !$cfg['DisplayServersList']) {
    $query_frame_height += 40;
}
if ($server > 0) {
    PMA_availableDatabases(); // this function is defined in "common.lib.php"
} else {
    $num_dbs = 0;
}
if ($num_dbs > 1) {
    if ($cfg['LeftFrameLight']) {
        $query_frame_height += 20;
    }
}
if ($cfg['QueryFrame']) {
    /* Will we show list of servers? */
    if ($cfg['LeftDisplayServers'] && $cfg['DisplayServersList'] && count($cfg['Servers']) > 1) {
        $query_frame_height += (count($cfg['Servers']) + 1)*15;
    }

    if ($cfg['QueryFrameJS']) {
        echo '<script type="text/javascript">' . "\n";
        echo '<!--' . "\n";
        echo '    document.writeln(\'<frameset cols="' . $cfg['LeftWidth'] . ',*" rows="*" border="1" frameborder="1" framespacing="1" name="mainFrameset" id="mainFrameset">\');' . "\n";
        echo '    document.writeln(\'    <frameset rows="' . $query_frame_height . ', *" framespacing="0" frameborder="0" border="0" name="leftFrameset" id="leftFrameset">\');' . "\n";
        echo '    document.writeln(\'        <frame src="queryframe.php?' . $url_query . '&amp;hash=' . $phpmain_hash . $phpmain_hash_js . '" name="queryframe" frameborder="0" scrolling="no" id="leftQueryframe" />\');' . "\n";
        echo '    document.writeln(\'        <frame src="left.php?' . $url_query . '&amp;hash=' . $phpmain_hash . $phpmain_hash_js . '" name="nav" frameborder="0" id="leftFrame" />\');' . "\n";
        echo '    document.writeln(\'    </frameset>\');' . "\n";
        echo '    document.writeln(\'    <frame src="' . (empty($db) ? $cfg['DefaultTabServer']  : $cfg['DefaultTabDatabase']) . '?' . $url_query . '" name="phpmain' . $phpmain_hash . $phpmain_hash_js . '" border="0" frameborder="0" style="border-left: 1px solid #000000;" id="rightFrame" />\');' . "\n";
        echo '    document.writeln(\'    <noframes>\');' . "\n";
        echo '    document.writeln(\'        <body bgcolor="#FFFFFF">\');' . "\n";
        echo '    document.writeln(\'            <p>' . str_replace("'", "\'", $strNoFrames) . '</p>\');' . "\n";
        echo '    document.writeln(\'        </body>\');' . "\n";
        echo '    document.writeln(\'    </noframes>\');' . "\n";
        echo '    document.writeln(\'</frameset>\');' . "\n";
        echo '//-->' . "\n";
        echo '</script>' . "\n";
        echo "\n";
        echo '<noscript>' . "\n";
    }

    echo '<frameset cols="' . $cfg['LeftWidth'] . ',*" rows="*"  border="1" frameborder="1" framespacing="1" name="mainFrameset" id="mainFrameset">' . "\n";
    echo '    <frameset rows="' . $query_frame_height . ', *" framespacing="0" frameborder="0" border="0" name="leftFrameset" id="leftFrameset">' . "\n";
    echo '        <frame src="queryframe.php?' . $url_query . '&amp;hash=' . $phpmain_hash . '" name="queryframe" frameborder="0" scrolling="no" id="leftQueryframe" />' . "\n";
    echo '        <frame src="left.php?' . $url_query . '&amp;hash=' . $phpmain_hash . '" name="nav" frameborder="0" id="leftFrame" />' . "\n";
    echo '    </frameset>' . "\n";
    echo '    <frame src="' . (empty($db) ? $cfg['DefaultTabServer']  : $cfg['DefaultTabDatabase']) . '?' . $url_query . '" name="phpmain' . $phpmain_hash . '" frameborder="0" id="rightFrame" />' . "\n";

} else {

    echo '<frameset cols="' . $cfg['LeftWidth'] . ',*" rows="*" border="1" frameborder="1" framespacing="1" id="leftFrameset" >' . "\n";
    echo '    <frame src="left.php?' . $url_query . '&amp;hash=' . $phpmain_hash . '" name="nav" frameborder="0" id="leftFrame" />' . "\n";
    echo '    <frame src="' . (empty($db) ? $cfg['DefaultTabServer']  : $cfg['DefaultTabDatabase']) . '?' . $url_query . '" name="phpmain' . $phpmain_hash . '" id="rightFrame" frameborder="1" />' . "\n";

}
?>

    <noframes>
        <body bgcolor="#FFFFFF">
            <p><?php echo $strNoFrames; ?></p>
        </body>
    </noframes>
</frameset>
<?php
if ($cfg['QueryFrame'] && $cfg['QueryFrameJS']) {
    echo '</noscript>' . "\n";
}
?>

</html>
