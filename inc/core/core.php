<?php

if (!file_exists(__DIR__ . '/../../translations/messages.' . $lang . '.php')) {
    echo 'Unsupported language';

    exit;
}

require(__DIR__ . '/../../translations/languages.php');
require(__DIR__ . '/../../translations/languages.' . $lang . '.php');
require(__DIR__ . '/../../translations/messages.' . $lang . '.php');
require(__DIR__ . '/../../translations/validators.' . $lang . '.php');

require('data.php');
