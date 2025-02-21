<?php

declare(strict_types=1);

namespace App\Core;

abstract class Error
{
    protected ?array $error;

    public function __construct()
    {
        $this->error = null;
    }

    public function addError(string $error): void
    {
        $this->error[count($this->error ?? [])] = $error;
    }

    public function setError(?array $error): void
    {
        $this->error = $error;
    }

    public function getError(): ?array
    {
        return $this->error;
    }

    public function getStrError(): string
    {
        $error = '';

        foreach ($this->error as $key => $value) {
            $error .= $value . "\n";
        }

        return $error;
    }

    public function isError(): bool
    {
        return ($this->error !== null) ? true : false;
    }

    public function isValid(): bool
    {
        return ($this->error === null) ? true : false;
    }
}
