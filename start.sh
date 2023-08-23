#!/bin/bash

CURDIR=`dirname $0`
cd $CURDIR

DB_NAME=wordpress_bpc DB_USER=rootpw DB_PASSWORD=123456 WP_THEMES=twentytwentythree ./wordpress-althttpd -project-name wordpress -port 7878 -http-header X-WP-Nonce
