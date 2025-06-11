<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\{Code, Validator};

abstract class CodeValidator extends Code implements Validator
{
    abstract public function validate(array $array): void;

    public function isValid(): bool
    {
        return ($this->code === 200) ? true : false;
    }
}
