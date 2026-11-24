<?php

if (
    version_compare($settingsData['settings_version'], '0.1.0', '>=')
    && version_compare($settingsData['settings_version'], '1.0.0', '<')
) {
    if ($sr->setSettingsVersion('1.0.0')) {
        $settingsData['settings_version'] = '1.0.0';
    }
}
