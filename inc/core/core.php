<?php

require('error.php');
require('data.php');

if (!file_exists(__DIR__ . '/../../translations/messages.' . $lang . '.php')) {
    $title = 'Information';
    $message = 'Unsupported language';

    require(__DIR__ . '/../../inc/public/info.php');

    exit;
}

require(__DIR__ . '/../../translations/languages.php');
require(__DIR__ . '/../../translations/languages.' . $lang . '.php');
require(__DIR__ . '/../../translations/messages.' . $lang . '.php');
require(__DIR__ . '/../../translations/validators.' . $lang . '.php');
