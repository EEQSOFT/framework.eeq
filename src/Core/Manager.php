<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\{Database, Prepare, Repository};

class Manager
{
    protected array $repository;
    protected Prepare $result;

    public function __construct(
        protected readonly Database $database
    ) {}

    public function getRepository(string $class): Repository
    {
        $this->repository[$class] ??= new $class($this->database, $this);

        return $this->repository[$class];
    }

    public function prepare(string $query): Prepare
    {
        $this->result = new Prepare($this->database, $query);

        return $this->result;
    }

    public function execute(?array $array = null): bool
    {
        $array ??= $this->result->params;

        return $this->result->stmt->execute($array);
    }
}
