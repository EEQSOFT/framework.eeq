<?php

declare(strict_types=1);

namespace App\Core;

interface Mail
{
    public function sendEmail(
        string $serverName,
        string $emailFrom,
        string $emailTo,
        string $subject,
        string $message
    ): bool;
}
