<?php

declare(strict_types=1);

namespace App\Core;

abstract class Message
{
    protected string $message;
    protected bool $ok;

    public function __construct()
    {
        $this->message = '';
        $this->ok = false;
    }

    public function addMessage(string $message): void
    {
        $this->message .= $message . "\n";
    }

    protected function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getMessage(): ?array
    {
        $length = strlen($this->message);

        if ($length >= 1) {
            return explode("\n", substr($this->message, 0, ($length - 1)));
        }

        return null;
    }

    public function getStrMessage(): string
    {
        return $this->message;
    }

    public function isMessage(): bool
    {
        return ($this->message !== '') ? true : false;
    }

    public function isValid(): bool
    {
        return ($this->message === '') ? true : false;
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
