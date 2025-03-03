<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Validator;

abstract class Message implements Validator
{
    protected ?array $message;
    protected bool $ok;

    public function __construct()
    {
        $this->message = null;
        $this->ok = false;
    }

    public function addMessage(string $message): void
    {
        $this->message[count($this->message ?? [])] = $message;
    }

    public function setMessage(?array $message): void
    {
        $this->message = $message;
    }

    public function getMessage(): ?array
    {
        return $this->message;
    }

    public function getStrMessage(): string
    {
        $message = '';

        foreach ($this->message as $key => $value) {
            $message .= $value . "\n";
        }

        return $message;
    }

    public function isMessage(): bool
    {
        return ($this->message !== null) ? true : false;
    }

    public function isValid(): bool
    {
        return ($this->message === null) ? true : false;
    }

    public function setOk(bool $ok): void
    {
        $this->ok = $ok;
    }

    public function getOk(): bool
    {
        return $this->ok;
    }
}
