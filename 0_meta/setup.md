## Setup
1) Ensure Nginx is configured for patientportaltoolkit
- see [this file for instructions](https://github.com/maurya/openmrs-module-patientportaltoolkit/blob/master/0_meta/setup_nginx.md) if it is not

2) Ensure MySQL is installed
- `sudo apt-get install -y mysql-server` if it is not

3) Create database, upload SQL from backup, create user, give user all access to that database (designed that way in code)
- `mysql -u root -p`
    - `CREATE DATABASE <database>;`
    - `use <database>;`
    - `source /path/to/0_meta/sql/omrs_portal.sql`
    - `CREATE USER '<username>'@'localhost' IDENTIFIED BY '<password>';`
    - `GRANT ALL ON <database>.* TO <username>@localhost;`


4) Install PHP
- `sudo apt-get install -y php-fpm php-mysql`
- set `cgi.fix_pathinfo=0` in `sudo nano /etc/php/7.0/fpm/php.ini` 
    - this prevents php from 'fixing' mistyped pathnames and matching to nearest valid name.
    - prevents potential security problems such as documented [here] (https://nealpoole.com/blog/2011/04/setting-up-php-fastcgi-and-nginx-dont-trust-the-tutorials-check-your-configuration/)
- `sudo systemctl restart php7.0-fpm`
- Add Nginx to the www-data group
    - run `sudo usermod -a -G www-data nginx`
    - this gives nginx access to the listeners set in the php `sudo nano /etc/php/7.0/fpm/pool.d/www.conf` file.
        - lines `listen.owner = www-data` and `listen.group = www-data`
    - `sudo service nginx restart`

5) Modify server block to serve the symptom-management 'module'
- `sudo nano /etc/nginx/sites-available/personalcancertoolkit`
- ensure <domain>/symptom-management/ redirects to proper directory and PHP will be properly served
    - add `index.php` to `index` line
    - add following lines into the server block
    ```
       # Redirect symptom-management requests to proper path
       location /symptom-management {
                alias /var/www/symptom-management/public/;

                # Parse php files properly 
                location ~ \.php$ {
                   include snippets/fastcgi-php.conf;
                   #include fastcgi_params;
                   fastcgi_buffers 16 16k; 
                   fastcgi_buffer_size 32k;
                   fastcgi_param SCRIPT_FILENAME $request_filename;
                   fastcgi_pass unix:/run/php/php7.0-fpm.sock;
                }
      }

    ```
  
- `sudo service nginx restart`

6) Update SQL auth file
- `sudo nano /path/to/notpublic/auth/mysql_auth.php`
```
    <?php
    define(MYSQL_DATABASE_HOST, "localhost");
    define(MYSQL_USERNAME, "<username>");
    define(MYSQL_PASSWORD, "<password>");
    define(MYSQL_DATABASE, "<database>");
```


