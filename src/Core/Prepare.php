<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Database;

class Prepare
{
    public array $params;
    public mixed $stmt;

    public function __construct(
        protected readonly Database $database,
        protected readonly string $query
    ) {
        $this->params = [];
        $this->stmt = null;
    }

    public function setParameter(string $search, mixed $replace): self
    {
        if (is_bool($replace)) {
            $replace = (int) $replace;
        }

        $this->params[$search] = $replace;

        return $this;
    }

    public function getResult(): mixed
    {
        $this->stmt = $this->database->prepare($this->query);

        return $this->stmt;
    }
}
