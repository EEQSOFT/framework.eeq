<?php

declare(strict_types=1);

namespace App\Core;

class Query
{
    public function __construct(
        protected string $query
    ) {}

    public function setParameter(string $search, mixed $replace): self
    {
        if ($replace === false) {
            $replace = 0;
        }

        $search = ':' . $search;
        $replace = addslashes((string) $replace);
        $subject = $this->query;

        $this->query = str_replace(
            $search,
            $replace,
            $subject
        );

        return $this;
    }

    public function getStrQuery(): string
    {
        return $this->query;
    }
}
