<?php

declare(strict_types=1);

use App\Core\AppException;

try {
    require(__DIR__ . '/../inc/public/index.php');
} catch (AppException $e) {
    $title = 'Exception';
    $message = $e->getMessage();

    require(__DIR__ . '/../inc/public/info.php');
}
