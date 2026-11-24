<?php

declare(strict_types=1);

namespace App\Repository;

use App\Core\Repository;

class SettingsRepository extends Repository
{
    public function setSettingsVersion(string $version): bool
    {
        $this->manager->prepare(
            'UPDATE `settings` s SET s.`settings_version` = :version'
        )
            ->setParameter('version', $version)
            ->getResult();

        return $this->manager->execute();
    }

    public function setSettingsRegistered(bool $registered): bool
    {
        $this->manager->prepare(
            'UPDATE `settings` s SET s.`settings_registered` = :registered'
        )
            ->setParameter('registered', (int) $registered)
            ->getResult();

        return $this->manager->execute();
    }

    public function getSettingsData(): array
    {
        $array = [];

        $stmt = $this->manager->prepare(
            'SELECT * FROM `settings`'
        )->getResult();

        $this->manager->execute();

        foreach ($stmt as $row) {
            $array['settings_version'] = $row['settings_version'];
            $array['settings_installed'] = (bool) $row['settings_installed'];
            $array['settings_registered'] = (bool) $row['settings_registered'];
        }

        return $array;
    }
}
