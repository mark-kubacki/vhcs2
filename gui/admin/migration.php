<?php

include '../include/vhcs-lib.php';

check_login();

$query = <<<SQL_QUERY

update

domain

set

domain_status = 'toadd'


SQL_QUERY;

$rs = execute_query($sql, $query);
print "Domains updated";

  $query = <<<SQL_QUERY

        update

            domain_aliasses

        set

            alias_status = 'toadd'


SQL_QUERY;

$rs = execute_query($sql, $query);
print "Domain aliases updated";

  $query = <<<SQL_QUERY

        update

            subdomain

        set

            subdomain_status = 'toadd'


SQL_QUERY;

$rs = execute_query($sql, $query);
print "Subdomains updated";

 $query = <<<SQL_QUERY

        update

            mail_users

        set

             status = 'toadd'


SQL_QUERY;

$rs = execute_query($sql, $query);
print "Emails updated";		


?>