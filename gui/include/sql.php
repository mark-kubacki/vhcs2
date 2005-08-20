<?php
//   -------------------------------------------------------------------------------
//  |             VHCS(tm) - Virtual Hosting Control System                         |
//  |              Copyright (c) 2001-2004 be moleSoftware                    |
//  |     http://vhcs.net | http://www.molesoftware.com                 |
//  |                                                                               |
//  | This program is free software; you can redistribute it and/or                 |
//  | modify it under the terms of the MPL General Public License                   |
//  | as published by the Free Software Foundation; either version 1.1              |
//  | of the License, or (at your option) any later version.                        |
//  |                                                                               |
//  | You should have received a copy of the MPL Mozilla Public License             |
//  | along with this program; if not, write to the Open Source Initiative (OSI)    |
//  | http://opensource.org | osi@opensource.org                    |
//  |                                                                               |
//   -------------------------------------------------------------------------------


global $include_path;
$include_path = '/var/www/vhcs2/gui/include/';
include ($include_path.'adodb/adodb.inc.php');
//include 'adodb/tohtml.inc.php';
include ($include_path.'adodb/adodb-pager.inc.php');

if ($cfg['DB_TYPE'] === 'pgsql') {
  $sql = &ADONewConnection('postgres7');

} else if ($cfg['DB_TYPE'] === 'mysql') {
  $sql = &ADONewConnection('mysql');
}

if (!$sql -> Connect($cfg['DB_HOST'], $cfg['DB_USER'], $cfg['DB_PASS'], $cfg['DB_NAME'])) {
  system_message('Unable To Connect SQL Server!');
}

function execute_query (&$sql, $query) {
  $rs = $sql -> Execute($query);
  if (!$rs) system_message($sql -> ErrorMsg());
  return $rs;
}

function exec_query(&$sql, $query, $data) {
  $stmt = $sql->Prepare($query);
  $rs = $sql->Execute($query, $data);
  if (!$rs) system_message($sql->ErrorMsg());
  return $rs;
}

function quoteIdentifier($identifier)
{
  global $cfg;

  switch ($cfg['DB_TYPE']) {
    case 'pgsql':
      return '"' . $identifier . '"';
    case 'mysql':
      return '`' . $identifier . '`';
    default: // is there a standard?
      return $identifier;
  }
}

function pg_get_record_id(&$sql, $table, $oid) {

  $query = "select id from $table where oid = '$oid'";

  $rs = execute_query($sql, $query);

  return $rs -> fields['id'];

}

?>
