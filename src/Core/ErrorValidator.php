<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\{Error, Validator};

abstract class ErrorValidator extends Error implements Validator
{
    abstract public function validate(array $array): void;

    public function isValid(): bool
    {
        return ($this->error === null) ? true : false;
    }
}
