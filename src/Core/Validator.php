<?php

declare(strict_types=1);

namespace App\Core;

interface Validator
{
    public function isValid(): bool;
}
