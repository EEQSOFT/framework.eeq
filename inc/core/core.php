<?php

if (!file_exists(dirname(__DIR__, 2) . '/translations/messages.' . $lang . '.php')) {
    $title = 'Information';
    $message = 'Unsupported language';

    require dirname(__DIR__, 2) . '/inc/public/info.php';

    exit;
}

require dirname(__DIR__, 2) . '/translations/languages.php';
require dirname(__DIR__, 2) . '/translations/languages.' . $lang . '.php';
require dirname(__DIR__, 2) . '/translations/messages.' . $lang . '.php';
require dirname(__DIR__, 2) . '/translations/validators.' . $lang . '.php';

require 'data.php';
