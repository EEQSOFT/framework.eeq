<?php

declare(strict_types=1);

namespace App\Core;

abstract class Code
{
    protected int $code;

    public function __construct()
    {
        $this->code = 200;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function isError(): bool
    {
        return ($this->code !== 200) ? true : false;
    }

    public function isValid(): bool
    {
        return ($this->code === 200) ? true : false;
    }
}
