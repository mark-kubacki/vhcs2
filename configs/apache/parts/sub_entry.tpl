<VirtualHost {SUB_NAME}>

    #
    #User {SUEXEC_USER}
    #Group {SUEXEC_GROUP}
    #
    
    #
    #SuexecUserGroup {SUEXEC_USER} {SUEXEC_GROUP}
    #

    ServerAdmin     root@{DMN_NAME}
    DocumentRoot    {WWW_DIR}/{DMN_NAME}{MOUNT_POINT}/htdocs
    
    ServerName      {SUB_NAME}
    ServerAlias     www.{SUB_NAME} {SUB_NAME}
    
    ErrorLog        {APACHE_USERS_LOG_DIR}/{SUB_NAME}-error.log
    TransferLog     {APACHE_USERS_LOG_DIR}/{SUB_NAME}-access.log
    
    CustomLog       {APACHE_LOG_DIR}/{DMN_NAME}-traf.log traff
    CustomLog       {APACHE_LOG_DIR}/{DMN_NAME}-combined.log combined

    # httpd sub entry cgi support BEGIN.
    # httpd sub entry cgi support END.

    <Directory {GUI_ROOT_DIR}>
        php_admin_value open_basedir "{GUI_ROOT_DIR}/:/etc/vhcs2/:/proc/:{WWW_DIR}/:/tmp/"
    </Directory>

    # httpd sub entry PHP2 support BEGIN.
    # httpd sub entry PHP2 support END.
    
    <Directory {WWW_DIR}/{DMN_NAME}{MOUNT_POINT}/htdocs>
        # httpd sub entry PHP support BEGIN.
        # httpd sub entry PHP support END.
        Options Indexes Includes FollowSymLinks MultiViews
        AllowOverride AuthConfig
        Order allow,deny
        Allow from all
    </Directory>
    
</VirtualHost>
