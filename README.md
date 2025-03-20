# PHP Framework from EEQSOFT

## Setup/Installation

### 1. Set the root directory of the php files to "public"

Set the path for your hosting:

```
<path to project>/public
```

### 2. Create a database with full user permissions

Use the database name as in your config:

```
for example: "framework"
```

### 3. Change the settings in the "database.php" file

Set as in the "database.php.dist" file (check "config"):

```
'db_host' => 'localhost'
'db_port' => 3306
'db_user' => '<user>'
'db_password' => '<password>'
'db_database' => 'framework'
```

### 4. If necessary, set these permissions

Change the permissions of the "settings.php" file to 666:

```
<path to project>/config/settings.php
```

### 5. Open this web application in your browser

Open the url below in your browser:

```
https://<domain.com>
```

## Docker Desktop

### 1. Go to the application directory

```
cd <path to project>
```

### 2. Start the application stack defined in docker-compose.yml

```
docker-compose up -d
```

### 3. Set the permissions and access for the fwe-php-apache container

```
docker exec -it fwe-php-apache bash
cd /var/www
ls -l
chmod 777 /var/www/html
chown -R www-data:www-data /var/www/html
ls -l
exit
```

### 4. Open this web application and/or phpMyAdmin in your browser

```
http://localhost:8000
http://localhost:8001
```

### 5. Stop the application stack

```
docker-compose down
```

## Composer

### 1. Install the needed dependencies from the composer.json file

```
docker exec -it fwe-php-apache bash
cd /var/www/html
composer install
```

## Tests

### 1. Run the PHPUnit tests

```
docker exec -it fwe-php-apache vendor/bin/phpunit tests
```

## Information

Copyright (c) 2024 EEQSOFT

https://phpframework.eeqsoft.com
