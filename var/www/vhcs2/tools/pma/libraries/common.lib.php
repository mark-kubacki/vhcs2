<?php
/* $Id: common.lib.php,v 2.134 2005/06/08 16:56:50 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Misc stuff and functions used by almost all the scripts.
 * Among other things, it contains the advanced authentification work.
 */

/**
 * Order of sections for common.lib.php:
 *
 * some functions need the constants of libraries/defines.lib.php
 * and defines_mysql.lib.php
 *
 * the PMA_setFontSizes() function must be before the call to the
 * libraries/auth/cookie.auth.lib.php library
 *
 * the include of libraries/defines_mysql.lib.php must be after the connection
 * to db to get the MySql version
 *
 * the PMA_sqlAddslashes() function must be before the connection to db
 *
 * the authentication libraries must be before the connection to db but
 * after the PMA_isInto() function
 *
 * the PMA_mysqlDie() function must be before the connection to db but
 * after mysql extension has been loaded
 *
 * the PMA_mysqlDie() function needs the PMA_format_sql() Function
 *
 * ... so the required order is:
 *
 * - parsing of the configuration file
 * - load of the libraries/defines.lib.php library
 * - load of mysql extension (if necessary)
 * - definition of PMA_sqlAddslashes()
 * - definition of PMA_format_sql()
 * - definition of PMA_mysqlDie()
 * - definition of PMA_isInto()
 * - definition of PMA_setFontSizes()
 * - loading of an authentication library
 * - db connection
 * - authentication work
 * - load of the libraries/defines_mysql.lib.php library to get the MySQL
 *   release number
 * - other functions, respecting dependencies
 */

/**
 * Minimum inclusion? (i.e. for the stylesheet builder)
 */

if (!isset($is_minimum_common)) {
    $is_minimum_common = FALSE;
}

/**
 * Avoids undefined variables
 */
if (!isset($use_backquotes)) {
    $use_backquotes   = 0;
}
if (!isset($pos)) {
    $pos              = 0;
}

/**
 * 2004-06-30 rabus: Ensure, that $cfg variables are not set somwhere else
 * before including the config file.
 */
unset($cfg);

/**
 * Detects the config file we want to load
 */
if (file_exists('./config.inc.developer.php')) {
    $cfgfile_to_load = './config.inc.developer.php';
} else {
    $cfgfile_to_load = './config.inc.php';
}

/**
 * Parses the configuration file and gets some constants used to define
 * versions of phpMyAdmin/php/mysql...
 */
