<?php

declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';

require_once CORE_FILE;
require_once AUTOLOAD_FILE;

use App\Core\{Cache, Config, Manager};
use App\Repository\SettingsRepository;

$class = 'App\\Core\\' . DEFAULT_DATABASE_CLASS;

$config = new Config();
$db = new $class();
$rm = new Manager($db);
$cache = new Cache();

$settings = require SETTINGS_FILE;
$database = require DATABASE_FILE;

setcookie('cookie_login', '', 0, '/', $config->getServerName());

session_destroy();

if (!chmod(SETTINGS_FILE, octdec('666'))) {
    echo '<strong>Info!</strong> '
        . 'Change the permissions of the "config/settings.php" file to 666.';

    exit;
}

$db->connect();

$sr = $rm->getRepository(SettingsRepository::class);

$stmt = $db->prepare("SHOW TABLES LIKE 'settings'");
$ok = $db->execute();

foreach ($stmt as $array) {
    break;
}

if ($ok && !empty($array)) {
    $settingsData = $sr->getSettingsData();
} else {
    $settingsData = [];
}

if ($settings['app_installed']) {
    echo '<strong>Warning!</strong> The script database is already installed.';

    exit;
}

if (
    !empty($settingsData)
    && $settingsData['settings_installed']
    && version_compare(
        $settings['app_version'],
        $settingsData['settings_version'],
        '>'
    )
) {
    require UPDATE_DATA_FILE;

    $cache->cacheFile(
        SETTINGS_FILE,
        str_replace(
            "'app_installed' => false",
            "'app_installed' => true",
            file_get_contents(SETTINGS_FILE)
        )
    );

    if (!$settingsData['settings_registered']) {
        echo '<strong>Success!</strong> The script database has been updated.';

        exit;
    }

    $cache->cacheFile(
        SETTINGS_FILE,
        str_replace(
            "'app_registered' => false",
            "'app_registered' => true",
            file_get_contents(SETTINGS_FILE)
        )
    );

    echo '<strong>Success!</strong> The script database has been updated.';

    exit;
}

if (
    !empty($settingsData)
    && version_compare(
        $settings['app_version'],
        $settingsData['settings_version'],
        '<='
    )
) {
    echo '<strong>Danger!</strong> '
        . 'The script is equal to or older than the database.';

    exit;
}

require INSTALL_DATA_FILE;

$cache->cacheFile(
    SETTINGS_FILE,
    str_replace(
        "'app_installed' => false",
        "'app_installed' => true",
        file_get_contents(SETTINGS_FILE)
    )
);

echo '<strong>Success!</strong> The script database has been installed.';
