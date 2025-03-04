<?php

use App\Core\AppException;

try {
    require(__DIR__ . '/../inc/public/index.php');
} catch (AppException $e) {
    echo $e->getMessage();

    exit;
}
