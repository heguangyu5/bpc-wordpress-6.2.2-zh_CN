BPC_BIN = bpc_s

libwordpress.so:
	./bpc-prepare.sh src.list
	$(MAKE) -C ./wordpress libwordpress

libwordpress:
	$(BPC_BIN) -v \
		-c bpc.conf  \
		-l wordpress \
		--pseudo-class-list WP_HTTP_IXR_Client,IXR_Error,WP_Customize_Manager,WP_Customize_Panel,getID3,WP_Filesystem_Base,SimplePie,WP_SimplePie_Sanitize_KSES,SimplePie_Cache,WP_Press_This_Plugin \
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
		-d memory_limit=512M                        \
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
	mkdir /tmp/wordpress/wp-content
	cp wordpress-althttpd /tmp/wordpress
	cp -r wp-includes/certificates /tmp/wordpress/wp-includes/
	cp -r wp-content/languages /tmp/wordpress/wp-content/
	DB_NAME=wordpress_bpc DB_USER=rootpw DB_PASSWORD=123456 /tmp/wordpress/wordpress-althttpd -project-name wordpress -port 7878 -root /tmp/wordpress

libwordpresstmp.so:
	./bpc-prepare.sh src-tmp.list
	$(MAKE) -C ./wordpress libwordpresstmp

libwordpresstmp:
	$(BPC_BIN) -v \
		-c bpc.conf \
		-l wordpresstmp \
		-u wordpress    \
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
