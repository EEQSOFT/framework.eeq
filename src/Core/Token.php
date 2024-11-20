<?php

declare(strict_types=1);

namespace App\Core;

class Token
{
    public function generateToken(string $name = 'token'): string
    {
        $token = '';

        for ($i = 0; $i < 100; $i++) {
            if (rand(0, 2) !== 0) {
                $j = rand(0, 51);
                $token .= substr(
                    'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',
                    $j,
                    1
                );
            } else {
                $j = rand(0, 23);
                $token .= substr(
                    '1234567890!@#$%^*()[]{}?',
                    $j,
                    1
                );
            }
        }

        $_SESSION[$name] = $token;

        return $token;
    }

    public function receiveToken(string $name = 'token'): string
    {
        $token = $_SESSION[$name] ?? $this->generateToken($name);

        $this->generateToken($name);

        return $token;
    }

    public function receiveTokenOnly(string $name = 'token'): string
    {
        return $_SESSION[$name] ?? $this->generateToken($name);
    }
}
