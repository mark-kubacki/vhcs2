<?php
/* $Id: database_interface.lib.php,v 2.18.4.1 2005/06/30 16:56:53 lem9 Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

/**
 * Common Option Constants For DBI Functions
 */
// PMA_DBI_try_query()
define('PMA_DBI_QUERY_STORE',       1);  // Force STORE_RESULT method, ignored by classic MySQL.
define('PMA_DBI_QUERY_UNBUFFERED',  2);  // Do not read whole query
// PMA_DBI_get_variable()
define('PMA_DBI_GETVAR_SESSION', 1);
define('PMA_DBI_GETVAR_GLOBAL', 2);

/**
 * Including The DBI Plugin
 */
require_once('./libraries/dbi/' . $cfg['Server']['extension'] . '.dbi.lib.php');

/**
 * Common Functions
 */
function PMA_DBI_query($query, $link = NULL, $options = 0) {
    $res = PMA_DBI_try_query($query, $link, $options)
        or PMA_mysqlDie(PMA_DBI_getError($link), $query);
    return $res;
}

function PMA_DBI_get_dblist($link = NULL) {
    if (empty($link)) {
        if (isset($GLOBALS['userlink'])) {
            $link = $GLOBALS['userlink'];
        } else {
            return FALSE;
        }
    }
    $res = PMA_DBI_try_query('SHOW DATABASES;', $link);
    $dbs_array = array();
    while ($row = PMA_DBI_fetch_row($res)) {

       // Before MySQL 4.0.2, SHOW DATABASES could send the
       // whole list, so check if we really have access:
       //if (PMA_MYSQL_CLIENT_API < 40002) {
       // Better check the server version, in case the client API
       // is more recent than the server version

       if (PMA_MYSQL_INT_VERSION < 40002) {
           $dblink = @PMA_DBI_select_db($row[0], $link);
           if (!$dblink) {
               continue;
           }
       }
       $dbs_array[] = $row[0];
    }
    PMA_DBI_free_result($res);
    unset($res);

    return $dbs_array;
}

function PMA_DBI_get_tables($database, $link = NULL) {
    $result       = PMA_DBI_query('SHOW TABLES FROM ' . PMA_backquote($database) . ';', NULL, PMA_DBI_QUERY_STORE);
    $tables       = array();
    while (list($current) = PMA_DBI_fetch_row($result)) {
        $tables[] = $current;
    }
    PMA_DBI_free_result($result);

    return $tables;
}

function PMA_DBI_get_tables_full($database, $link = NULL) {
    $result = PMA_DBI_query('SHOW TABLE STATUS FROM ' . PMA_backquote($database) . ';', NULL, PMA_DBI_QUERY_STORE);
    $tables = array();
    while ($row = PMA_DBI_fetch_assoc($result)) {
        $tables[$row['Name']] = $row;
    }
    PMA_DBI_free_result($result);
    return $tables;
}

function PMA_DBI_get_fields($database, $table, $link = NULL) {
    if (empty($link)) {
        if (isset($GLOBALS['userlink'])) {
            $link = $GLOBALS['userlink'];
        } else {
            return FALSE;
        }
    }
    // here we use a try_query because when coming from 
    // tbl_create + tbl_properties.inc.php, the table does not exist
    $result = PMA_DBI_try_query('SHOW FULL FIELDS FROM ' . PMA_backquote($database) . '.' . PMA_backquote($table), $link);

    if (!$result) {
        return FALSE;
    }

    $fields = array();
    while ($row = PMA_DBI_fetch_assoc($result)) {
        $fields[] = $row;
    }

    return $fields;
}

function PMA_DBI_get_variable($var, $type = PMA_DBI_GETVAR_SESSION, $link = NULL) {
    if ($link === NULL) {
        if (isset($GLOBALS['userlink'])) {
            $link = $GLOBALS['userlink'];
        } else {
            return FALSE;
        }
    }
    if (PMA_MYSQL_INT_VERSION < 40002) {
        $type = 0;
    }
    switch ($type) {
        case PMA_DBI_GETVAR_SESSION:
            $modifier = ' SESSION';
            break;
        case PMA_DBI_GETVAR_GLOBAL:
            $modifier = ' GLOBAL';
            break;
        default:
            $modifier = '';
    }
    $res = PMA_DBI_query('SHOW' . $modifier . ' VARIABLES LIKE \'' . $var . '\';', $link);
    $row = PMA_DBI_fetch_row($res);
    PMA_DBI_free_result($res);
    if (empty($row)) {
        return FALSE;
    } else {
        return $row[0] == $var ? $row[1] : FALSE;
    }
}

