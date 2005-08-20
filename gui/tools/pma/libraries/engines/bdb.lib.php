<?php
/* $Id: bdb.lib.php,v 2.0 2005/03/05 13:24:28 rabus Exp $ */
// vim: expandtab sw=4 ts=4 sts=4:

class PMA_StorageEngine_bdb extends PMA_StorageEngine {
    function getVariables () {
        return array(
            'version_bdb' => array(
                'title' => $GLOBALS['strVersionInformation']
            )
        );
    }
    function getVariablesLikePattern() {
        return 'version_bdb';
    }
}

?>
