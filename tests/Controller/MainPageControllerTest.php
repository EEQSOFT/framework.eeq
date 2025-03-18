<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

class MainPageControllerTest extends PantherTestCase
{
    public function testMainPageTitle(): void
    {
        $client = static::createPantherClient();
        $client->request('GET', '/');

        $this->assertPageTitleContains('PHP Framework from EEQSOFT');
    }
}
