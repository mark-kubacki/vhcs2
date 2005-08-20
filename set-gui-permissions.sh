#!/bin/bash

#
# VHCS gui permissions setter v0.01;
#

for i in `find /var/www/vhcs2/gui/`; do 

	if [[ -f $i ]]; then
	
		echo -e "\t0400 www-data:www-data $i";
		
		chmod 0400 $i;
		chown www-data:www-data $i;	
		
	elif [[ -d $i ]]; then
	
		echo "0555 www-data:www-data [$i]";
		
		chmod 0555 $i;
		chown www-data:www-data $i;
	fi

done

#
# fixing webmail's database permissions;
#

i='/var/www/vhcs2/gui/tools/webmail/database'

echo "0555 www-data:www-data [$i]";

chmod 0755 $i;
#chmod 0755 "$i/*";
chown -R www-data:www-data $i;

i='/var/www/vhcs2/gui/themes/user_logos'

echo "0755 www-data:www-data [$i]";

chmod 0755 $i;
chmod 0644 "$i/*";
chown -R www-data:www-data $i;

i='/var/www/vhcs2/gui/tools/webmail/database/_sessions'

echo "0755 www-data:www-data [$i]";

chmod 0755 $i;
chown -R www-data:www-data $i;

chmod 0400 /var/www/vhcs2/gui/include/vhcs2-db-keys.php                                               