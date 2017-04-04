## Setup:
1) Ensure Nginx and MySQL are installed
- `sudo apt-get update`
- `sudo apt-get install nginx`
- `sudo apt-get install mysql-server`
or
- `sudo apt-get update && sudo apt-get install -y nginx && sudo apt-get install -y mysql-server`


2) Create database, upload SQL from backup, create user, give user all access to that database (designed that way in code)
- `mysql -u root -p`
    - `CREATE DATABASE <database>;`
    - `use <database>;`
    - `source /path/to/0_meta/SQL/omrs_portal.sql`
    - `CREATE USER '<username>'@'localhost' IDENTIFIED BY '<password>';`
    - `GRANT ALL ON <database>.* TO <username>@localhost;`


2) Install PHP
- `sudo apt-get install -y php-fpm php-mysql`
- set `cgi.fix_pathinfo=0` in `sudo nano /etc/php/7.0/fpm/php.ini`
- `sudo systemctl restart php7.0-fpm`


3) Ensure Nginx can serve PHP
- `sudo nano /etc/nginx/sites-available/default`
- add `index.php` to `index` line
- add following lines into defaults, which specify to parse the php
```
    location ~ \.php$ {                
        include snippets/fastcgi-php.conf;

        # With php7.0-cgi alone:
        fastcgi_pass 127.0.0.1:9000;
        # With php7.0-fpm:
        fastcgi_pass unix:/run/php/php7.0-fpm.sock;
    }
```

4) Update SQL auth file
- `sudo nano /path/to/notpublic/auth/mysql_auth.php`
```
    <?php
    define(MYSQL_DATABASE_HOST, "localhost");
    define(MYSQL_USERNAME, "<username>");
    define(MYSQL_PASSWORD, "<password>");
    define(MYSQL_DATABASE, "<database>");
```


