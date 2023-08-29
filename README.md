# 特别说明

**这只是一个BPC编译wordpress的 可行性验证** .

当前的编译产物 wordpress-althttpd 只包含了wordpress 的主要功能,还有一些页面和功能尚未编译进去.

所以点击一些菜单或链接返回 **404** 页面是正常的.


# Ubuntu 18.04 / 20.04 / 22.04

### 1. 安装 mysql-server

```shell
sudo apt install mysql-server
```

### 2. 创建数据库和用户

```sql
CREATE DATABASE wordpress_bpc DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE USER wpbpc@localhost IDENTIFIED BY 'wpbpcpass';
GRANT ALL PRIVILEGES ON wordpress_bpc.* TO wpbpc@localhost;
```

### 3. 运行 wordpress-althttpd-ubuntu-XX.04-amd64

```shell
mkdir /tmp/x
mv wordpress-althttpd /tmp/x/
cd /tmp/x/
DB_NAME=wordpress_bpc DB_USER=wpbpc DB_PASSWORD=wpbpcpass WP_LANGUAGES=zh_CN WP_THEMES=twentytwentythree,twentytwentytwo,twentytwentyone ./wordpress-althttpd-ubuntu-XX.04-amd64 -project-name wordpress -port 7878 -http-header X-WP-Nonce
```

### 4. 访问 http://localhost:7878/ 

# Debian 12

### 1. 安装缺失类库

```shell
apt install libglib2.0-0 libcurl4
```

### 2. 安装 mariadb-server

```shell
apt install mariadb-server
```

### 3. 创建数据库和用户

同上

### 4. 运行 wordpress-althttpd-ubuntu-22.04-amd64

同上

### 5. 访问 http://localhost:7878/