$old_error_reporting = error_reporting(0);
include_once($cfgfile_to_load);
// Include failed
if (!isset($cfgServers) && !isset($cfg['Servers'])) {
    // Creates fake settings
    $cfg = array('DefaultLang'           => 'en-iso-8859-1',
                    'AllowAnywhereRecoding' => FALSE);
    // Loads the language file
    require_once('./libraries/select_lang.lib.php');
    // Sends the Content-Type header
    header('Content-Type: text/html; charset=' . $charset);
    // Displays the error message
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $available_languages[$lang][2]; ?>" lang="<?php echo $available_languages[$lang][2]; ?>" dir="<?php echo $text_dir; ?>">

<head>
<title>phpMyAdmin</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />

<style type="text/css">
<!--
body  {font-family: sans-serif; font-size: small; color: #000000; background-color: #F5F5F5}
h1    {font-family: sans-serif; font-size: large; font-weight: bold}
//-->
</style>
</head>


<body bgcolor="#ffffff">
<h1>phpMyAdmin - <?php echo $strError; ?></h1>
<p>
<?php echo $strConfigFileError; ?><br /><br />
<a href="config.inc.php" target="_blank">config.inc.php</a>
</p>
</body>

</html>
    <?php
    exit();
}
error_reporting($old_error_reporting);
unset($old_error_reporting, $cfgfile_to_load);

/**
 * Includes compatibility code for older config.inc.php revisions
 * if necessary
 */
if (isset($cfg['FileRevision'])) {
    // converting revision string into an array
    //     e.g. "Revision: 2.0" becomes array(2, 0).
    $cfg['FileRevision'] = str_replace('$' . 'Revision: ', '', $cfg['FileRevision']);
    $cfg['FileRevision'] = str_replace(' $', '', $cfg['FileRevision']);
    $cfg['FileRevision'] = explode('.', $cfg['FileRevision']);
} else {
    $cfg['FileRevision'] = array(1, 1);
}
if ($cfg['FileRevision'][0] < 2 || ($cfg['FileRevision'][0] == 2 && $cfg['FileRevision'][1] < 52)) {
    require_once('./libraries/config_import.lib.php');
}

/**
 * Includes the language file if it hasn't been included yet
 */
require_once('./libraries/select_lang.lib.php');
/**
 * Gets constants that defines the PHP version number.
 * This include must be located physically before any code that needs to
 * reference the constants, else PHP 3.0.16 won't be happy.
 */
require_once('./libraries/defines.lib.php');


/**
 * Sanitizes $message, taking into account our special codes
 * for formatting
 *
 * @param   string   the message
 *
 * @return  string   the sanitized message
 *
 * @access  public
 */
function PMA_sanitize($message)
{
    $replace_pairs = array(
        '<'     => '&lt;',
        '>'     => '&gt;',
        '[i]'   => '<i>',
        '[/i]'  => '</i>',
        '[b]'   => '<b>',
        '[br]'  => '<br />',
        '[/b]'  => '</b>',
    );
    return strtr($message, $replace_pairs);
}

// XSS
if (isset($convcharset)) {
    $convcharset = PMA_sanitize($convcharset);
}

if ($is_minimum_common == FALSE) {
    /**
     * Define $is_upload
     */

      $is_upload = TRUE;
      if (strtolower(@ini_get('file_uploads')) == 'off'
             || @ini_get('file_uploads') == 0) {
          $is_upload = FALSE;
      }

    /**
     * Maximum upload size as limited by PHP
     * Used with permission from Moodle (http://moodle.org) by Martin Dougiamas
     *
     * this section generates $max_upload_size in bytes
     */

    function get_real_size($size=0) {
    /// Converts numbers like 10M into bytes
        if (!$size) {
            return 0;
        }
        $scan['MB'] = 1048576;
        $scan['Mb'] = 1048576;
        $scan['M'] = 1048576;
        $scan['m'] = 1048576;
        $scan['KB'] = 1024;
        $scan['Kb'] = 1024;
        $scan['K'] = 1024;
        $scan['k'] = 1024;

        while (list($key) = each($scan)) {
            if ((strlen($size)>strlen($key))&&(substr($size, strlen($size) - strlen($key))==$key)) {
                $size = substr($size, 0, strlen($size) - strlen($key)) * $scan[$key];
                break;
            }
        }
        return $size;
    } // end function


    if (!$filesize = ini_get('upload_max_filesize')) {
        $filesize = "5M";
    }
    $max_upload_size = get_real_size($filesize);

    if ($postsize = ini_get('post_max_size')) {
        $postsize = get_real_size($postsize);
        if ($postsize < $max_upload_size) {
            $max_upload_size = $postsize;
        }
    }
    unset($filesize);
    unset($postsize);

    /**
     * other functions for maximum upload work
     */

    /**
     * Displays the maximum size for an upload
     *
     * @param   integer  the size
     *
     * @return  string   the message
     *
     * @access  public
     */
     function PMA_displayMaximumUploadSize($max_upload_size) {
         list($max_size, $max_unit) = PMA_formatByteDown($max_upload_size);
         return '(' . sprintf($GLOBALS['strMaximumSize'], $max_size, $max_unit) . ')';
     }

    /**
     * Generates a hidden field which should indicate to the browser
     * the maximum size for upload
     *
     * @param   integer  the size
     *
     * @return  string   the INPUT field
     *
     * @access  public
     */
     function PMA_generateHiddenMaxFileSize($max_size){
         return '<input type="hidden" name="MAX_FILE_SIZE" value="' .$max_size . '" />';
     }

    /**
     * Charset conversion.
     */
    require_once('./libraries/charset_conversion.lib.php');

    /**
     * String handling
     */
    require_once('./libraries/string.lib.php');
}

/**
 * Removes insecure parts in a path; used before include() or
 * require() when a part of the path comes from an insecure source
 * like a cookie or form.
 *
 * @param    string  The path to check
 *
 * @return   string  The secured path
 *
 * @access  public
 * @author  Marc Delisle (lem9@users.sourceforge.net)
 */
function PMA_securePath($path) {

    // change .. to .
    $path = preg_replace('@\.\.*@','.',$path);

    return $path;
} // end function

// If zlib output compression is set in the php configuration file, no
// output buffering should be run
if (@ini_get('zlib.output_compression')) {
    $cfg['OBGzip'] = FALSE;
}

// disable output-buffering (if set to 'auto') for IE6, else enable it.
if (strtolower($cfg['OBGzip']) == 'auto') {
    if (PMA_USR_BROWSER_AGENT == 'IE' && PMA_USR_BROWSER_VER >= 6 && PMA_USR_BROWSER_VER < 7) {
        $cfg['OBGzip'] = FALSE;
    } else {
        $cfg['OBGzip'] = TRUE;
    }
}


/* Theme Manager
 * 2004-05-20 Michael Keck (mail_at_michaelkeck_dot_de)
 *            This little script checks if there're themes available
 *            and if the directory $ThemePath/$theme/img/ exists
 *            If not, it will use default images
*/
// Theme Manager
if (!$cfg['ThemeManager'] || !isset($_COOKIE['pma_theme']) || empty($_COOKIE['pma_theme'])){
    $GLOBALS['theme'] = $cfg['ThemeDefault'];
    $ThemeDefaultOk = FALSE;
    if ($cfg['ThemePath']!='' && $cfg['ThemePath'] != FALSE) {
        $tmp_theme_mainpath = $cfg['ThemePath'];
        $tmp_theme_fullpath = $cfg['ThemePath'] . '/' .$cfg['ThemeDefault'];
        if (@is_dir($tmp_theme_mainpath)) {
            if (isset($cfg['ThemeDefault']) && @is_dir($tmp_theme_fullpath)) {
                $ThemeDefaultOk = TRUE;
            }
        }
    }
    if ($ThemeDefaultOk == TRUE){
        $GLOBALS['theme'] = $cfg['ThemeDefault'];
    } else {
        $GLOBALS['theme'] = 'original';
    }
} else {
    // if we just changed theme, we must take the new one so that
    // index.php takes the correct one for height computing
    if (isset($_POST['set_theme'])) {
        $GLOBALS['theme'] = PMA_securePath($_POST['set_theme']);
    } else {
        $GLOBALS['theme'] = PMA_securePath($_COOKIE['pma_theme']);
    }
}

// check for theme requires/name
unset($theme_name, $theme_generation, $theme_version);
@include($cfg['ThemePath'] . '/' . $GLOBALS['theme'] . '/info.inc.php');

// did it set correctly?
if (!isset($theme_name, $theme_generation, $theme_version)) {
    $GLOBALS['theme'] = 'original'; // invalid theme
} elseif ($theme_generation != PMA_THEME_GENERATION) {
    $GLOBALS['theme'] = 'original'; // different generation
} elseif ($theme_version < PMA_THEME_VERSION) {
    $GLOBALS['theme'] = 'original'; // too old version
}

$pmaThemeImage  = $cfg['ThemePath'] . '/' . $GLOBALS['theme'] . '/img/';
$tmp_layout_file = $cfg['ThemePath'] . '/' . $GLOBALS['theme'] . '/layout.inc.php';
if (@file_exists($tmp_layout_file)) {
    include($tmp_layout_file);
}
if (!is_dir($pmaThemeImage)) {
    $pmaThemeImage = $cfg['ThemePath'] . '/original/img/';
}
// end theme manager

/**
 * collation_connection
 */
 // (could be improved by executing it after the MySQL connection only if
 //  PMA_MYSQL_INT_VERSION >= 40100 )
if (isset($_COOKIE) && !empty($_COOKIE['pma_collation_connection']) && empty($_POST['collation_connection'])) {
    $collation_connection = $_COOKIE['pma_collation_connection'];
}


if ($is_minimum_common == FALSE) {
    /**
     * Include URL/hidden inputs generating.
     */
    require_once('./libraries/url_generating.lib.php');

    /**
     * Add slashes before "'" and "\" characters so a value containing them can
     * be used in a sql comparison.
     *
     * @param   string   the string to slash
     * @param   boolean  whether the string will be used in a 'LIKE' clause
     *                   (it then requires two more escaped sequences) or not
     * @param   boolean  whether to treat cr/lfs as escape-worthy entities
     *                   (converts \n to \\n, \r to \\r)
     *
     * @param   boolean  whether this function is used as part of the
     *                   "Create PHP code" dialog 
     *
     * @return  string   the slashed string
     *
     * @access  public
     */
    function PMA_sqlAddslashes($a_string = '', $is_like = FALSE, $crlf = FALSE, $php_code = FALSE)
    {
        if ($is_like) {
            $a_string = str_replace('\\', '\\\\\\\\', $a_string);
        } else {
            $a_string = str_replace('\\', '\\\\', $a_string);
        }

        if ($crlf) {
            $a_string = str_replace("\n", '\n', $a_string);
            $a_string = str_replace("\r", '\r', $a_string);
            $a_string = str_replace("\t", '\t', $a_string);
        }

        if ($php_code) {
            $a_string = str_replace('\'', '\\\'', $a_string); 
        } else {
            $a_string = str_replace('\'', '\'\'', $a_string);
        } 

        return $a_string;
    } // end of the 'PMA_sqlAddslashes()' function


    /**
     * Add slashes before "_" and "%" characters for using them in MySQL
     * database, table and field names.
     * Note: This function does not escape backslashes!
     *
     * @param   string   the string to escape
     *
     * @return  string   the escaped string
     *
     * @access  public
     */
    function PMA_escape_mysql_wildcards($name)
    {
        $name = str_replace('_', '\\_', $name);
        $name = str_replace('%', '\\%', $name);

        return $name;
    } // end of the 'PMA_escape_mysql_wildcards()' function


    /**
     * format sql strings
     *
     * @param   mixed    pre-parsed SQL structure
     *
     * @return  string   the formatted sql
     *
     * @global  array    the configuration array
     * @global  boolean  whether the current statement is a multiple one or not
     *
     * @access  public
     *
     * @author  Robin Johnson <robbat2@users.sourceforge.net>
     */
    function PMA_formatSql($parsed_sql, $unparsed_sql = '')
    {
        global $cfg;

        // Check that we actually have a valid set of parsed data
        // well, not quite
        // first check for the SQL parser having hit an error
        if (PMA_SQP_isError()) {
            return $parsed_sql;
        }
        // then check for an array
        if (!is_array($parsed_sql)) {
            // We don't so just return the input directly
            // This is intended to be used for when the SQL Parser is turned off
            $formatted_sql = '<pre>' . "\n"
                            . (($cfg['SQP']['fmtType'] == 'none' && $unparsed_sql != '') ? $unparsed_sql : $parsed_sql) . "\n"
                            . '</pre>';
            return $formatted_sql;
        }

        $formatted_sql        = '';

        switch ($cfg['SQP']['fmtType']) {
            case 'none':
                if ($unparsed_sql != '') {
                    $formatted_sql = "<pre>\n" . PMA_SQP_formatNone(array('raw' => $unparsed_sql)) . "\n</pre>";
                } else {
                    $formatted_sql = PMA_SQP_formatNone($parsed_sql);
                }
                break;
            case 'html':
                $formatted_sql = PMA_SQP_formatHtml($parsed_sql,'color');
                break;
            case 'text':
                //$formatted_sql = PMA_SQP_formatText($parsed_sql);
                $formatted_sql = PMA_SQP_formatHtml($parsed_sql,'text');
                break;
            default:
                break;
        } // end switch

        return $formatted_sql;
    } // end of the "PMA_formatSql()" function


    /**
     * Displays a link to the official MySQL documentation
     *
     * @param   chapter of "HTML, one page per chapter" documentation
     * @param   contains name of page/anchor that is being linked
     *
     * @return  string  the html link
     *
     * @access  public
     */
// 2004-05-04: replaced with a modified function from Michael Keck (mkkeck)
        function PMA_showMySQLDocu($chapter, $link)
        {

            if (!empty($GLOBALS['cfg']['MySQLManualBase'])) {
                if (!empty($GLOBALS['cfg']['MySQLManualType'])) {
                    switch ($GLOBALS['cfg']['MySQLManualType']) {
                        case 'old':
                            if ($GLOBALS['cfg']['ReplaceHelpImg']) {
                                return '<a href="' . $GLOBALS['cfg']['MySQLManualBase'] . '/' . $link[0] . '/' . $link[1] . '/' . $link . '.html" target="mysql_doc"><img src="' . $GLOBALS['pmaThemeImage'] . 'b_help.png" width="11" height="11" border="0" alt="' . $GLOBALS['strDocu'] . '" title="' . $GLOBALS['strDocu'] . '" hspace="2" align="middle" /></a>';
                            }else{
                                return '[<a href="' . $GLOBALS['cfg']['MySQLManualBase'] . '/' . $link[0] . '/' . $link[1] . '/' . $link . '.html" target="mysql_doc">' . $GLOBALS['strDocu'] . '</a>]';
                           }
                        case 'chapters':
                            if ($GLOBALS['cfg']['ReplaceHelpImg']) {
                                return '<a href="' . $GLOBALS['cfg']['MySQLManualBase'] . '/manual_' . $chapter . '.html#' . $link . '" target="mysql_doc"><img src="' . $GLOBALS['pmaThemeImage'] . 'b_help.png" width="11" height="11" border="0" alt="' . $GLOBALS['strDocu'] . '" title="' . $GLOBALS['strDocu'] . '" hspace="2" align="middle" /></a>';
                           } else {
                               return '[<a href="' . $GLOBALS['cfg']['MySQLManualBase'] . '/manual_' . $chapter . '.html#' . $link . '" target="mysql_doc">' . $GLOBALS['strDocu'] . '</a>]'; }
                        case 'big':
                            if ($GLOBALS['cfg']['ReplaceHelpImg']) {
                                return '<a href="' . $GLOBALS['cfg']['MySQLManualBase'] . '#' . $link . '" target="mysql_doc"><img src="' . $GLOBALS['pmaThemeImage'] . 'b_help.png" width="11" height="11" border="0" alt="' . $GLOBALS['strDocu'] . '" title="' . $GLOBALS['strDocu'] . '" hspace="2" align="middle" /></a>';
                            } else {
                                return '[<a href="' . $GLOBALS['cfg']['MySQLManualBase'] . '#' . $link . '" target="mysql_doc">' . $GLOBALS['strDocu'] . '</a>]';
                            }
                        case 'none':
                            return '';
                        case 'searchable':
                        default:
                            if ($GLOBALS['cfg']['ReplaceHelpImg']) {
                                return '<a href="' . $GLOBALS['cfg']['MySQLManualBase'] . '/' . $link . '.html" target="mysql_doc"><img src="' . $GLOBALS['pmaThemeImage'] . 'b_help.png" width="11" height="11" border="0" alt="' . $GLOBALS['strDocu'] . '" title="' . $GLOBALS['strDocu'] . '" hspace="2" align="middle" /></a>';
                            } else {
                                return '[<a href="' . $GLOBALS['cfg']['MySQLManualBase'] . '/' . $link . '.html" target="mysql_doc">' . $GLOBALS['strDocu'] . '</a>]';
                            }
                    }
                } else {
                    // no Type defined, show the old one
                    if ($GLOBALS['cfg']['ReplaceHelpImg']) {
                        return '<a href="' . $GLOBALS['cfg']['MySQLManualBase'] . '/' . $link[0] . '/' . $link[1] . '/' . $link . '.html" target="mysql_doc"><img src="' . $GLOBALS['pmaThemeImage'] . 'b_help.png" width="11" height="11" border="0" alt="' . $GLOBALS['strDocu'] . '" title="' . $GLOBALS['strDocu'] . '" hspace="2" align="middle" /></a>';
                    } else {
                        return '[<a href="' . $GLOBALS['cfg']['MySQLManualBase'] . '/' . $link[0] . '/' . $link[1] . '/' . $link . '.html" target="mysql_doc">' . $GLOBALS['strDocu'] . '</a>]';
                    }
                }
            } else {
                // no URL defined
                if (!empty($GLOBALS['cfg']['ManualBaseShort'])) {
                    // the old configuration
                    if ($GLOBALS['cfg']['ReplaceHelpImg']) {
                        return '<a href="' . $GLOBALS['cfg']['MySQLManualBase'] . '/' . $link[0] . '/' . $link[1] . '/' . $link . '.html" target="mysql_doc"><img src="' . $GLOBALS['pmaThemeImage'] . 'b_help.png" width="11" height="11" border="0" alt="' . $GLOBALS['strDocu'] . '" title="' . $GLOBALS['strDocu'] . '" hspace="2" align="middle" /></a>';
                    } else {
                        return '[<a href="' . $GLOBALS['cfg']['MySQLManualBase'] . '/' . $link[0] . '/' . $link[1] . '/' . $link . '.html" target="mysql_doc">' . $GLOBALS['strDocu'] . '</a>]';
                   }
                } else {
                    return '';
                }
            }
        }
                 // end of the 'PMA_showDocu()' function

    /**
     * Displays a hint icon, on mouse over show the hint
     *
     * @param   string   the error message
     *
     * @access  public
     */
     function PMA_showHint($hint_message)
     {
         //return '<img class="lightbulb" src="' . $GLOBALS['pmaThemeImage'] . 'b_tipp.png" width="16" height="16" border="0" alt="' . $hint_message . '" title="' . $hint_message . '" align="middle" onclick="alert(\'' . PMA_jsFormat($hint_message, FALSE) . '\');" />';
         return '<img class="lightbulb" src="' . $GLOBALS['pmaThemeImage'] . 'b_tipp.png" width="16" height="16" border="0" alt="Tip" title="Tip" align="middle" onmouseover="pmaTooltip(\'' .  PMA_jsFormat($hint_message, FALSE) . '\'); return false;" onmouseout="swapTooltip(\'default\'); return false;" />';
     }

    /**
     * Displays a MySQL error message in the right frame.
     *
     * @param   string   the error message
     * @param   string   the sql query that failed
     * @param   boolean  whether to show a "modify" link or not
     * @param   string   the "back" link url (full path is not required)
     * @param   boolean  EXIT the page?
     *
     * @global  array    the configuration array
     *
     * @access  public
     */
    function PMA_mysqlDie($error_message = '', $the_query = '',
                            $is_modify_link = TRUE, $back_url = '',
                            $exit = TRUE)
    {
        global $cfg, $table, $db, $sql_query;

        require_once('./header.inc.php');

        if (!$error_message) {
            $error_message = PMA_DBI_getError();
        }
        if (!$the_query && !empty($GLOBALS['sql_query'])) {
            $the_query = $GLOBALS['sql_query'];
        }

        // --- Added to solve bug #641765
        // Robbat2 - 12 January 2003, 9:46PM
        // Revised, Robbat2 - 13 Janurary 2003, 2:59PM
        if (!function_exists('PMA_SQP_isError') || PMA_SQP_isError()) {
            $formatted_sql = htmlspecialchars($the_query);
        } else {
            $formatted_sql = PMA_formatSql(PMA_SQP_parse($the_query), $the_query);
        }
        // ---
        echo "\n" . '<!-- PMA-SQL-ERROR -->' . "\n";
        echo '    <table border="0" cellpadding="2" cellspacing="1">'
           . '        <tr>' . "\n"
           . '            <th class="tblHeadError"><div class="errorhead">' . $GLOBALS['strError'] . '</div></th>' . "\n"
           . '        </tr>' . "\n"
           . '        <tr>' . "\n"
           . '            <td>';
        // if the config password is wrong, or the MySQL server does not
        // respond, do not show the query that would reveal the
        // username/password
        if (!empty($the_query) && !strstr($the_query, 'connect')) {
            // --- Added to solve bug #641765
            // Robbat2 - 12 January 2003, 9:46PM
            // Revised, Robbat2 - 13 Janurary 2003, 2:59PM
            if (function_exists('PMA_SQP_isError') && PMA_SQP_isError()) {
                echo PMA_SQP_getErrorString();
            }
            // ---
            // modified to show me the help on sql errors (Michael Keck)
            echo '<div class="tblWarn"><p>' . "\n";
            echo '    <b>' . $GLOBALS['strSQLQuery'] . ':</b>' . "\n";
            if (strstr(strtolower($formatted_sql),'select')) { // please show me help to the error on select
                echo PMA_showMySQLDocu('Reference', 'SELECT');
            }
            if ($is_modify_link && isset($db)) {
                if (isset($table)) {
                    $doedit_goto = '<a href="tbl_properties.php?' . PMA_generate_common_url($db, $table) . '&amp;sql_query=' . urlencode($the_query) . '&amp;show_query=1">';
                } else {
                    $doedit_goto = '<a href="db_details.php?' . PMA_generate_common_url($db) . '&amp;sql_query=' . urlencode($the_query) . '&amp;show_query=1">';
                }
                if ($GLOBALS['cfg']['PropertiesIconic']) {
                    echo $doedit_goto
                       . '<img src=" '. $GLOBALS['pmaThemeImage'] . 'b_edit.png" width="16" height="16" border="0" hspace="2" align="middle" alt="' . $GLOBALS['strEdit'] .'" />'
                       . '</a>';
                } else {
                    echo '    ['
                       . $doedit_goto . $GLOBALS['strEdit'] . '</a>'
                       . ']' . "\n";
                }
            } // end if
            echo '</p>' . "\n"
                    . '<p>' . "\n"
                    . '    ' . $formatted_sql . "\n"
                    . '</p></div>' . "\n";
        } // end if

        $tmp_mysql_error = ''; // for saving the original $error_message
        if (!empty($error_message)) {
            $tmp_mysql_error = strtolower($error_message); // save the original $error_message
            $error_message = htmlspecialchars($error_message);
            $error_message = preg_replace("@((\015\012)|(\015)|(\012)){3,}@", "\n\n", $error_message);
        }
        // modified to show me the help on error-returns (Michael Keck)
        echo '<div class="tblWarn"><p>' . "\n"
                . '    <b>' . $GLOBALS['strMySQLSaid'] . '</b>'
                . PMA_showMySQLDocu('Error-returns', 'Error-returns')
                . "\n"
                . '</p>' . "\n";

        // The error message will be displayed within a CODE segment.
        // To preserve original formatting, but allow wordwrapping, we do a couple of replacements

        // Replace all non-single blanks with their HTML-counterpart
        $error_message = str_replace('  ', '&nbsp;&nbsp;', $error_message);
        // Replace TAB-characters with their HTML-counterpart
        $error_message = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;', $error_message);
        // Replace linebreaks
        $error_message = nl2br($error_message);

        echo '<code>' . "\n"
            . $error_message . "\n"
            . '</code><br />' . "\n";

        // feature request #1036254:
        // Add a link by MySQL-Error #1062 - Duplicate entry
        // 2004-10-20 by mkkeck
        // 2005-01-17 modified by mkkeck bugfix
        if (substr($error_message, 1, 4) == '1062') {
            // get the duplicate entry
            $mysql_error_values = array();
            $mysql_error_words  = explode(' ',$tmp_mysql_error);
            foreach ($mysql_error_words as $mysql_error_word) {
                if (strstr($mysql_error_word, "'")) {
                   $mysql_error_values = explode('-', preg_replace("/'/", "", $mysql_error_word));
                   break; // exit 'foreach'
                }
            }
            $duplicate_sql_query = '';
            if (isset($mysql_error_values[0])) {
                $tmp_fields = PMA_DBI_get_fields($db, $table, NULL);
                foreach ($tmp_fields as $tmp_field) {
                    $duplicate_sql_query .= (($duplicate_sql_query!='') ? ' OR ' : '') . PMA_backquote($tmp_field['Field']) . " LIKE '" . $mysql_error_values[0] . "'";
                }
            }
            if ($duplicate_sql_query!='') {
                $duplicate_sql_query = "SELECT * FROM " . PMA_backquote($table) . " WHERE (" . $duplicate_sql_query . ")";
            } else {
                $duplicate_sql_query = "SELECT * FROM " . PMA_backquote($table) . "";
            }
            echo '        <form method="post" action="read_dump.php" style="padding: 0px; margin: 0px">' ."\n"
                    . '            <input type="hidden" name="sql_query" value="' . $duplicate_sql_query . '" />' . "\n"
                    . '            ' . PMA_generate_common_hidden_inputs($db, $table) . "\n"
                    . '            <input type="submit" name="submit" value="' . $GLOBALS['strBrowse'] . '" />' . "\n"
                    . '        </form>' . "\n";
        } // end of show duplicate entry

        echo '</div>';

        if (!empty($back_url) && $exit) {
            $goto_back_url='<a href="' . (strstr($back_url, '?') ? $back_url . '&amp;no_history=true' : $back_url . '?no_history=true') . '">&nbsp;';
            echo '            </td> ' . "\n"
               . '        </tr>' . "\n"
               . '        <tr><td class="tblHeaders" align="center">';
            echo '[' . $goto_back_url . $GLOBALS['strBack'] . '&nbsp;</a>]';
        }
        echo '            </td>' . "\n"
           . '        </tr>' . "\n"
           . '    </table>' . "\n\n";
        if ($exit) {
            require_once('./footer.inc.php');
        }
    } // end of the 'PMA_mysqlDie()' function


    /**
     * Defines whether a string exists inside an array or not
     *
     * @param   string   string to search for
     * @param   mixed    array to search into
     *
     * @return  integer  the rank of the $toFind string in the array or '-1' if
     *                   it hasn't been found
     *
     * @access  public
     */
    function PMA_isInto($toFind = '', &$in)
    {
        $max = count($in);
        for ($i = 0; $i < $max && ($toFind != $in[$i]); $i++) {
            // void();
        }

        return ($i < $max) ? $i : -1;
    }  // end of the 'PMA_isInto()' function


    /**
     * Returns a string formatted with CONVERT ... USING
     * if MySQL supports it
     *
     * @param   string  the string itself
     * @param   string  the mode: quoted or unquoted (this one by default)
     *
     * @return  the formatted string
     *
     * @access  private
     */
    function PMA_convert_using($string, $mode='unquoted') {

        if ($mode == 'quoted') {
            $possible_quote = "'";
        } else {
            $possible_quote = "";
        }

        if (PMA_MYSQL_INT_VERSION >= 40100) {
            list($conn_charset) = explode('_', $GLOBALS['collation_connection']);
            $converted_string = "CONVERT(" . $possible_quote . $string . $possible_quote . " USING " . $conn_charset . ")";
        } else {
            $converted_string = $possible_quote . $string . $possible_quote;
        }
        return $converted_string;
    } // end function

}

/**
 * Get the complete list of Databases a user can access
 *
 * @param   boolean   whether to include check on failed 'only_db' operations
 * @param   resource  database handle (superuser)
 * @param   integer   amount of databases inside the 'only_db' container
 * @param   resource  possible resource from a failed previous query
 * @param   resource  database handle (user)
 * @param   array     configuration
 * @param   array     previous list of databases
 *
 * @return  array     all databases a user has access to
 *
 * @access  private
 */
function PMA_safe_db_list($only_db_check, $dbh, $dblist_cnt, $rs, $userlink, $cfg, $dblist) {
    if ($only_db_check == FALSE) {
        // try to get the available dbs list
        // use userlink by default
        $dblist = PMA_DBI_get_dblist();
        $dblist_cnt   = count($dblist);

        // did not work so check for available databases in the "mysql" db;
        // I don't think we can fall here now...
        if (!$dblist_cnt) {
            $auth_query   = 'SELECT User, Select_priv '
                          . 'FROM mysql.user '
                          . 'WHERE User = \'' . PMA_sqlAddslashes($cfg['Server']['user']) . '\'';
            $rs           = PMA_DBI_try_query($auth_query, $dbh);
        } // end
    }

    // Access to "mysql" db allowed and dblist still empty -> gets the
    // usable db list
    if (!$dblist_cnt
        && ($rs && @PMA_DBI_num_rows($rs))) {
        $row = PMA_DBI_fetch_assoc($rs);
        PMA_DBI_free_result($rs);
        // Correction uva 19991215
        // Previous code assumed database "mysql" admin table "db" column
        // "db" contains literal name of user database, and works if so.
        // Mysql usage generally (and uva usage specifically) allows this
        // column to contain regular expressions (we have all databases
        // owned by a given student/faculty/staff beginning with user i.d.
        // and governed by default by a single set of privileges with
        // regular expression as key). This breaks previous code.
        // This maintenance is to fix code to work correctly for regular
        // expressions.
        if ($row['Select_priv'] != 'Y') {

            // 1. get allowed dbs from the "mysql.db" table
            // lem9: User can be blank (anonymous user)
            $local_query = 'SELECT DISTINCT Db FROM mysql.db WHERE Select_priv = \'Y\' AND (User = \'' . PMA_sqlAddslashes($cfg['Server']['user']) . '\' OR User = \'\')';
            $rs          = PMA_DBI_try_query($local_query, $dbh);
            if ($rs && @PMA_DBI_num_rows($rs)) {
                // Will use as associative array of the following 2 code
                // lines:
                //   the 1st is the only line intact from before
                //     correction,
                //   the 2nd replaces $dblist[] = $row['Db'];
                $uva_mydbs = array();
                // Code following those 2 lines in correction continues
                // populating $dblist[], as previous code did. But it is
                // now populated with actual database names instead of
                // with regular expressions.
                while ($row = PMA_DBI_fetch_assoc($rs)) {
                    // loic1: all databases cases - part 1
                    if (empty($row['Db']) || $row['Db'] == '%') {
                        $uva_mydbs['%'] = 1;
                        break;
                    }
                    // loic1: avoid multiple entries for dbs
                    if (!isset($uva_mydbs[$row['Db']])) {
                        $uva_mydbs[$row['Db']] = 1;
                    }
                } // end while
                PMA_DBI_free_result($rs);
                $uva_alldbs = PMA_DBI_query('SHOW DATABASES;', $GLOBALS['dbh']);
                // loic1: all databases cases - part 2
                if (isset($uva_mydbs['%'])) {
                    while ($uva_row = PMA_DBI_fetch_row($uva_alldbs)) {
                        $dblist[] = $uva_row[0];
                    } // end while
                } // end if
                else {
                    while ($uva_row = PMA_DBI_fetch_row($uva_alldbs)) {
                        $uva_db = $uva_row[0];
                        if (isset($uva_mydbs[$uva_db]) && $uva_mydbs[$uva_db] == 1) {
                            $dblist[]           = $uva_db;
                            $uva_mydbs[$uva_db] = 0;
                        } else if (!isset($dblist[$uva_db])) {
                            foreach ($uva_mydbs AS $uva_matchpattern => $uva_value) {
                                // loic1: fixed bad regexp
                                // TODO: db names may contain characters
                                //       that are regexp instructions
                                $re        = '(^|(\\\\\\\\)+|[^\])';
                                $uva_regex = ereg_replace($re . '%', '\\1.*', ereg_replace($re . '_', '\\1.{1}', $uva_matchpattern));
                                // Fixed db name matching
                                // 2000-08-28 -- Benjamin Gandon
                                if (ereg('^' . $uva_regex . '$', $uva_db)) {
                                    $dblist[] = $uva_db;
                                    break;
                                }
                            } // end while
                        } // end if ... else if....
                    } // end while
                } // end else
                PMA_DBI_free_result($uva_alldbs);
                unset($uva_mydbs);
            } // end if

            // 2. get allowed dbs from the "mysql.tables_priv" table
            $local_query = 'SELECT DISTINCT Db FROM mysql.tables_priv WHERE Table_priv LIKE \'%Select%\' AND User = \'' . PMA_sqlAddslashes($cfg['Server']['user']) . '\'';
            $rs          = PMA_DBI_try_query($local_query, $dbh);
            if ($rs && @PMA_DBI_num_rows($rs)) {
                while ($row = PMA_DBI_fetch_assoc($rs)) {
                    if (PMA_isInto($row['Db'], $dblist) == -1) {
                        $dblist[] = $row['Db'];
                    }
                } // end while
                PMA_DBI_free_result($rs);
            } // end if
        } // end if
    } // end building available dbs from the "mysql" db

    return $dblist;
}

/**
 * Determines the font sizes to use depending on the os and browser of the
 * user.
 *
 * This function is based on an article from phpBuilder (see
 * http://www.phpbuilder.net/columns/tim20000821.php).
 *
 * @return  boolean    always true
 *
 * @global  string     the standard font size
 * @global  string     the font size for titles
 * @global  string     the small font size
 * @global  string     the smallest font size
 *
 * @access  public
 *
 * @version 1.1
 */
function PMA_setFontSizes()
{
    global $font_size, $font_biggest, $font_bigger, $font_smaller, $font_smallest;

    // IE (<7)/Opera (<7) for win case: needs smaller fonts than anyone else
    if (PMA_USR_OS == 'Win'
        && ((PMA_USR_BROWSER_AGENT == 'IE' && PMA_USR_BROWSER_VER < 7)
        || (PMA_USR_BROWSER_AGENT == 'OPERA' && PMA_USR_BROWSER_VER < 7))) {
        $font_size     = 'x-small';
        $font_biggest  = 'large';
        $font_bigger   = 'medium';
        $font_smaller  = '90%';
        $font_smallest = '7pt';
    }
    // IE6 and other browsers for win case
    else if (PMA_USR_OS == 'Win') {
        $font_size     = 'small';
        $font_biggest  = 'large';
        $font_bigger   = 'medium';
        $font_smaller  = (PMA_USR_BROWSER_AGENT == 'IE')
                        ? '90%'
                        : 'x-small';
        $font_smallest = 'x-small';
    }
    // Some mac browsers need also smaller default fonts size (OmniWeb &
    // Opera)...
    // and a beta version of Safari did also, but not the final 1.0 version
    // so I remove   || PMA_USR_BROWSER_AGENT == 'SAFARI'
    // but we got a report that Safari 1.0 build 85.5 needs it!

    else if (PMA_USR_OS == 'Mac'
                && (PMA_USR_BROWSER_AGENT == 'OMNIWEB' || PMA_USR_BROWSER_AGENT == 'OPERA' || PMA_USR_BROWSER_AGENT == 'SAFARI')) {
        $font_size     = 'x-small';
        $font_biggest  = 'large';
        $font_bigger   = 'medium';
        $font_smaller  = '90%';
        $font_smallest = '7pt';
    }
    // ... but most of them (except IE 5+ & NS 6+) need bigger fonts
    else if ((PMA_USR_OS == 'Mac'
                && ((PMA_USR_BROWSER_AGENT != 'IE' && PMA_USR_BROWSER_AGENT != 'MOZILLA')
                    || PMA_USR_BROWSER_VER < 5))
            || PMA_USR_BROWSER_AGENT == 'KONQUEROR') {
        $font_size     = 'medium';
        $font_biggest  = 'x-large';
        $font_bigger   = 'large';
        $font_smaller  = 'small';
        $font_smallest = 'x-small';
    }
    // OS/2 browser
    else if (PMA_USR_OS == 'OS/2'
                && PMA_USR_BROWSER_AGENT == 'OPERA') {
        $font_size     = 'small';
        $font_biggest  = 'medium';
        $font_bigger   = 'medium';
        $font_smaller  = 'x-small';
        $font_smallest = 'x-small';
    }
    else {
        $font_size     = 'small';
        $font_biggest  = 'large';
        $font_bigger   = 'medium';
        $font_smaller  = 'x-small';
        $font_smallest = 'x-small';
    }

    return TRUE;
} // end of the 'PMA_setFontSizes()' function


if ($is_minimum_common == FALSE) {
    /**
     * $cfg['PmaAbsoluteUri'] is a required directive else cookies won't be
     * set properly and, depending on browsers, inserting or updating a
     * record might fail
     */
    $display_pmaAbsoluteUri_warning = 0;

    // Setup a default value to let the people and lazy syadmins work anyway,
    // but display a big warning on the main.php page.
    if (empty($cfg['PmaAbsoluteUri'])) {

        $url = array();

        // At first we try to parse REQUEST_URI, it might contain full URI
        if (!empty($_SERVER['REQUEST_URI'])) {
            $url = parse_url($_SERVER['REQUEST_URI']);
        }

        // If we don't have scheme, we didn't have full URL so we need to dig deeper
        if (empty($url['scheme'])) {
            // Scheme
            if (!empty($_SERVER['HTTP_SCHEME'])) {
                $url['scheme'] = $_SERVER['HTTP_SCHEME'];
            } else {
                $url['scheme'] = (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http';
            }

            // Host and port
            if (!empty($_SERVER['HTTP_HOST'])) {
                if (strpos($_SERVER['HTTP_HOST'], ':') > 0) {
                    list($url['host'], $url['port']) = explode(':', $_SERVER['HTTP_HOST']);
                } else {
                    $url['host'] = $_SERVER['HTTP_HOST'];
                }
            } else if (!empty($_SERVER['SERVER_NAME'])) {
                $url['host'] = $_SERVER['SERVER_NAME'];
            } else {
                header('Content-Type: text/html; charset=' . $charset);
                // Displays the error message
                ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $available_languages[$lang][2]; ?>" lang="<?php echo $available_languages[$lang][2]; ?>" dir="<?php echo $text_dir; ?>">

<head>
<title>phpMyAdmin</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>" />

<style type="text/css">
<!--
body  {font-family: sans-serif; font-size: small; color: #000000; background-color: #F5F5F5}
h1    {font-family: sans-serif; font-size: large; font-weight: bold}
//-->
</style>
</head>


<body bgcolor="#ffffff">
<h1>phpMyAdmin - <?php echo $strError; ?></h1>
<p>
<?php echo $strPmaUriError; ?><br /><br />
</p>
</body>

</html>
                <?php
                exit();
            }

            // If we didn't set port yet...
            if (empty($url['port']) && !empty($_SERVER['SERVER_PORT'])) {
                $url['port'] = $_SERVER['SERVER_PORT'];
            }

            // And finally the path could be already set from REQUEST_URI
            if (empty($url['path'])) {
                if (!empty($_SERVER['PATH_INFO'])) {
                    $path = parse_url($_SERVER['PATH_INFO']);
                } else {
                    // PHP_SELF in CGI often points to cgi executable, so use it as last choice
                    $path = parse_url($_SERVER['PHP_SELF']);
                }
                $url['path'] = $path['path'];
                unset($path);
            }
        }

        // Make url from parts we have
        $cfg['PmaAbsoluteUri'] = $url['scheme'] . '://';
        // Was there user information?
        if (!empty($url['user'])) {
            $cfg['PmaAbsoluteUri'] .= $url['user'];
            if (!empty($url['pass'])) {
                $cfg['PmaAbsoluteUri'] .= ':' . $url['pass'];
            }
            $cfg['PmaAbsoluteUri'] .= '@';
        }
        // Add hostname
        $cfg['PmaAbsoluteUri'] .= $url['host'];
        // Add port, if it not the default one
        if (!empty($url['port']) && (($url['scheme'] == 'http' && $url['port'] != 80) || ($url['scheme'] == 'https' && $url['port'] != 443))) {
            $cfg['PmaAbsoluteUri'] .= ':' . $url['port'];
        }
        // And finally path, without script name
        $cfg['PmaAbsoluteUri'] .= substr($url['path'], 0, strrpos($url['path'], '/') + 1);

        unset($url);

        // We display the warning by default, but not if it is disabled thru
        // via the $cfg['PmaAbsoluteUri_DisableWarning'] variable.
        // This is intended for sysadmins that actually want the default
        // behaviour of auto-detection due to their setup.
        // See the mailing list message:
        // http://sourceforge.net/mailarchive/forum.php?thread_id=859093&forum_id=2141
        if ($cfg['PmaAbsoluteUri_DisableWarning'] == FALSE) {
            $display_pmaAbsoluteUri_warning = 1;
        }
    } else {
        // The URI is specified, however users do often specify this
        // wrongly, so we try to fix this.

        // Adds a trailing slash et the end of the phpMyAdmin uri if it
        // does not exist.
        if (substr($cfg['PmaAbsoluteUri'], -1) != '/') {
            $cfg['PmaAbsoluteUri'] .= '/';
        }

        // If URI doesn't start with http:// or https://, we will add
        // this.
        if (substr($cfg['PmaAbsoluteUri'], 0, 7) != 'http://' && substr($cfg['PmaAbsoluteUri'], 0, 8) != 'https://') {
            $cfg['PmaAbsoluteUri']          = ((!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http') . ':'
                                            . (substr($cfg['PmaAbsoluteUri'], 0, 2) == '//' ? '' : '//')
                                            . $cfg['PmaAbsoluteUri'];
        }
    }

    // some variables used mostly for cookies:
    $pma_uri_parts = parse_url($cfg['PmaAbsoluteUri']);
    $cookie_path   = substr($pma_uri_parts['path'], 0, strrpos($pma_uri_parts['path'], '/')) . '/';
    $is_https      = (isset($pma_uri_parts['scheme']) && $pma_uri_parts['scheme'] == 'https') ? 1 : 0;

    $dblist       = array();

    /**
     * Gets the valid servers list and parameters
     */
    foreach ($cfg['Servers'] AS $key => $val) {
        // Don't use servers with no hostname
        if ( ($val['connect_type'] == 'tcp') && empty($val['host'])) {
            unset($cfg['Servers'][$key]);
        }

        // Final solution to bug #582890
        // If we are using a socket connection
        // and there is nothing in the verbose server name
        // or the host field, then generate a name for the server
        // in the form of "Server 2", localized of course!
        if ( ($val['connect_type'] == 'socket') && empty($val['host']) && empty($val['verbose']) ) {
            $cfg['Servers'][$key]['verbose'] = $GLOBALS['strServer'] . $key;
            $val['verbose']                  = $GLOBALS['strServer'] . $key;
        }
    }

    if (empty($server) || !isset($cfg['Servers'][$server]) || !is_array($cfg['Servers'][$server])) {
        $server = $cfg['ServerDefault'];
    }


    /**
     * If no server is selected, make sure that $cfg['Server'] is empty (so
     * that nothing will work), and skip server authentication.
     * We do NOT exit here, but continue on without logging into any server.
     * This way, the welcome page will still come up (with no server info) and
     * present a choice of servers in the case that there are multiple servers
     * and '$cfg['ServerDefault'] = 0' is set.
     */
    if ($server == 0) {
        $cfg['Server'] = array();
    }

    /**
     * Otherwise, set up $cfg['Server'] and do the usual login stuff.
     */
    else if (isset($cfg['Servers'][$server])) {
        $cfg['Server'] = $cfg['Servers'][$server];

        /**
         * Loads the proper database interface for this server
         */
        require_once('./libraries/database_interface.lib.php');

        // Gets the authentication library that fits the $cfg['Server'] settings
        // and run authentication

        // (for a quick check of path disclosure in auth/cookies:)
        $coming_from_common = TRUE;

        require_once('./libraries/auth/' . $cfg['Server']['auth_type'] . '.auth.lib.php');
        if (!PMA_auth_check()) {
            PMA_auth();
        } else {
            PMA_auth_set_user();
        }

        // Check IP-based Allow/Deny rules as soon as possible to reject the
        // user
        // Based on mod_access in Apache:
        // http://cvs.apache.org/viewcvs.cgi/httpd-2.0/modules/aaa/mod_access.c?rev=1.37&content-type=text/vnd.viewcvs-markup
        // Look at: "static int check_dir_access(request_rec *r)"
        // Robbat2 - May 10, 2002
        if (isset($cfg['Server']['AllowDeny']) && isset($cfg['Server']['AllowDeny']['order'])) {
            require_once('./libraries/ip_allow_deny.lib.php');

            $allowDeny_forbidden         = FALSE; // default
            if ($cfg['Server']['AllowDeny']['order'] == 'allow,deny') {
                $allowDeny_forbidden     = TRUE;
                if (PMA_allowDeny('allow')) {
                    $allowDeny_forbidden = FALSE;
                }
                if (PMA_allowDeny('deny')) {
                    $allowDeny_forbidden = TRUE;
                }
            } else if ($cfg['Server']['AllowDeny']['order'] == 'deny,allow') {
                if (PMA_allowDeny('deny')) {
                    $allowDeny_forbidden = TRUE;
                }
                if (PMA_allowDeny('allow')) {
                    $allowDeny_forbidden = FALSE;
                }
            } else if ($cfg['Server']['AllowDeny']['order'] == 'explicit') {
                if (PMA_allowDeny('allow')
                    && !PMA_allowDeny('deny')) {
                    $allowDeny_forbidden = FALSE;
                } else {
                    $allowDeny_forbidden = TRUE;
                }
            } // end if... else if... else if

            // Ejects the user if banished
            if ($allowDeny_forbidden) {
               PMA_auth_fails();
            }
            unset($allowDeny_forbidden); //Clean up after you!
        } // end if

        // is root allowed?
        if (!$cfg['Server']['AllowRoot'] && $cfg['Server']['user'] == 'root') {
            $allowDeny_forbidden = TRUE;
            PMA_auth_fails();
            unset($allowDeny_forbidden); //Clean up after you!
        }

        // The user can work with only some databases
        if (isset($cfg['Server']['only_db']) && $cfg['Server']['only_db'] != '') {
            if (is_array($cfg['Server']['only_db'])) {
                $dblist   = $cfg['Server']['only_db'];
            } else {
                $dblist[] = $cfg['Server']['only_db'];
            }
        } // end if

        $bkp_track_err = @ini_set('track_errors', 1);

        // Try to connect MySQL with the control user profile (will be used to
        // get the privileges list for the current user but the true user link
        // must be open after this one so it would be default one for all the
        // scripts)
        if ($cfg['Server']['controluser'] != '') {
            $dbh = PMA_DBI_connect($cfg['Server']['controluser'], $cfg['Server']['controlpass'], TRUE);
        } else {
            $dbh = PMA_DBI_connect($cfg['Server']['user'], $cfg['Server']['password'], TRUE);
        } // end if ... else

        // Pass #1 of DB-Config to read in master level DB-Config will go here
        // Robbat2 - May 11, 2002

        // Connects to the server (validates user's login)
        $userlink = PMA_DBI_connect($cfg['Server']['user'], $cfg['Server']['password'], FALSE);

        // Pass #2 of DB-Config to read in user level DB-Config will go here
        // Robbat2 - May 11, 2002

        @ini_set('track_errors', $bkp_track_err);
        unset($bkp_track_err);

        /**
         * SQL Parser code
         */
        require_once('./libraries/sqlparser.lib.php');

        /**
         * SQL Validator interface code
         */
        require_once('./libraries/sqlvalidator.lib.php');

        // if 'only_db' is set for the current user, there is no need to check for
        // available databases in the "mysql" db
        $dblist_cnt = count($dblist);
        if ($dblist_cnt) {
            $true_dblist  = array();
            $is_show_dbs  = TRUE;

            $dblist_asterisk_bool = FALSE;
            for ($i = 0; $i < $dblist_cnt; $i++) {

                // The current position
                if ($dblist[$i] == '*' && $dblist_asterisk_bool == FALSE) {
                    $dblist_asterisk_bool = TRUE;
                    $dblist_full = PMA_safe_db_list(FALSE, $dbh, FALSE, $rs, $userlink, $cfg, $dblist);
                    foreach ($dblist_full AS $dbl_key => $dbl_val) {
                        if (!in_array($dbl_val, $dblist)) {
                            $true_dblist[] = $dbl_val;
                        }
                    }

                    continue;
                } elseif ($dblist[$i] == '*') {
                    // We don't want more than one asterisk inside our 'only_db'.
                    continue;
                }
                if ($is_show_dbs && ereg('(^|[^\])(_|%)', $dblist[$i])) {
                    $local_query = 'SHOW DATABASES LIKE \'' . $dblist[$i] . '\'';
                    // here, a PMA_DBI_query() could fail silently
                    // if SHOW DATABASES is disabled
                    $rs          = PMA_DBI_try_query($local_query, $dbh);

                    if ($i == 0
                        && (substr(PMA_DBI_getError($dbh), 1, 4) == 1045)) {
                        // "SHOW DATABASES" statement is disabled
                        $true_dblist[] = str_replace('\\_', '_', str_replace('\\%', '%', $dblist[$i]));
                        $is_show_dbs   = FALSE;
                    }
                    // Debug
                    // else if (PMA_DBI_getError($dbh)) {
                    //    PMA_mysqlDie(PMA_DBI_getError($dbh), $local_query, FALSE);
                    // }
                    while ($row = @PMA_DBI_fetch_row($rs)) {
                        $true_dblist[] = $row[0];
                    } // end while
                    if ($rs) {
                        PMA_DBI_free_result($rs);
                    }
                } else {
                    $true_dblist[]     = str_replace('\\_', '_', str_replace('\\%', '%', $dblist[$i]));
                } // end if... else...
            } // end for
            $dblist       = $true_dblist;
            unset($true_dblist);
            $only_db_check = TRUE;
        } // end if

        // 'only_db' is empty for the current user...
        else {
            $only_db_check = FALSE;
        } // end if (!$dblist_cnt)

        if (isset($dblist_full) && !count($dblist_full)) {
            $dblist = PMA_safe_db_list($only_db_check, $dbh, $dblist_cnt, $rs, $userlink, $cfg, $dblist);
        }

    } // end server connecting
    /**
     * Missing server hostname
     */
    else {
        echo $strHostEmpty;
    }

    /**
     * Send HTTP header, taking IIS limits into account
     *                   ( 600 seems ok)
     *
     * @param   string   the header to send
     *
     * @return  boolean  always true
     */
     function PMA_sendHeaderLocation($uri)
     {
         if (PMA_IS_IIS && strlen($uri) > 600) {

             echo '<html><head><title>- - -</title>' . "\n";
             echo '<meta http-equiv="expires" content="0">' . "\n";
             echo '<meta http-equiv="Pragma" content="no-cache">' . "\n";
             echo '<meta http-equiv="Cache-Control" content="no-cache">' . "\n";
             echo '<meta http-equiv="Refresh" content="0;url=' .$uri . '">' . "\n";
             echo '<script language="JavaScript">' . "\n";
             echo 'setTimeout ("window.location = unescape(\'"' . $uri . '"\')",2000); </script>' . "\n";
             echo '</head>' . "\n";
             echo '<body> <script language="JavaScript">' . "\n";
             echo 'document.write (\'<p><a href="' . $uri . '">' . $GLOBALS['strGo'] . '</a></p>\');' . "\n";
             echo '</script></body></html>' . "\n";

         } else {
             header('Location: ' . $uri);
         }
     }


    /**
     * Get the list and number of available databases.
     *
     * @param   string   the url to go back to in case of error
     *
     * @return  boolean  always true
     *
     * @global  array    the list of available databases
     * @global  integer  the number of available databases
     * @global  array    current configuration
     */
    function PMA_availableDatabases($error_url = '')
    {
        global $dblist;
        global $num_dbs;
        global $cfg;

        $num_dbs = count($dblist);

        // 1. A list of allowed databases has already been defined by the
        //    authentification process -> gets the available databases list
        if ($num_dbs) {
            $true_dblist = array();
            for ($i = 0; $i < $num_dbs; $i++) {
                $dblink  = @PMA_DBI_select_db($dblist[$i]);
                if ($dblink) {
                    $true_dblist[] = $dblist[$i];
                } // end if
            } // end for
            $dblist      = array();
            $dblist      = $true_dblist;
            unset($true_dblist);
            $num_dbs     = count($dblist);
        } // end if
        // 2. Allowed database list is empty -> gets the list of all databases
        //    on the server
        else if (!isset($cfg['Server']['only_db']) || $cfg['Server']['only_db'] == '') {
            $dblist = PMA_DBI_get_dblist(); // needed? or PMA_mysqlDie('', 'SHOW DATABASES;', FALSE, $error_url);
            $num_dbs = count($dblist);
        } // end else

        return TRUE;
    } // end of the 'PMA_availableDatabases()' function



    /* ----------------------- Set of misc functions ----------------------- */


    /**
     * Adds backquotes on both sides of a database, table or field name.
     * Since MySQL 3.23.6 this allows to use non-alphanumeric characters in
     * these names.
     *
     * @param   mixed    the database, table or field name to "backquote" or
     *                   array of it
     * @param   boolean  a flag to bypass this function (used by dump
     *                   functions)
     *
     * @return  mixed    the "backquoted" database, table or field name if the
     *                   current MySQL release is >= 3.23.6, the original one
     *                   else
     *
     * @access  public
     */
    function PMA_backquote($a_name, $do_it = TRUE)
    {
        // '0' is also empty for php :-(
        if ($do_it
            && (!empty($a_name) || $a_name == '0') && $a_name != '*') {

            if (is_array($a_name)) {
                 $result = array();
                 foreach ($a_name AS $key => $val) {
                     $result[$key] = '`' . $val . '`';
                 }
                 return $result;
            } else {
                return '`' . $a_name . '`';
            }
        } else {
            return $a_name;
        }
    } // end of the 'PMA_backquote()' function


    /**
     * Format a string so it can be passed to a javascript function.
     * This function is used to displays a javascript confirmation box for
     * "DROP/DELETE/ALTER" queries.
     *
     * @param   string   the string to format
     * @param   boolean  whether to add backquotes to the string or not
     *
     * @return  string   the formated string
     *
     * @access  public
     */
    function PMA_jsFormat($a_string = '', $add_backquotes = TRUE)
    {
        if (is_string($a_string)) {
            $a_string = htmlspecialchars($a_string);
            $a_string = str_replace('\\', '\\\\', $a_string);
            $a_string = str_replace('\'', '\\\'', $a_string);
            $a_string = str_replace('#', '\\#', $a_string);
            $a_string = str_replace("\012", '\\\\n', $a_string);
            $a_string = str_replace("\015", '\\\\r', $a_string);
        }

        return (($add_backquotes) ? PMA_backquote($a_string) : $a_string);
    } // end of the 'PMA_jsFormat()' function


    /**
     * Defines the <CR><LF> value depending on the user OS.
     *
     * @return  string   the <CR><LF> value to use
     *
     * @access  public
     */
    function PMA_whichCrlf()
    {
        $the_crlf = "\n";

        // The 'PMA_USR_OS' constant is defined in "./libraries/defines.lib.php"
        // Win case
        if (PMA_USR_OS == 'Win') {
            $the_crlf = "\r\n";
        }
        // Mac case
        else if (PMA_USR_OS == 'Mac') {
            $the_crlf = "\r";
        }
        // Others
        else {
            $the_crlf = "\n";
        }

        return $the_crlf;
    } // end of the 'PMA_whichCrlf()' function


    /**
     * Counts and displays the number of records in a table
     *
     * Last revision 13 July 2001: Patch for limiting dump size from
     * vinay@sanisoft.com & girish@sanisoft.com
     *
     * @param   string   the current database name
     * @param   string   the current table name
     * @param   boolean  whether to retain or to displays the result
     * @param   boolean  whether to force an exact count
     *
     * @return  mixed    the number of records if retain is required, true else
     *
     * @access  public
     */
    function PMA_countRecords($db, $table, $ret = FALSE, $force_exact = FALSE)
    {
        global $err_url, $cfg;
        if (!$force_exact) {
            $result       = PMA_DBI_query('SHOW TABLE STATUS FROM ' . PMA_backquote($db) . ' LIKE \'' . PMA_sqlAddslashes($table, TRUE) . '\';');
            $showtable    = PMA_DBI_fetch_assoc($result);
            $num     = (isset($showtable['Rows']) ? $showtable['Rows'] : 0);
            if ($num < $cfg['MaxExactCount']) {
                unset($num);
            }
            PMA_DBI_free_result($result);
        }

        if (!isset($num)) {
            $result    = PMA_DBI_query('SELECT COUNT(*) AS num FROM ' . PMA_backquote($db) . '.' . PMA_backquote($table));
            list($num) = ($result) ? PMA_DBI_fetch_row($result) : array(0);
            PMA_DBI_free_result($result);
        }
        if ($ret) {
            return $num;
        } else {
            echo number_format($num, 0, $GLOBALS['number_decimal_separator'], $GLOBALS['number_thousands_separator']);
            return TRUE;
        }
    } // end of the 'PMA_countRecords()' function

    /**
     * Reloads navigation if needed.
     *
     * @global  mixed   configuration
     * @global  bool    whether to reload
     *
     * @access  public
     */
    function PMA_reloadNavigation() {
        global $cfg;

        // Reloads the navigation frame via JavaScript if required
        if (isset($GLOBALS['reload']) && $GLOBALS['reload']) {
            echo "\n";
            $reload_url = './left.php?' . PMA_generate_common_url((isset($GLOBALS['db']) ? $GLOBALS['db'] : ''), '', '&');
            ?>
<script type="text/javascript" language="javascript1.2">
<!--
if (typeof(window.parent) != 'undefined'
    && typeof(window.parent.frames['nav']) != 'undefined') {
    window.parent.frames['nav'].goTo('<?php echo $reload_url; ?>&hash=' + <?php echo (($cfg['QueryFrame'] && $cfg['QueryFrameJS']) ? 'window.parent.frames[\'queryframe\'].document.hashform.hash.value' : "'" . md5($cfg['PmaAbsoluteUri']) . "'"); ?>);
}
//-->
</script>
            <?php
            unset($GLOBALS['reload']);
        }
    }

    /**
     * Displays a message at the top of the "main" (right) frame
     *
     * @param   string  the message to display
     *
     * @global  array   the configuration array
     *
     * @access  public
     */
    function PMA_showMessage($message)
    {
        global $cfg;

        // Sanitizes $message
        $message = PMA_sanitize($message);

        // Corrects the tooltip text via JS if required
        if (!empty($GLOBALS['table']) && $cfg['ShowTooltip']) {
            $result = PMA_DBI_try_query('SHOW TABLE STATUS FROM ' . PMA_backquote($GLOBALS['db']) . ' LIKE \'' . PMA_sqlAddslashes($GLOBALS['table'], TRUE) . '\'');
            if ($result) {
                $tbl_status = PMA_DBI_fetch_assoc($result);
                $tooltip    = (empty($tbl_status['Comment']))
                            ? ''
                            : $tbl_status['Comment'] . ' ';
                $tooltip .= '(' . $tbl_status['Rows'] . ' ' . $GLOBALS['strRows'] . ')';
                PMA_DBI_free_result($result);
                $md5_tbl = md5($GLOBALS['table']);
                echo "\n";
                ?>
<script type="text/javascript" language="javascript1.2">
<!--
if (typeof(document.getElementById) != 'undefined'
    && typeof(window.parent.frames['nav']) != 'undefined'
    && typeof(window.parent.frames['nav'].document) != 'undefined' && typeof(window.parent.frames['nav'].document) != 'unknown'
    && (window.parent.frames['nav'].document.getElementById('<?php echo 'tbl_' . $md5_tbl; ?>'))
    && typeof(window.parent.frames['nav'].document.getElementById('<?php echo 'tbl_' . $md5_tbl; ?>')) != 'undefined'
    && typeof(window.parent.frames['nav'].document.getElementById('<?php echo 'tbl_' . $md5_tbl; ?>').title) == 'string') {
    window.parent.frames['nav'].document.getElementById('<?php echo 'tbl_' . $md5_tbl; ?>').title = '<?php echo PMA_jsFormat($tooltip, FALSE); ?>';
}
//-->
</script>
                <?php
            } // end if
        } // end if... else if

        // Checks if the table needs to be repaired after a TRUNCATE query.
        if (isset($GLOBALS['table']) && isset($GLOBALS['sql_query'])
            && $GLOBALS['sql_query'] == 'TRUNCATE TABLE ' . PMA_backquote($GLOBALS['table'])) {
            if (!isset($tbl_status)) {
                $result = @PMA_DBI_try_query('SHOW TABLE STATUS FROM ' . PMA_backquote($GLOBALS['db']) . ' LIKE \'' . PMA_sqlAddslashes($GLOBALS['table'], TRUE) . '\'');
                if ($result) {
                    $tbl_status = PMA_DBI_fetch_assoc($result);
                    PMA_DBI_free_result($result);
                }
            }
            if (isset($tbl_status) && (int) $tbl_status['Index_length'] > 1024) {
                PMA_DBI_try_query('REPAIR TABLE ' . PMA_backquote($GLOBALS['table']));
            }
        }
        unset($tbl_status);

        echo "\n";
        ?>
<br />
<div align="<?php echo $GLOBALS['cell_align_left']; ?>">
    <table border="<?php echo $cfg['Border']; ?>" cellpadding="5" cellspacing="1">
    <tr>
        <th<?php echo ($GLOBALS['theme'] != 'original') ? ' class="tblHeaders"' : ' bgcolor="' . $cfg['ThBgcolor'] . '"'; ?>>
            <b><?php echo $message; ?></b>
        </th>
    </tr>
        <?php
        if ($cfg['ShowSQL'] == TRUE && (!empty($GLOBALS['sql_query']) || !empty($GLOBALS['display_query']))) {
            $local_query = !empty($GLOBALS['display_query']) ? $GLOBALS['display_query'] : (($cfg['SQP']['fmtType'] == 'none' && isset($GLOBALS['unparsed_sql']) && $GLOBALS['unparsed_sql'] != '') ? $GLOBALS['unparsed_sql'] : $GLOBALS['sql_query']);
            // Basic url query part
            $url_qpart = '?' . PMA_generate_common_url(isset($GLOBALS['db']) ? $GLOBALS['db'] : '', isset($GLOBALS['table']) ? $GLOBALS['table'] : '');
            echo "\n";
            ?>
    <tr>
        <td bgcolor="<?php echo $cfg['BgcolorOne']; ?>">
            <?php
            echo "\n";
            // Html format the query to be displayed
            // The nl2br function isn't used because its result isn't a valid
            // xhtml1.0 statement before php4.0.5 ("<br>" and not "<br />")
            // If we want to show some sql code it is easiest to create it here
             /* SQL-Parser-Analyzer */
            
            if (!empty($GLOBALS['show_as_php'])) {
                $new_line = '\'<br />' . "\n" . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;. \' ';
            }
            if (isset($new_line)) {
                 /* SQL-Parser-Analyzer */
                $query_base = PMA_sqlAddslashes(htmlspecialchars($local_query), FALSE, FALSE, TRUE);
                 /* SQL-Parser-Analyzer */
                $query_base = preg_replace("@((\015\012)|(\015)|(\012))+@", $new_line, $query_base);
            } else {
                $query_base = $local_query;
            }

            // Here we append the LIMIT added for navigation, to
            // enable its display. Adding it higher in the code
            // to $local_query would create a problem when
            // using the Refresh or Edit links.

            // Only append it on SELECTs.

            // FIXME: what would be the best to do when someone
            // hits Refresh: use the current LIMITs ?

            // TODO: use the parser instead of preg_match()

            if (preg_match('@^SELECT[[:space:]]+@i', $query_base)
             && isset($GLOBALS['sql_limit_to_append'])) {
                $query_base .= $GLOBALS['sql_limit_to_append'];
            }

            if (!empty($GLOBALS['show_as_php'])) {
                $query_base = '$sql  = \'' . $query_base;
            } else if (!empty($GLOBALS['validatequery'])) {
                $query_base = PMA_validateSQL($query_base);
            } else {
                // avoid reparsing query:
                if (isset($GLOBALS['parsed_sql']) && $query_base == $GLOBALS['parsed_sql']['raw']) {
                    $parsed_sql = $GLOBALS['parsed_sql'];
                } else {
                    $parsed_sql = PMA_SQP_parse($query_base);
                }
                $query_base = PMA_formatSql($parsed_sql, $query_base);
            }

            // Prepares links that may be displayed to edit/explain the query
            // (don't go to default pages, we must go to the page
            // where the query box is available)
            // (also, I don't see why we should check the goto variable)

            //if (!isset($GLOBALS['goto'])) {
                //$edit_target = (isset($GLOBALS['table'])) ? $cfg['DefaultTabTable'] : $cfg['DefaultTabDatabase'];
            $edit_target = isset($GLOBALS['db']) ? (isset($GLOBALS['table']) ? 'tbl_properties.php' : 'db_details.php') : '';
            //} else if ($GLOBALS['goto'] != 'main.php') {
            //    $edit_target = $GLOBALS['goto'];
            //} else {
            //    $edit_target = '';
            //}

            if (isset($cfg['SQLQuery']['Edit'])
                && ($cfg['SQLQuery']['Edit'] == TRUE )
                && (!empty($edit_target))) {

                $onclick = '';
                if ($cfg['QueryFrameJS'] && $cfg['QueryFrame']) {
                    $onclick = 'onclick="focus_querywindow(\'' . urlencode($local_query) . '\'); return false;"';
                }

                $edit_link = '&nbsp;[<a href="'
                           . $edit_target
                           . $url_qpart
                           . '&amp;sql_query=' . urlencode($local_query) . '&amp;show_query=1#querybox" ' . $onclick . '>' . $GLOBALS['strEdit'] . '</a>]';
            } else {
                $edit_link = '';
            }

            // Want to have the query explained (Mike Beck 2002-05-22)
            // but only explain a SELECT (that has not been explained)
            /* SQL-Parser-Analyzer */
            if (isset($cfg['SQLQuery']['Explain'])
                && $cfg['SQLQuery']['Explain'] == TRUE) {

                // Detect if we are validating as well
                // To preserve the validate uRL data
                if (!empty($GLOBALS['validatequery'])) {
                    $explain_link_validate = '&amp;validatequery=1';
                } else {
                    $explain_link_validate = '';
                }

                $explain_link = '&nbsp;[<a href="read_dump.php'
                              . $url_qpart
                              . $explain_link_validate
                              . '&amp;sql_query=';

                if (preg_match('@^SELECT[[:space:]]+@i', $local_query)) {
                    $explain_link .= urlencode('EXPLAIN ' . $local_query) . '">' . $GLOBALS['strExplain'];
                } else if (preg_match('@^EXPLAIN[[:space:]]+SELECT[[:space:]]+@i', $local_query)) {
                    $explain_link .= urlencode(substr($local_query, 8)) . '">' . $GLOBALS['strNoExplain'];
                } else {
                    $explain_link = '';
                }
                if (!empty($explain_link)) {
                    $explain_link .= '</a>]';
                }
            } else {
                $explain_link = '';
            } //show explain

            // Also we would like to get the SQL formed in some nice
            // php-code (Mike Beck 2002-05-22)
            if (isset($cfg['SQLQuery']['ShowAsPHP'])
                && $cfg['SQLQuery']['ShowAsPHP'] == TRUE) {
                $php_link = '&nbsp;[<a href="read_dump.php'
                          . $url_qpart
                          . '&amp;show_query=1'
                          . '&amp;sql_query=' . urlencode($local_query)
                          . '&amp;show_as_php=';

                if (!empty($GLOBALS['show_as_php'])) {
                    $php_link .= '0">' . $GLOBALS['strNoPhp'];
                } else {
                    $php_link .= '1">' . $GLOBALS['strPhp'];
                }
                $php_link .= '</a>]';

                if (isset($GLOBALS['show_as_php']) && $GLOBALS['show_as_php'] == '1') {
                    $php_link .= '&nbsp;[<a href="read_dump.php'
                              . $url_qpart
                              . '&amp;show_query=1'
                              . '&amp;sql_query=' . urlencode($local_query)
                              . '">' . $GLOBALS['strRunQuery'] . '</a>]';
                }

            } else {
                $php_link = '';
            } //show as php

            // Refresh query
            if (isset($cfg['SQLQuery']['Refresh'])
                && $cfg['SQLQuery']['Refresh']
                && preg_match('@^(SELECT|SHOW)[[:space:]]+@i', $local_query)) {

                $refresh_link = '&nbsp;[<a href="read_dump.php'
                          . $url_qpart
                          . '&amp;show_query=1'
                          . '&amp;sql_query=' . urlencode($local_query)
                          . '">';
                $refresh_link .= $GLOBALS['strRefresh'];
                $refresh_link .= '</a>]';
            } else {
                $refresh_link = '';
            } //show as php

            if (isset($cfg['SQLValidator']['use'])
                && $cfg['SQLValidator']['use'] == TRUE
                && isset($cfg['SQLQuery']['Validate'])
                && $cfg['SQLQuery']['Validate'] == TRUE) {
                $validate_link = '&nbsp;[<a href="read_dump.php'
                               . $url_qpart
                               . '&amp;show_query=1'
                               . '&amp;sql_query=' . urlencode($local_query)
                               . '&amp;validatequery=';
                if (!empty($GLOBALS['validatequery'])) {
                    $validate_link .= '0">' .  $GLOBALS['strNoValidateSQL'] ;
                } else {
                    $validate_link .= '1">'. $GLOBALS['strValidateSQL'] ;
                }
                $validate_link .= '</a>]';
            } else {
                $validate_link = '';
            } //validator

            // Displays the message
            echo '            <b>' . $GLOBALS['strSQLQuery'] . ':</b>&nbsp;';
            echo '<br />' . "\n";
            echo '            ' . $query_base;

            unset($local_query);
            //Clean up the end of the PHP
            if (!empty($GLOBALS['show_as_php'])) {
                echo '\';';
            }
            echo "\n";
            ?>
        </td>
    </tr>
    <?php
            if (!empty($edit_target)) {
                echo '<tr><td bgcolor="' . $cfg['BgcolorOne'] . '" align="center">';
                echo $edit_link . $explain_link . $php_link . $refresh_link . $validate_link;
                echo '</td></tr>' . "\n";
            }
        }
        echo "\n";
        ?>
    </table>
</div><br />
        <?php
    } // end of the 'PMA_showMessage()' function


    /**
     * Formats $value to byte view
     *
     * @param    double   the value to format
     * @param    integer  the sensitiveness
     * @param    integer  the number of decimals to retain
     *
     * @return   array    the formatted value and its unit
     *
     * @access  public
     *
     * @author   staybyte
     * @version  1.2 - 18 July 2002
     */
    function PMA_formatByteDown($value, $limes = 6, $comma = 0)
    {
        $dh           = pow(10, $comma);
        $li           = pow(10, $limes);
        $return_value = $value;
        $unit         = $GLOBALS['byteUnits'][0];

        for ( $d = 6, $ex = 15; $d >= 1; $d--, $ex-=3 ) {
            if (isset($GLOBALS['byteUnits'][$d]) && $value >= $li * pow(10, $ex)) {
                $value = round($value / ( pow(1024, $d) / $dh) ) /$dh;
                $unit = $GLOBALS['byteUnits'][$d];
                break 1;
            } // end if
        } // end for

        if ($unit != $GLOBALS['byteUnits'][0]) {
            $return_value = number_format($value, $comma, $GLOBALS['number_decimal_separator'], $GLOBALS['number_thousands_separator']);
        } else {
            $return_value = number_format($value, 0, $GLOBALS['number_decimal_separator'], $GLOBALS['number_thousands_separator']);
        }

        return array($return_value, $unit);
    } // end of the 'PMA_formatByteDown' function


    /**
     * Extracts ENUM / SET options from a type definition string
     *
     * @param   string   The column type definition
     *
     * @return  array    The options or
     *          boolean  FALSE in case of an error.
     *
     * @author  rabus
     */
    function PMA_getEnumSetOptions($type_def) {
        $open = strpos($type_def, '(');
        $close = strrpos($type_def, ')');
        if (!$open || !$close) {
            return FALSE;
        }
        $options = substr($type_def, $open + 2, $close - $open - 3);
        $options = explode('\',\'', $options);
        return $options;
    } // end of the 'PMA_getEnumSetOptions' function

    /**
     * Writes localised date
     *
     * @param   string   the current timestamp
     *
     * @return  string   the formatted date
     *
     * @access  public
     */
    function PMA_localisedDate($timestamp = -1, $format = '')
    {
        global $datefmt, $month, $day_of_week;

        if ($format == '') {
            $format = $datefmt;
        }

        if ($timestamp == -1) {
            $timestamp = time();
        }

        $date = preg_replace('@%[aA]@', $day_of_week[(int)strftime('%w', $timestamp)], $format);
        $date = preg_replace('@%[bB]@', $month[(int)strftime('%m', $timestamp)-1], $date);

        return strftime($date, $timestamp);
    } // end of the 'PMA_localisedDate()' function


    /**
     * Prints out a tab for tabbed navigation.
     * If the variables $link and $args ar left empty, an inactive tab is created
     *
     * @param   string  the text to be displayed as link
     * @param   string  main link file, e.g. "test.php"
     * @param   string  link arguments
     * @param   string  link attributes
     * @param   string  include '?' even though no attributes are set. Can be set empty, should be '?'.
     * @param   boolean force display TAB as active
     *
     * @return  string  two table cells, the first beeing a separator, the second the tab itself
     *
     * @access  public
     */
/* replaced with a newer function
   2004-05-20 by Michael Keck <mail_at_michaelkeck_dot_de>
*/
/*
    function PMA_printTab($text, $link, $args = '', $attr = '', $class = '', $sep = '?', $active = false) {
        global $PHP_SELF, $cfg;
        global $db_details_links_count_tabs;

        if (!empty($class)) {
            $class = ' class="' . $class . '"';
            $addclass = ' ' . $class;
        } else {
            $addclass = '';
        }

        if (((!isset($GLOBALS['active_page']) && basename($PHP_SELF) == $link) ||
                $active ||
                (isset($GLOBALS['active_page']) && $GLOBALS['active_page'] == $link)
            ) && ($text != $GLOBALS['strEmpty'] && $text != $GLOBALS['strDrop'])) {
            $addclass .= ' activetab';
        }

        $db_details_links_count_tabs++;

        if ($cfg['LightTabs']) {
            $out = '';
            if (strlen($link) > 0) {
                $out .= '<a class="tab" href="' . $link . $sep . $args . '"' . $attr . $class . '>'
                     .  '' . $text . '</a>';
            } else {
                $out .= '<span class="tab">' . $text . '</span>';
            }
            $out = '[ ' . $out . ' ]&nbsp;&nbsp;&nbsp;';
        } else {
            $out     = "\n" . '        '
                     . '<td class="tab nowrap' . $addclass . '">'
                     . "\n" . '            ';
            if (strlen($link) > 0) {
                $out .= '<a href="' . $link . $sep . $args . '"' . $attr .  $class . '>'
                     .  $text . '</a>';
            } else {
                $out .= $text;
            }
            $out     .= "\n" . '        '
                     .  '</td>'
                     .  "\n" . '        '
                     .  '<td width="8">&nbsp;</td>';
        }

        return $out;
    } // end of the 'PMA_printTab()' function
*/
// the new one:
    function PMA_printTab($text, $link, $args = '', $attr = '', $class = '', $sep = '?', $active = false) {
        global $PHP_SELF, $cfg;
        global $db_details_links_count_tabs;
        $addclass = '';
        if (((!isset($GLOBALS['active_page']) && basename($PHP_SELF) == $link) ||
                $active ||
                (isset($GLOBALS['active_page']) && $GLOBALS['active_page'] == $link)
            ) && ($text != $GLOBALS['strEmpty'] && $text != $GLOBALS['strDrop'])) {
            $addclass = 'Active';
        }
        if ($text == $GLOBALS['strEmpty'] && $text == $GLOBALS['strDrop']) $addclass = 'Drop';
        if (empty($class)){
            if (empty($addclass)) { $addclass = 'Normal'; }
        } else { $addclass = $class; }

        $db_details_links_count_tabs++;

        if ($cfg['LightTabs']) {
            $out = '';
            if (!empty($link)) {
                $out .= '<a class="tab" href="' . $link . $sep . $args . '"' . $attr . $class . '>'
                     .  '' . $text . '</a>';
            } else {
                $out .= '<span class="tab">' . $text . '</span>';
            }
            $out = '[ ' . $out . ' ]&nbsp;&nbsp;&nbsp;';
        } else {
            $out     = "\n" . '        '
                     . '<td class="nav' . $addclass . '" nowrap="nowrap">'
                     . "\n" . '            ';
            if (!empty($link)) {
                $out .= '<a href="' . $link . $sep . $args . '"' . $attr . '>'
                     .  $text . '</a>';
            } else {
                $out .= $text;
            }
            $out     .= "\n" . '        '
                     .  '</td>'
                     .  "\n" . '        '
                     .  '<td class="navSpacer"><img src="' . $GLOBALS['pmaThemeImage'] . 'spacer.png' . '" width="1" height="1" border="0" alt="" /></td>';
        }

        return $out;
    } // end of the 'PMA_printTab()' function


    /**
     * Displays a link, or a button if the link's URL is too large, to
     * accommodate some browsers' limitations
     *
     * @param  string  the URL
     * @param  string  the link message
     * @param  string  js confirmation
     * @param  boolean we set this to FALSE when we are already in a form,
     *                 to avoid generating nested forms
     *
     * @return string  the results to be echoed or saved in an array
     */
    function PMA_linkOrButton($url, $message, $js_conf, $allow_button = TRUE)
    {
        // previously the limit was set to 2047, it seems 1000 is better
        if (strlen($url) <= 1000) {
            $onclick_url        = (empty($js_conf) ? '' : ' onclick="return confirmLink(this, \'' . $js_conf . '\')"');
            $link_or_button     = '        <a href="' . $url . '"' . $onclick_url . '>' . "\n"
                                . '           ' . $message . '</a>' . "\n";
        }
        elseif ($allow_button) {
            $edit_url_parts     = parse_url($url);
            $query_parts        = explode('&', $edit_url_parts['query']);
            $link_or_button     = '        <form action="'
                                . $edit_url_parts['path']
                                . '" method="post">' . "\n";
            foreach ($query_parts AS $query_pair) {
                list($eachvar, $eachval) = explode('=', $query_pair);
                $link_or_button .= '            <input type="hidden" name="' . str_replace('amp;', '', $eachvar) . '" value="' . htmlspecialchars(urldecode($eachval)) . '" />' . "\n";
            } // end while

            if (stristr($message, '<img')) {
                $link_or_button     .= '            <input type="image" src="' . preg_replace('@^.*src="(.*)".*$@si', '\1', $message) . '" value="'
                                    . htmlspecialchars(preg_replace('@^.*alt="(.*)".*$@si', '\1', $message)) . '" />' . "\n" . '</form>' . "\n";
            } else {
                $link_or_button     .= '            <input type="submit" value="'
                                    . htmlspecialchars($message) . '" />' . "\n" . '</form>' . "\n";
            }
        } else {
            $link_or_button = ' <dfn title="' . $GLOBALS['strNeedPrimaryKey'] . '">?</dfn> ';
        } // end if... else...

            return $link_or_button;
    } // end of the 'PMA_linkOrButton()' function


    /**
     * Returns a given timespan value in a readable format.
     *
     * @param  int     the timespan
     *
     * @return string  the formatted value
     */
    function PMA_timespanFormat($seconds)
    {
        $return_string = '';
        $days = floor($seconds / 86400);
        if ($days > 0) {
            $seconds -= $days * 86400;
        }
        $hours = floor($seconds / 3600);
        if ($days > 0 || $hours > 0) {
            $seconds -= $hours * 3600;
        }
        $minutes = floor($seconds / 60);
        if ($days > 0 || $hours > 0 || $minutes > 0) {
            $seconds -= $minutes * 60;
        }
        return sprintf($GLOBALS['timespanfmt'], (string)$days, (string)$hours, (string)$minutes, (string)$seconds);
    }

    /**
     * Takes a string and outputs each character on a line for itself. Used mainly for horizontalflipped display mode.
     * Takes care of special html-characters.
     * Fulfills todo-item http://sourceforge.net/tracker/index.php?func=detail&aid=544361&group_id=23067&atid=377411
     *
     * @param   string   The string
     * @param   string   The Separator (defaults to "<br />\n")
     *
     * @access  public
     * @author  Garvin Hicking <me@supergarv.de>
     * @return  string      The flipped string
     */
    function PMA_flipstring($string, $Separator = "<br />\n") {
        $format_string = '';
        $charbuff = false;

        for ($i = 0; $i < strlen($string); $i++) {
            $char = $string{$i};
            $append = false;

            if ($char == '&') {
                $format_string .= $charbuff;
                $charbuff = $char;
                $append = true;
            } elseif (!empty($charbuff)) {
                $charbuff .= $char;
            } elseif ($char == ';' && !empty($charbuff)) {
                $format_string .= $charbuff;
                $charbuff = false;
                $append = true;
            } else {
                $format_string .= $char;
                $append = true;
            }

            if ($append && ($i != strlen($string))) {
                $format_string .= $Separator;
            }
        }

        return $format_string;
    }


    /**
     * Function added to avoid path disclosures.
     * Called by each script that needs parameters, it displays
     * an error message and, by default, stops the execution.
     *
     * Not sure we could use a strMissingParameter message here,
     * would have to check if the error message file is always available
     *
     * @param   array   The names of the parameters needed by the calling
     *                  script.
     * @param   boolean Stop the execution?
     *                  (Set this manually to FALSE in the calling script
     *                   until you know all needed parameters to check).
     *
     * @access  public
     * @author  Marc Delisle (lem9@users.sourceforge.net)
     */
    function PMA_checkParameters($params, $die = TRUE) {
        global $PHP_SELF;

        $reported_script_name = basename($PHP_SELF);
        $found_error = FALSE;
        $error_message = '';

        foreach ($params AS $param) {
            if (!isset($GLOBALS[$param])) {
                $error_message .= $reported_script_name . ': Missing parameter: ' . $param . ' <a href="./Documentation.html#faqmissingparameters" target="documentation"> (FAQ 2.8)</a><br />';
                $found_error = TRUE;
            }
        }
        if ($found_error) {
            require_once('./libraries/header_meta_style.inc.php');
            echo '</head><body><p>' . $error_message . '</p></body></html>';
            if ($die) {
                exit();
            }
        }
    } // end function

    // Kanji encoding convert feature appended by Y.Kawada (2002/2/20)
    if (@function_exists('mb_convert_encoding')
        && strpos(' ' . $lang, 'ja-')
        && file_exists('./libraries/kanji-encoding.lib.php')) {
        require_once('./libraries/kanji-encoding.lib.php');
        define('PMA_MULTIBYTE_ENCODING', 1);
    } // end if

    /**
     * Function to check valid extension of file. It accepts entered
     * extensions and bz2 and gz if supported.
     *
     * @param   string  File name to be tested.
     * @param   string  Extension that is valid.
     *
     * @access  public
     * @author  Michal Cihar (nijel@users.sourceforge.net)
     * @return  bool    Whether extension is valid
     */
    function PMA_checkFileExtensions($file, $extension) {
        if (substr($file, -1 * strlen($extension)) == $extension) {
            return TRUE;
        }
        if ($GLOBALS['cfg']['GZipDump'] && @function_exists('gzopen')) {
            if (substr($file, -3 - strlen($extension)) == $extension . '.gz') {
                return TRUE;
            }
        }
        if ($GLOBALS['cfg']['BZipDump'] && @function_exists('bzdecompress')) {
            if (substr($file, -4 - strlen($extension)) == $extension . '.bz2') {
                return TRUE;
            }
        }
        return FALSE;
    } // end function

    /**
     * Function to generate unique condition for specified row.
     *
     * @param   resource    handle for current query
     * @param   integer     number of fields
     * @param   array       meta information about fields
     * @param   array       current row
     *
     * @access  public
     * @author  Michal Cihar (michal@cihar.com)
     * @return  string      calculated condition
     */
    function PMA_getUvaCondition($handle, $fields_cnt, $fields_meta, $row) {

        $primary_key              = '';
        $unique_key               = '';
        $uva_nonprimary_condition = '';

        for ($i = 0; $i < $fields_cnt; ++$i) {
            $field_flags = PMA_DBI_field_flags($handle, $i);
            $meta      = $fields_meta[$i];
            // do not use an alias in a condition
            $column_for_condition = $meta->name;
            if (isset($analyzed_sql[0]['select_expr']) && is_array($analyzed_sql[0]['select_expr'])) {
                foreach ($analyzed_sql[0]['select_expr'] AS $select_expr_position => $select_expr) {
                    $alias = $analyzed_sql[0]['select_expr'][$select_expr_position]['alias'];
                    if (!empty($alias)) {
                        $true_column = $analyzed_sql[0]['select_expr'][$select_expr_position]['column'];
                        if ($alias == $meta->name) {
                            $column_for_condition = $true_column;
                        } // end if
                    } // end if
                } // end while
            }

            // to fix the bug where float fields (primary or not)
            // can't be matched because of the imprecision of
            // floating comparison, use CONCAT
            // (also, the syntax "CONCAT(field) IS NULL"
            // that we need on the next "if" will work)
            if ($meta->type == 'real') {
                $condition = ' CONCAT(' . PMA_backquote($column_for_condition) . ') ';
            } else {
                // string and blob fields have to be converted using
                // the system character set (always utf8) since
                // mysql4.1 can use different charset for fields.
                if (PMA_MYSQL_INT_VERSION >= 40100 && ($meta->type == 'string' || $meta->type == 'blob')) {
                    $condition = ' CONVERT(' . PMA_backquote($column_for_condition) . ' USING utf8) ';
                } else {
                    $condition = ' ' . PMA_backquote($column_for_condition) . ' ';
                }
            } // end if... else...

            if (!isset($row[$i]) || is_null($row[$i])) {
                $condition .= 'IS NULL AND';
            } else {
                // timestamp is numeric on some MySQL 4.1
                if ($meta->numeric && $meta->type != 'timestamp') {
                    $condition .= '= ' . $row[$i] . ' AND';
                } elseif ($meta->type == 'blob'
                    // hexify only if this is a true not empty BLOB
                     && stristr($field_flags, 'BINARY')
                     && !empty($row[$i])) {
                        // use a CAST if possible, to avoid problems
                        // if the field contains wildcard characters % or _
                        if (PMA_MYSQL_INT_VERSION < 40002) {
                            $condition .= 'LIKE 0x' . bin2hex($row[$i]). ' AND';
                        } else {
                            $condition .= '= CAST(0x' . bin2hex($row[$i]). ' AS BINARY) AND';
                        }
                } else {
                    $condition .= '= \'' . PMA_sqlAddslashes($row[$i], FALSE, TRUE) . '\' AND';
                }
            }
            if ($meta->primary_key > 0) {
                $primary_key .= $condition;
            } else if ($meta->unique_key > 0) {
                $unique_key  .= $condition;
            }
            $uva_nonprimary_condition .= $condition;
        } // end for

        // Correction uva 19991216: prefer primary or unique keys
        // for condition, but use conjunction of all values if no
        // primary key
        if ($primary_key) {
            $uva_condition = $primary_key;
        } else if ($unique_key) {
            $uva_condition = $unique_key;
        } else {
            $uva_condition = $uva_nonprimary_condition;
        }

        return preg_replace('|\s?AND$|', '', $uva_condition);
    } // end function

    /**
     * Function to generate unique condition for specified row.
     *
     * @param   string      name of button element
     * @param   string      class of button element
     * @param   string      name of image element
     * @param   string      text to display
     * @param   string      image to display
     *
     * @access  public
     * @author  Michal Cihar (michal@cihar.com)
     */
    function PMA_buttonOrImage($button_name, $button_class, $image_name, $text, $image) {
        global $pmaThemeImage, $propicon;

        /* Opera has trouble with <input type="image"> */
        /* IE has trouble with <button> */
        if (PMA_USR_BROWSER_AGENT != 'IE') {
            echo '<button class="' . $button_class . '" type="submit" name="' . $button_name . '" value="' . $text . '" title="' . $text . '">' . "\n"
               . '<img src="' . $pmaThemeImage . $image . '" title="' . $text . '" alt="' . $text . '" width="16" height="16" />' . (($propicon == 'both') ? '&nbsp;' . $text : '') . "\n"
               . '</button>' . "\n";
        } else {
            echo '<input type="image" name="' . $image_name . '" value="' .$text . '" title="' . $text . '" src="' . $pmaThemeImage . $image . '" />'  . (($propicon == 'both') ? '&nbsp;' . $text : '') . "\n";
        }
    } // end function

    /**
     * Generate a pagination selector for browsing resultsets
     *
     * @param   string      URL for the JavaScript
     * @param   string      Number of rows in the pagination set
     * @param   string      current page number
     * @param   string      number of total pages
     * @param   string      If the number of pages is lower than this
     *                      variable, no pages will be ommitted in
     *                      pagination
     * @param   string      How many rows at the beginning should always
     *                      be shown?
     * @param   string      How many rows at the end should always
     *                      be shown?
     * @param   string      Percentage of calculation page offsets to
     *                      hop to a next page
     * @param   string      Near the current page, how many pages should
     *                      be considered "nearby" and displayed as
     *                      well?
     *
     * @access  public
     * @author  Garvin Hicking (pma@supergarv.de)
     */
    function PMA_pageselector($url, $rows, $pageNow = 1, $nbTotalPage = 1, $showAll = 200, $sliceStart = 5, $sliceEnd = 5, $percent = 20, $range = 10) {
        $gotopage = '<br />' . $GLOBALS['strPageNumber']
                  . '<select name="goToPage" onchange="goToUrl(this, \'' . $url . '\');">' . "\n";
        if ($nbTotalPage < $showAll) {
            $pages = range(1, $nbTotalPage);
        } else {
            $pages = array();

            // Always show first X pages
            for ($i = 1; $i <= $sliceStart; $i++) {
                $pages[] = $i;
            }

            // Always show last X pages
            for ($i = $nbTotalPage - $sliceEnd; $i <= $nbTotalPage; $i++) {
                $pages[] = $i;
            }

            // garvin: Based on the number of results we add the specified $percent percentate to each page number,
            // so that we have a representing page number every now and then to immideately jump to specific pages.
            // As soon as we get near our currently chosen page ($pageNow - $range), every page number will be
            // shown.
            $i = $sliceStart;
            $x = $nbTotalPage - $sliceEnd;
            $met_boundary = false;
            while($i <= $x) {
                if ($i >= ($pageNow - $range) && $i <= ($pageNow + $range)) {
                    // If our pageselector comes near the current page, we use 1 counter increments
                    $i++;
                    $met_boundary = true;
                } else {
                    // We add the percentate increment to our current page to hop to the next one in range
                    $i = $i + floor($nbTotalPage / $percent);

                    // Make sure that we do not cross our boundaries.
                    if ($i > ($pageNow - $range) && !$met_boundary) {
                        $i = $pageNow - $range;
                    }
                }

                if ($i > 0 && $i <= $x) {
                    $pages[] = $i;
                }
            }

            // Since because of ellipsing of the current page some numbers may be double,
            // we unify our array:
            sort($pages);
            $pages = array_unique($pages);
        }

        foreach($pages AS $i) {
            if ($i == $pageNow) {
                $selected = 'selected="selected" style="font-weight: bold"';
            } else {
                $selected = '';
            }
            $gotopage .= '                <option ' . $selected . ' value="' . (($i - 1) * $rows) . '">' . $i . '</option>' . "\n";
        }

        $gotopage .= ' </select>';

        return $gotopage;
    } // end function


    function PMA_generateAlterTable($oldcol, $newcol, $full_field_type, $collation, $null, $default, $default_current_timestamp, $extra, $comment='') {

        // $default_current_timestamp has priority over $default
        // TODO: on the interface, some js to clear the default value
        // when the default current_timestamp is checked

        $query = PMA_backquote($oldcol) . ' ' . PMA_backquote($newcol) . ' '
            . $full_field_type;
        if (PMA_MYSQL_INT_VERSION >= 40100 && !empty($collation) && $collation != 'NULL' && preg_match('@^(TINYTEXT|TEXT|MEDIUMTEXT|LONGTEXT|VARCHAR\(\d+\)|CHAR\(\d+\))$@i', $full_field_type)) {
            $query .= PMA_generateCharsetQueryPart($collation);
        }

        if (!empty($null)) {
            $query .= ' NOT NULL';
        } else {
            $query .= ' NULL';
        }

        if ($default_current_timestamp && strpos(' ' . strtoupper($full_field_type),'TIMESTAMP') == 1) {
            $query .= ' DEFAULT CURRENT_TIMESTAMP';
            // 0 is empty in PHP
        } elseif (!empty($default) || $default == '0') {
            if (strtoupper($default) == 'NULL') {
                $query .= ' DEFAULT NULL';
            } else {
                $query .= ' DEFAULT \'' . PMA_sqlAddslashes($default) . '\'';
            }
        }

        if (!empty($extra)) {
            $query .= ' ' . $extra;
        }
        if (PMA_MYSQL_INT_VERSION >= 40100 && !empty($comment)) {
            $query .= " COMMENT '" . PMA_sqlAddslashes($comment) . "'";
        }
        return $query;
    } // end function

} // end if: minimal common.lib needed?

?>
