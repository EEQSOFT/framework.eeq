<?php

declare(strict_types=1);

require(__DIR__ . '/../config/config.php');
require(__DIR__ . '/../inc/core/core.php');
require(__DIR__ . '/../vendor/autoload.php');

use App\Core\{AppException, ErrorHandler};

new ErrorHandler();

try {
    require(__DIR__ . '/../inc/public/index.php');
} catch (AppException $e) {
    $title = 'Exception';
    $message = $e->getMessage();

    require(__DIR__ . '/../inc/public/info.php');
}
