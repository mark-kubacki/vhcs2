
SYSTEM_ENGINE_ROOT=$(SYSTEM_ROOT)/engine

CMD_CHOWN=/bin/chown

export

install:

	$(SYSTEM_MAKE_DIRS) $(INST_PREF)/usr/sbin
	cp  ./pflogsumm-1.1.0/pflogsumm.pl $(INST_PREF)/usr/sbin
	cp  ./maillogconvert/maillogconvert.pl $(INST_PREF)/usr/sbin
        
uninstall:

	rm -rf $(INST_PREF)/usr/sbin/pflogsumm.pl
