<?php

declare(strict_types=1);

namespace App\Core;

interface Database
{
    public function connect(): void;
    public function prepare(string $query): mixed;
    public function execute(array $array): bool;
    public function rowCount(): int;
    public function lastInsertId(): int;
    public function beginTransaction(): bool;
    public function commit(): bool;
    public function rollBack(): bool;
}
