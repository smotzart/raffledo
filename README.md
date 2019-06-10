# RAFFLEDO

Raffledo develop on Phalcon PHP framework (https://phalconphp.com/en/)

## Getting Started

These instructions will get you a copy of the project up and running on your server.

### Enviroments

* Ubuntu 16.04
* NGINX
* PHP 7.0 and above
* MySQL
* Git
* Certbot
* Phalcon
* Phalcon Dev Tools

### Installing

A step by step series of examples that tell you how to get a development env running

#### NGINX

```
sudo apt-get install nginx
```

#### PHP

```
sudo apt-get install php7.0 php7.0-fpm php7.0-mysql php7.0-intl php7.0-mbstring
```

#### Git

```
sudo apt-get update
sudo apt-get install git-core
```

Set git config information
```
git config --global user.name "username" 
git config --global user.email "email@example.com"

```

#### MySQL

```
sudo apt-get update
sudo apt-get install mysql-server
mysql_secure_installation
```

#### Phalcon

```
curl -s https://packagecloud.io/install/repositories/phalcon/stable/script.deb.sh | sudo bash
sudo apt-get install php7.0-phalcon
```

Dev Tools
```
git clone git://github.com/phalcon/phalcon-devtools.git
cd phalcon-devtools/
. ./phalcon.sh
```

#### Certbot

```
sudo apt-get update
sudo apt-get install software-properties-common
sudo add-apt-repository universe
sudo add-apt-repository ppa:certbot/certbot
sudo apt-get update
sudo apt-get install certbot python-certbot-nginx 
```

## Deployment

Clone source files from repository
```
cd /var/www
git clone https://github.com/fetzcc/raffledo.git
```

Create databse, user and import from file. Change password to your own.
```
mysql -u root -p
CREATE USER 'raffledo'@'localhost' IDENTIFIED BY 'password'; 
GRANT ALL PRIVILEGES ON * . * TO 'raffledo'@'localhost';
FLUSH PRIVILEGES;
CREATE DATABASE raffledo;
USE raffledo;
SOURCE /var/www/raffledo/public/phalcon_prod.sql; 
```

Change application config file
```
cd /var/www/raffledo/app/config
```
Edit config.local.php and rename to config.php

### NGINX

Create new block for NGINX
```
cd /etc/nginx/sites-available
touch raffledo.de
```
Put content below and save
```
server {
    # Port 80 will require Nginx to be started with root permissions
    # Depending on how you install Nginx to use port 80 you will need
    # to start the server with `sudo` ports about 1000 do not require
    # root privileges
    # listen      80;

    listen        80;
    server_name   raffledo.de www.raffledo.de;
    rewrite ^(.*) https://www.raffledo.de permanent;
}
server {
    listen 443 ssl;
    server_name raffledo.de;
    ssl_certificate        /etc/letsencrypt/live/raffledo.de/fullchain.pem;
    ssl_certificate_key    /etc/letsencrypt/live/raffledo.de/privkey.pem;
    rewrite ^(.*) https://www.raffledo.de permanent;
}
server {
    listen 443 http2;
    server_name www.raffledo.de;
    ssl on;
    ssl_session_timeout  5m;
    ssl_protocols  SSLv2 SSLv3 TLSv1;
    ssl_ciphers  ALL:!ADH:!EXPORT56:RC4+RSA:+HIGH:+MEDIUM:+LOW:+SSLv2:+EXP;
    ssl_prefer_server_ciphers   on;

    # These locations depend on where you store your certs
    ssl_certificate        /etc/letsencrypt/live/raffledo.de/fullchain.pem;
    ssl_certificate_key    /etc/letsencrypt/live/raffledo.de/privkey.pem;
    ##########################

    # This is the folder that index.php is in
    root /var/www/raffledo/public;
    index index.php index.html index.htm; 

    charset utf-8;
    client_max_body_size 100M;
    fastcgi_read_timeout 1800;

    # Represents the root of the domain
    # http://localhost:8000/[index.php]
    location / {
        # Matches URLS `$_GET['_url']`
        try_files $uri $uri/ /index.php?_url=$uri&$args;
    }

    # When the HTTP request does not match the above
    # and the file ends in .php
    location ~ [^/]\.php(/|$) {
        # try_files $uri =404;

        # Ubuntu and PHP7.0-fpm in socket mode
        # This path is dependent on the version of PHP install
        fastcgi_pass  unix:/var/run/php/php7.0-fpm.sock;


        # Alternatively you use PHP-FPM in TCP mode (Required on Windows)
        # You will need to configure FPM to listen on a standard port
        # https://www.nginx.com/resources/wiki/start/topics/examples/phpfastcgionwindows/
        # fastcgi_pass  127.0.0.1:9000;

        fastcgi_index /index.php;

        include fastcgi_params;
        fastcgi_split_path_info ^(.+?\.php)(/.*)$;
        if (!-f $document_root$fastcgi_script_name) {
            return 404;
             }

        fastcgi_param PATH_INFO       $fastcgi_path_info;
        # fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
        # and set php.ini cgi.fix_pathinfo=0

        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }

    location ~* \.(js|css|png|jpg|jpeg|gif|ico)$ {
        expires       max;
        log_not_found off;
        access_log    off;
    }
}   
```
Create symlink to enable blocks
```
sudo ln -s /etc/nginx/sites-available/raffledo.de /etc/nginx/sites-enabled/ 
```

### Generate SSL certificate

```
sudo certbot --nginx certonly
```

Force renew
```
sudo certbot renew --dry-run
```

Restart NGINX
```
sudo service nginx restart
```

## Authors

* **Serhii Kotsar**

