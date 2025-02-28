<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\{Database, Manager};

abstract class Repository
{
    public function __construct(
        protected readonly Database $database,
        protected readonly Manager $manager
    ) {}
}