function PMA_DBI_postConnect($link, $is_controluser = FALSE) {
    global $collation_connection, $charset_connection;
    if (!defined('PMA_MYSQL_INT_VERSION')) {
        $result = PMA_DBI_query('SELECT VERSION() AS version', $link, PMA_DBI_QUERY_STORE);
        if ($result != FALSE && @PMA_DBI_num_rows($result) > 0) {
            $row   = PMA_DBI_fetch_row($result);
            $match = explode('.', $row[0]);
            PMA_DBI_free_result($result);
        }
        if (!isset($row)) {
            define('PMA_MYSQL_INT_VERSION', 32332);
            define('PMA_MYSQL_STR_VERSION', '3.23.32');
        } else{
            define('PMA_MYSQL_INT_VERSION', (int)sprintf('%d%02d%02d', $match[0], $match[1], intval($match[2])));
            define('PMA_MYSQL_STR_VERSION', $row[0]);
            unset($result, $row, $match);
        }
    }

    if (PMA_MYSQL_INT_VERSION >= 40100) {

        // If $lang is defined and we are on MySQL >= 4.1.x,
        // we auto-switch the lang to its UTF-8 version (if it exists)
        if (!empty($GLOBALS['lang']) && (substr($GLOBALS['lang'], -5) != 'utf-8')) {
            $lang_utf_8_version = substr($GLOBALS['lang'], 0, strpos($GLOBALS['lang'], '-')) . '-utf-8';
            if (!empty($GLOBALS['available_languages'][$lang_utf_8_version])) {
                $GLOBALS['lang'] = $lang_utf_8_version;
                $GLOBALS['charset'] = $charset = 'utf-8';
            }
        }

        // and we remove the non-UTF-8 choices to avoid confusion
        if (!defined('PMA_REMOVED_NON_UTF_8')) {
            $tmp_available_languages        = $GLOBALS['available_languages']; 
            $GLOBALS['available_languages'] = array();
            foreach ($tmp_available_languages AS $tmp_lang => $tmp_lang_data) {
                if (substr($tmp_lang, -5) == 'utf-8') {
                    $GLOBALS['available_languages'][$tmp_lang] = $tmp_lang_data;
                }
            } // end foreach
            unset($tmp_lang, $tmp_lang_data, $tmp_available_languages);
            define('PMA_REMOVED_NON_UTF_8',1);
        }

        $mysql_charset = $GLOBALS['mysql_charset_map'][$GLOBALS['charset']];
        if ($is_controluser || empty($collation_connection) || (strpos($collation_connection, '_') ? substr($collation_connection, 0, strpos($collation_connection, '_')) : $collation_connection) == $mysql_charset) {
            PMA_DBI_query('SET NAMES ' . $mysql_charset . ';', $link, PMA_DBI_QUERY_STORE);
        } else {
            PMA_DBI_query('SET CHARACTER SET ' . $mysql_charset . ';', $link, PMA_DBI_QUERY_STORE);
        }
        if (!empty($collation_connection)) {
            PMA_DBI_query('SET collation_connection = \'' . $collation_connection . '\';', $link, PMA_DBI_QUERY_STORE);
        }
        if (!$is_controluser) {
            $collation_connection = PMA_DBI_get_variable('collation_connection',     PMA_DBI_GETVAR_SESSION, $link);
            $charset_connection   = PMA_DBI_get_variable('character_set_connection', PMA_DBI_GETVAR_SESSION, $link);
        }

        // Add some field types to the list
        // (we pass twice here; feel free to code something better :)
        if (!defined('PMA_ADDED_FIELD_TYPES')) {
            $GLOBALS['cfg']['ColumnTypes'][] = 'BINARY';
            $GLOBALS['cfg']['ColumnTypes'][] = 'VARBINARY';
            define('PMA_ADDED_FIELD_TYPES',1);
        }

    } else {
        require_once('./libraries/charset_conversion.lib.php');
    }
}

?>
