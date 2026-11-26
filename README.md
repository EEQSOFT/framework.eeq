# EEQ Framework

A lightweight, high-performance PHP framework built on Service-Oriented Architecture (SOA) for creating fast web applications and REST APIs. 

Inspired by Symfony's clean directory structure and repository pattern, **EEQ Framework** eliminates heavy boilerplate and unnecessary "magic" while keeping a familiar developer experience.

## Key Features

* **Ultra-lightweight & Fast:** Minimal overhead designed for speed.
* **Service-Oriented Architecture (SOA):** Clean separation of business logic.
* **Symfony-inspired Structure:** Zero learning curve for developers familiar with Symfony (`src/`, `config/`, `templates/`, `tests/`).
* **Docker & PHPUnit Ready:** Out-of-the-box container setup and testing environment.
* **Full Documentation:** Check the included `documentation.html` file (or visit [https://www.eeqsoft.com](https://www.eeqsoft.com)) for complete guides.

## Code Example (SOA in practice)

**EEQ Framework** enforces a clean separation of concerns using Controllers, Validators, Services, and Repositories. Below is a real-world example of handling a request with built-in CSRF protection and modern PHP 8.4+ syntax:

### 1. Controller (`src/Controller/MainPageController.php`)

The controller stays thin. It initializes dependencies and delegates business logic to the service layer.

```php
<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Controller;
use App\Service\MainPageService;
use App\Validator\MainPageValidator;

class MainPageController extends Controller
{
    public function mainPageAction(array \$request): array
    {
        mainPageValidator = new MainPageValidator(this->csrfToken);

        \$mainPageService = new MainPageService(
            \(this->getManager(),\)this->html,
            \(this->csrfToken,\)mainPageValidator
        );

        return \$mainPageService->mainPageAction(
            (string) (\$request['lang'] ?? ''),
            (string) (\$request['name'] ?? ''),
            (bool) (\$request['submit'] ?? false),
            (string) (\$request['token'] ?? '')
        );
    }
}
```

### 2. Service (`src/Service/MainPageService.php`)

The service handles validation, interacts with the database via repositories, and prepares data for the view.

```php
<?php

declare(strict_types=1);

namespace App\Service;

use App\Core\{CsrfToken, Html, Manager};
use App\Repository\UserRepository;
use App\Validator\MainPageValidator;

class MainPageService
{
    public function __construct(
        protected readonly Manager \$rm,
        protected readonly Html \$html,
        protected readonly CsrfToken \$csrfToken,
        protected readonly MainPageValidator \$mainPageValidator
    ) {}

    public function mainPageAction(
        string \$lang,
        string \$name,
        bool \$submit,
        string \$token
    ): array {
        ur = this->rm->getRepository(UserRepository::class);

        if (\(submit) {\)this->mainPageValidator->validate([name, token]);

            if (\(this->mainPageValidator->isValid()) {\)userData = ur->getCookieLoginUserData(name, '');

                return [
                    'content' => 'main_page/name_info.php',
                    'active_menu' => 'main_page',
                    'title' => PAGE_INFO_TITLE,
                    'language' => LANGUAGE_NAME[LANGUAGE_ID[\$lang]],
                    'name' => \(userData['user_login'] ?? \)name
                ];
            }
        }

        return [
            'content' => 'main_page/main_page.php',
            'active_menu' => 'main_page',
            'title' => PAGE_MAIN_PAGE_TITLE,
            'desc' => WEBSITE_DESC,
            'keywords' => WEBSITE_KEYWORDS,
            'error' => \(this->html->prepareError(\)this->mainPageValidator->getError()
            ),
            'name' => \$name,
            'token' => \$this->csrfToken->generateToken()
        ];
    }
}
```

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

Change the permissions of the "settings.php" file to 644 (www-data:www-data):

```
<path to project>/config/settings.php
```

### 5. Install the application by running the "install.php" file

Open the url below in your browser:

```
https://<domain.com>/install.php
```

### 6. Open this web application in your browser

Open the url below in your browser:

```
https://<domain.com>
```

## Docker Desktop

### 1. Go to the application directory

```
cd <path to project>
```

### 2. Start the application stack defined in "docker-compose.yml"

```
docker-compose up -d
```

### 3. Set the permissions and access for the "fwe-php-apache" container

```
docker exec -it fwe-php-apache bash
cd /var/www
ls -l
chmod 755 /var/www/html
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

### 1. Install the needed dependencies from the "composer.json" file

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

Copyright (c) 2024-2026 EEQSOFT

https://www.eeqsoft.com
