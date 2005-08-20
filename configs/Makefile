
export 

install:

	if [[ $(HOST_OS) == debian ]] ; then \
		cp ./vhcs2.conf $(SYSTEM_CONF) ; \
		cd ./apache && $(MAKE) install ; cd .. ; \
		cd ./bind && $(MAKE) install ; cd .. ; \
		cd ./crontab && $(MAKE) install ; cd .. ; \
		cd ./database && $(MAKE) install ; cd .. ;  \
		cd ./init.d && $(MAKE) install ; cd .. ; \
		cd ./postfix && $(MAKE) install ; cd .. ; \
		cd ./courier && $(MAKE) install ; cd .. ; \
		cd ./proftpd && $(MAKE) install ; cd .. ; \
	fi
   
#	elif [[ $(HOST_OS) == redhat ]] ; then \
#		cd ./dists/redhat && $(MAKE) install ; \
#	fi

uninstall:

	if [[ $(HOST_OS) == debian ]] ; then \
		rm -rf $(SYSTEM_CONF)/vhcs2.conf ;  \
		cd ./apache && $(MAKE) uninstall ; cd .. ; \
		cd ./bind && $(MAKE) uninstall ; cd .. ; \
		cd ./crontab && $(MAKE) uninstall ; cd .. ; \
		cd ./database && $(MAKE) uninstall ; cd .. ;  \
		cd ./init.d && $(MAKE) uninstall ; cd .. ; \
		cd ./postfix && $(MAKE) uninstall ; cd .. ; \
		cd ./courier && $(MAKE) uninstall ; cd .. ; \
		cd ./proftpd && $(MAKE) uninstall ; cd .. ; \
	fi
   
#	elif [[ $(HOST_OS) == redhat ]] ; then \
#		cd ./dists/redhat && $(MAKE) uninstall ; \
#	fi 

