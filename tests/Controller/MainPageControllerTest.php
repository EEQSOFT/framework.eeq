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

        preg_match(
            '/<title>(PHP Framework from EEQSOFT)<\/title>/',
            (string) $response,
            $matches
        );

        $this->assertEquals($matches[1], 'PHP Framework from EEQSOFT');

        $browser->clickLink('Polish');
        $response = $browser->getResponse();

        preg_match(
            '/<title>(PHP Framework od EEQSOFT)<\/title>/',
            (string) $response,
            $matches
        );

        $this->assertEquals($matches[1], 'PHP Framework od EEQSOFT');

        $browser->clickLink('Angielski');
        $browser->submitForm('Confirm', ['name' => 'Robert']);
        $response = $browser->getResponse();

        preg_match(
            '/(Welcome, Robert!)/',
            (string) $response,
            $matches
        );

        $this->assertEquals($matches[1], 'Welcome, Robert!');
    }
}
