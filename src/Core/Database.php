<?php

declare(strict_types=1);

namespace App\Core;

class Database
{
    protected string $mysqlHost;
    protected int $mysqlPort;
    protected string $mysqlUser;
    protected string $mysqlPassword;
    protected mixed $mysqlLink;
    protected string $mysqlDatabase;
    protected string $mysqlNames;

    public function __construct(int|string $name = 0)
    {
        $database = require(DATABASE_FILE);

        $this->mysqlHost = $database[$name]['db_host'];
        $this->mysqlPort = $database[$name]['db_port'];
        $this->mysqlUser = $database[$name]['db_user'];
        $this->mysqlPassword = $database[$name]['db_password'];
        $this->mysqlLink = null;
        $this->mysqlDatabase = $database[$name]['db_database'];
        $this->mysqlNames = $database[$name]['db_names'];

        mysqli_report(MYSQLI_REPORT_OFF);
    }

    public function dbConnect(): void
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

    public function dbClose(): void
    {
        mysqli_close($this->mysqlLink)
            or die('Could not close the connection to MySQL');
    }

    public function dbQuery(string $query): mixed
    {
        return mysqli_query($this->mysqlLink, $query);
    }

    public function dbFetchArray(mixed $result): array|null|false
    {
        return mysqli_fetch_assoc($result);
    }

    public function dbNumberRows(mixed $result): int
    {
        return mysqli_num_rows($result);
    }

    public function dbAffectedRows(): int
    {
        return mysqli_affected_rows($this->mysqlLink);
    }

    public function dbInsertId(): int
    {
        return mysqli_insert_id($this->mysqlLink);
    }

    public function dbStartTransaction(): bool
    {
        return $this->dbQuery('START TRANSACTION');
    }

    public function dbCommit(): bool
    {
        return $this->dbQuery('COMMIT');
    }

    public function dbRollback(): bool
    {
        return $this->dbQuery('ROLLBACK');
    }
}
