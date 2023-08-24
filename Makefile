BPC_BIN = bpc

libwordpress.so:
	./bpc-prepare.sh src.list
	$(MAKE) -C ./wordpress libwordpress

libwordpress:
	$(BPC_BIN) -v \
		-c bpc.conf  \
		-l wordpress \
		--pseudo-class-list WP_HTTP_IXR_Client,IXR_Error,WP_Customize_Manager,WP_Customize_Panel,getID3,WP_Filesystem_Base,SimplePie,WP_SimplePie_Sanitize_KSES,SimplePie_Cache,WP_Press_This_Plugin \
		--copt -Wno-trigraphs \
		--input-file src.list

install-libwordpress:
	cd wordpress && $(BPC_BIN) -l wordpress --install

wordpress-althttpd:
	$(BPC_BIN) -v $(STATIC_LINK) \
		--althttpd              \
		-o wordpress-althttpd   \
		-c bpc.conf             \
		-d max_execution_time=60                    \
		-d upload_max_filesize=80M                  \
		-d post_max_size=100M                       \
		-d memory_limit=1024M                       \
		-d display_errors=on                        \
		-d log_errors=on                            \
		-d date.timezone=Asia/Shanghai              \
		-u wordpress $(USE_LIBWORDPRESSTMP) \
		-u wordpressres \
		index.php

wordpress-althttpd-static:
	STATIC_LINK="--static" make wordpress-althttpd

run:
	rm -rf /tmp/wordpress
	mkdir /tmp/wordpress
	mkdir /tmp/wordpress/wp-includes
	mkdir /tmp/wordpress/wp-includes/images
	mkdir /tmp/wordpress/wp-content
	cp wordpress-althttpd /tmp/wordpress/
	cp -r wp-includes/certificates /tmp/wordpress/wp-includes/
	cp -r wp-includes/images/media /tmp/wordpress/wp-includes/images/
	cp start.sh /tmp/wordpress/
	/tmp/wordpress/start.sh

libwordpresstmp.so:
	./bpc-prepare.sh src-tmp.list
	$(MAKE) -C ./wordpress libwordpresstmp

libwordpresstmp:
	$(BPC_BIN) -v \
		-c bpc.conf \
		-l wordpresstmp \
		-u wordpress    \
		--copt -Wno-trigraphs \
		--input-file src-tmp.list

install-libwordpresstmp:
	cd wordpress && $(BPC_BIN) -l wordpresstmp --install

wordpress-althttpd-tmp:
	USE_LIBWORDPRESSTMP="-u wordpresstmp" make wordpress-althttpd

libwordpressres.so:
	$(BPC_BIN) -v \
		-c bpc.conf \
		-l wordpressres \
		--copt -Wno-trigraphs \
		--input-file src-res.list

install-libwordpressres:
	$(BPC_BIN) -l wordpressres --install
