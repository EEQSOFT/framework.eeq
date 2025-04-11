<?php

declare(strict_types=1);

namespace App\Tests\Browser;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Panther\PantherTestCase;

class MainPageBrowserTest extends PantherTestCase
{
    protected readonly HttpBrowser $browser;

    public function setUp(): void
    {
        $this->browser = new HttpBrowser(HttpClient::create());
    }

    public function testMainPageStatusCode(): void
    {
        $this->browser->request('GET', '/');
        $response = $this->browser->getResponse();
        $statusCode = $response->getStatusCode();

        $this->assertEquals(200, $statusCode);

        $this->browser->request('GET', '/pl/');
        $response = $this->browser->getResponse();
        $statusCode = $response->getStatusCode();

        $this->assertEquals(200, $statusCode);
    }

    public function testMainPageTitle(): void
    {
        $this->browser->request('GET', '/');
        $response = $this->browser->getResponse();

        $this->assertStringContainsString(
            '<title>PHP Framework from EEQSOFT</title>',
            (string) $response
        );

        $this->browser->request('GET', '/pl/');
        $response = $this->browser->getResponse();

        $this->assertStringContainsString(
            '<title>PHP Framework od EEQSOFT</title>',
            (string) $response
        );
    }

    public function testMainPageForm(): void
    {
        $this->browser->request('GET', '/');
        $this->browser->submitForm('Confirm', ['name' => 'ADMIN']);
        $response = $this->browser->getResponse();

        $this->assertStringContainsString(
            'Welcome, Admin!',
            (string) $response
        );

        $this->browser->clickLink('Polish');
        $this->browser->submitForm('Potwierdź', ['name' => 'USER']);
        $response = $this->browser->getResponse();

        $this->assertStringContainsString(
            'Witamy, User!',
            (string) $response
        );
    }
}
