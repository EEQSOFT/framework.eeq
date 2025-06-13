<?php

session_start();

ini_set('register_globals', '0');
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('UTC');
set_time_limit(60);
ini_set('memory_limit', '1024M');
ini_set('post_max_size', '200M');
ini_set('upload_max_filesize', '100M');

const CONFIG_FILE = __DIR__ . '/config.php';
const DATABASE_FILE = __DIR__ . '/database.php';
const ACTIONS_FILE = __DIR__ . '/actions.php';
const REDIRECTS_FILE = __DIR__ . '/redirects.php';
const SETTINGS_FILE = __DIR__ . '/settings.php';
const ERROR_LOG_FILE = __DIR__ . '/../error.log';
const CORE_FILE = __DIR__ . '/../inc/core/core.php';
const AUTOLOAD_FILE = __DIR__ . '/../vendor/autoload.php';

const DEFAULT_DATABASE_CLASS = 'MyPDO';
const DEFAULT_DATABASE_NAME = 'mysql';

$lang = $_GET['lang'] ?? 'en';
$lang = ($lang !== '') ? $lang : 'en';
$lp = ($lang !== 'en') ? '/' . $lang : '';
