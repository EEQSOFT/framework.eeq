<?php

declare(strict_types=1);

namespace App\Tests\Repository;

use App\Core\{Database, Manager};
use App\Repository\SettingsRepository;
use PHPUnit\Framework\TestCase;

class SettingsRepositoryTest extends TestCase
{
    protected readonly array $settings;
    protected readonly Database $db;
    protected readonly Manager $rm;
    protected readonly SettingsRepository $sr;

    public function setUp(): void
    {
        $this->settings = require SETTINGS_FILE;
        $class = 'App\\Core\\' . DEFAULT_DATABASE_CLASS;

        $this->db = new $class();
        $this->rm = new Manager($this->db);
        $this->sr = $this->rm->getRepository(SettingsRepository::class);

        $this->db->connect();
    }

    public function testSetSettingsVersionMethod(): void
    {
        $svSet = $this->sr->setSettingsVersion($this->settings['app_version']);

        $this->assertTrue($svSet);
    }

    public function testSetSettingsRegisteredMethod(): void
    {
        $srSet = $this->sr->setSettingsRegistered(
            $this->settings['app_registered']
        );

        $this->assertTrue($srSet);
    }

    public function testGetSettingsDataMethod(): void
    {
        $sd = $this->sr->getSettingsData();

        $this->assertEquals(
            $this->settings['app_version'],
            $sd['settings_version']
        );

        $this->assertEquals(
            $this->settings['app_installed'],
            $sd['settings_installed']
        );

        $this->assertEquals(
            $this->settings['app_registered'],
            $sd['settings_registered']
        );
    }
}
