all:
	./bpc-prepare.sh
	$(MAKE) -C ./wordpress wordpress-althttpd
	mv ./wordpress/wordpress-althttpd .

wordpress-althttpd:
	bpc -v \
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
		--copt -Wno-trigraphs       \
		--pseudo-class-list IXR_Error \
		--input-file src.list

run:
	DB_NAME=wordpress DB_USER=rootpw DB_PASSWORD=123456 ./wordpress-althttpd -project-name wordpress -port 7878 -root /tmp/x
