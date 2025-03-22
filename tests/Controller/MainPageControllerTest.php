<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Panther\PantherTestCase;

class MainPageControllerTest extends PantherTestCase
{
    public function testMainPageTitleAndForm(): void
    {
        $browser = new HttpBrowser(HttpClient::create());

        $browser->request('GET', '/');
        $response = $browser->getResponse();

        $this->assertStringContainsString(
            '<title>PHP Framework from EEQSOFT</title>',
            (string) $response
        );

        $browser->clickLink('Polish');
        $response = $browser->getResponse();

        $this->assertStringContainsString(
            '<title>PHP Framework od EEQSOFT</title>',
            (string) $response
        );

        $browser->clickLink('Angielski');
        $browser->submitForm('Confirm', ['name' => 'Robert']);
        $response = $browser->getResponse();

        $this->assertStringContainsString(
            'Welcome, Robert!',
            (string) $response
        );
    }
}
