# 0. 特别说明



**特别说明1: 这只是一个BPC编译wordpress的 可行性验证** .

当前的编译产物 wordpress-althttpd-ubuntu-18.04-amd64 只包含了wordpress 的主要功能,还有一些页面和功能尚未编译进去.

所以点击一些菜单或链接返回 **404** 页面是正常的.



**特别说明2: 只能在Ubuntu-18.04-amd64上运行**

可执行文件 wordpress-althttpd-ubuntu-18.04-amd64 是针对 **ubuntu-18.04-amd64** 编译的,在其它linux发行版上可能无法运行.



# 1. 安装 mysql-server

```shell
$ sudo apt install mysql-server
```



# 2. 创建数据库

```shell
$ sudo mysql

mysql> CREATE DATABASE `wordpress_bpc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
Query OK, 1 row affected (0.00 sec)

mysql> CREATE USER wpbpc@localhost IDENTIFIED BY 'wpbpcpass';
Query OK, 0 rows affected (0.00 sec)

mysql> GRANT ALL PRIVILEGES ON `wordpress_bpc`.* TO wpbpc@localhost;
Query OK, 0 rows affected (0.00 sec)

mysql> exit
Bye
```



# 3. 运行 wordpress-althttpd-ubuntu-18.04-amd64

```shell
$ mkdir /tmp/x
$ mv wordpress-althttpd-ubuntu-18.04-amd64 /tmp/x/
$ cd /tmp/x/
$ DB_NAME=wordpress_bpc DB_USER=wpbpc DB_PASSWORD=wpbpcpass WP_LANGUAGES=zh_CN WP_THEMES=twentytwentythree,twentytwentytwo,twentytwentyone ./wordpress-althttpd-ubuntu-18.04-amd64 -project-name wordpress -port 7878 -http-header X-WP-Nonce
```



# 4. 访问 http://localhost:7878/ 

