#!/bin/bash
# Invokes analyzation of all available webserver logfiles
#         via awstats
#         if corresponding configuration file exists
# by W-Mark Kubacki; wmark@hurrikane.de

PIDFILE="/var/run/awstats_analyzing.pid" # PID-File
HOMEDIR="/var/www"
AWSTATSDIR="/var/www/web0/html/cgi-bin/awstats"
########################
echo $$ > $PIDFILE;
      for HOME in $HOMEDIR/* ; do
        USER=${HOME##$HOMEDIR/}
        if test "$USER" != "*"; then
          if test -e /etc/awstats/awstats.$USER.conf ; then
	    $AWSTATSDIR/awstats.pl -config=$USER -update
          fi
        fi
      done
rm $PIDFILE;

# additionally
$AWSTATSDIR/awstats.pl -config=ftp -update
