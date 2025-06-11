<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\{Message, Validator};

abstract class MessageValidator extends Message implements Validator
{
    abstract public function validate(array $array): void;

    public function isValid(): bool
    {
        return $this->ok;
    }
}
