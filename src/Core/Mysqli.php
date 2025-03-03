<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Database;

class Mysqli implements Database
{
    protected readonly string $mysqlHost;
    protected readonly int $mysqlPort;
    protected readonly string $mysqlUser;
    protected readonly string $mysqlPassword;
    protected readonly string $mysqlDatabase;
    protected readonly string $mysqlNames;
    protected mixed $mysqlLink;
    protected mixed $mysqlResult;

    public function __construct(string $name = 'Mysqli')
    {
        $database = require(DATABASE_FILE);

        $this->mysqlHost = $database[$name]['db_host'];
        $this->mysqlPort = $database[$name]['db_port'];
        $this->mysqlUser = $database[$name]['db_user'];
        $this->mysqlPassword = $database[$name]['db_password'];
        $this->mysqlDatabase = $database[$name]['db_database'];
        $this->mysqlNames = $database[$name]['db_names'];
        $this->mysqlLink = null;
        $this->mysqlResult = null;

        mysqli_report(MYSQLI_REPORT_OFF);
    }

    public function connect(): void
    {
        $this->mysqlLink = @mysqli_connect(
            $this->mysqlHost,
            $this->mysqlUser,
            $this->mysqlPassword,
            '',
            $this->mysqlPort
        ) or die('Could not connect to MySQL');

        mysqli_select_db($this->mysqlLink, $this->mysqlDatabase)
            or die('Could not choose the database');

        mysqli_set_charset($this->mysqlLink, $this->mysqlNames);
    }

    public function close(): void
    {
        mysqli_close($this->mysqlLink)
            or die('Could not close the connection to MySQL');
    }

    public function query(string $query): mixed
    {
        $this->mysqlResult = mysqli_query($this->mysqlLink, $query);

        return $this->mysqlResult;
    }

    public function fetchArray(mixed $result = null): array|null|false
    {
        return mysqli_fetch_assoc($result ?? $this->mysqlResult);
    }

    public function numberRows(mixed $result = null): int
    {
        return mysqli_num_rows($result ?? $this->mysqlResult);
    }

    public function affectedRows(): int
    {
        return mysqli_affected_rows($this->mysqlLink);
    }

    public function insertId(): int
    {
        return mysqli_insert_id($this->mysqlLink);
    }

    public function startTransaction(): bool
    {
        return $this->query('START TRANSACTION');
    }

    public function commit(): bool
    {
        return $this->query('COMMIT');
    }

    public function rollback(): bool
    {
        return $this->query('ROLLBACK');
    }
}
