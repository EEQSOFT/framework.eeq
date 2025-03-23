<?php

declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/inc/core/core.php';
require dirname(__DIR__) . '/vendor/autoload.php';

use App\Core\{AppException, ErrorHandler};

new ErrorHandler();

try {
    require dirname(__DIR__) . '/inc/public/index.php';
} catch (AppException $e) {
    $title = 'Exception';
    $message = $e->getMessage();

    require dirname(__DIR__) . '/inc/public/info.php';
}
