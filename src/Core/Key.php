<?php

declare(strict_types=1);

namespace App\Core;

class Key
{
    public function generateKey(): string
    {
        $randomizer = new \Random\Randomizer();

        $randomizerCharacters = '1234567890'
            . 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        return $randomizer->getBytesFromString($randomizerCharacters, 100);
    }
}
