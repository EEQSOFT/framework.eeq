<?php

declare(strict_types=1);

namespace App\Core;

class CsrfToken
{
    public function generateToken(string $name = 'csrf_token'): string
    {
        $randomizer = new \Random\Randomizer();

        $randomizerCharacters = '1234567890!@#$%^*()[]{}?'
            . 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        $token = $randomizer->getBytesFromString($randomizerCharacters, 100);

        $_SESSION[$name] = $token;

        return $token;
    }

    public function receiveToken(string $name = 'csrf_token'): string
    {
        $token = $_SESSION[$name] ?? $this->generateToken($name);

        $this->generateToken($name);

        return $token;
    }

    public function receiveTokenOnly(string $name = 'csrf_token'): string
    {
        return $_SESSION[$name] ?? $this->generateToken($name);
    }
}
