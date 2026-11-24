<?php

declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';

require CORE_FILE;
require AUTOLOAD_FILE;

use App\Core\{AppException, ErrorHandler};

new ErrorHandler();

try {
    require INDEX_FILE;
} catch (AppException $e) {
    $title = 'Exception';
    $message = $e->getMessage();

    require INFO_FILE;
}
