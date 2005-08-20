<?php
/* $Id: grab_globals.lib.php,v 2.11 2005/03/03 20:59:24 rabus Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:


/**
 * This library grabs the names and values of the variables sent or posted to a
 * script in the $_* arrays and sets simple globals variables from them. It does
 * the same work for the $PHP_SELF, $HTTP_ACCEPT_LANGUAGE and
 * $HTTP_AUTHORIZATION variables.
 *
 * loic1 - 2001/25/11: use the new globals arrays defined with php 4.1+
 */

function PMA_gpc_extract($array, &$target, $sanitize = TRUE) {
    if (!is_array($array)) {
        return FALSE;
    }
    $is_magic_quotes = get_magic_quotes_gpc();
    foreach ($array AS $key => $value) {
        /**
         * 2005-02-22, rabus:
         *
         * This is just an ugly hotfix to avoid changing internal config
         * parameters.
         *
         * Currently, the following variable names are rejected when found in
         * $_GET or $_POST: cfg, GLOBALS, str* and _*
         */
        if ($sanitize && is_string($key) && (
            $key == 'cfg'
            || $key == 'GLOBALS'
            || substr($key, 0, 3) == 'str'
            || $key{0} == '_')) {
            continue;
        }

        if (is_array($value)) {
            // there could be a variable coming from a cookie of
            // another application, with the same name as this array
            unset($target[$key]);

            PMA_gpc_extract($value, $target[$key], FALSE);
        } else if ($is_magic_quotes) {
            $target[$key] = stripslashes($value);
        } else {
            $target[$key] = $value;
        }
    }
    return TRUE;
}

if (!empty($_GET)) {
    PMA_gpc_extract($_GET, $GLOBALS);
} // end if

if (!empty($_POST)) {
    PMA_gpc_extract($_POST, $GLOBALS);
} // end if

if (!empty($_FILES)) {
    foreach ($_FILES AS $name => $value) {
        $$name = $value['tmp_name'];
        ${$name . '_name'} = $value['name'];
    }
} // end if

if (!empty($_SERVER)) {
    $server_vars = array('PHP_SELF', 'HTTP_ACCEPT_LANGUAGE', 'HTTP_AUTHORIZATION');
    foreach ($server_vars as $current) {
        if (isset($_SERVER[$current])) {
            $$current = $_SERVER[$current];
        } elseif (!isset($$current)) {
            $$current = '';
        }
    }
    unset($server_vars, $current);
} // end if

// Security fix: disallow accessing serious server files via "?goto="
if (isset($goto) && strpos(' ' . $goto, '/') > 0 && substr($goto, 0, 2) != './') {
    unset($goto);
} // end if

?>
