<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\{AppException, Database};

class MyPDO implements Database
{
    protected readonly string $dbName;
    protected readonly string $dbHost;
    protected readonly int $dbPort;
    protected readonly string $dbUser;
    protected readonly string $dbPassword;
    protected readonly string $dbDatabase;
    protected readonly string $dbNames;
    protected mixed $pdo;
    protected mixed $stmt;

    public function __construct(string $name = DEFAULT_DATABASE_NAME)
    {
        $database = require DATABASE_FILE;

        $this->dbName = $name;
        $this->dbHost = $database[$name]['db_host'];
        $this->dbPort = $database[$name]['db_port'];
        $this->dbUser = $database[$name]['db_user'];
        $this->dbPassword = $database[$name]['db_password'];
        $this->dbDatabase = $database[$name]['db_database'];
        $this->dbNames = $database[$name]['db_names'];
        $this->pdo = null;
        $this->stmt = null;
    }

    public function connect(): void
    {
        try {
            $this->pdo = new \PDO(
                $this->dbName . ':host=' . $this->dbHost . ':'
                    . $this->dbPort . ';charset=' . $this->dbNames . ';'
                    . 'dbname=' . $this->dbDatabase,
                $this->dbUser,
                $this->dbPassword
            );
        } catch (\PDOException $e) {
            throw new AppException('Could not connect to the database');
        }

        $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function prepare(string $query): mixed
    {
        $this->stmt = $this->pdo->prepare($query);

        return $this->stmt;
    }

    public function execute(array $array): bool
    {
        return $this->stmt->execute($array);
    }

    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    public function lastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }

    public function beginTransaction(): bool
    {
        $this->pdo->beginTransaction();
    }

    public function commit(): bool
    {
        $this->pdo->commit();
    }

    public function rollBack(): bool
    {
        $this->pdo->rollBack();
    }
}
