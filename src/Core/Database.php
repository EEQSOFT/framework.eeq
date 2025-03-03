<?php

declare(strict_types=1);

namespace App\Core;

interface Database
{
    public function connect(): void;
    public function close(): void;
    public function query(string $query): bool;
    public function result(): mixed;
    public function fetchArray(mixed $result): array|null|false;
    public function numberRows(mixed $result): int;
    public function affectedRows(): int;
    public function insertId(): int;
    public function startTransaction(): bool;
    public function commit(): bool;
    public function rollback(): bool;
}
