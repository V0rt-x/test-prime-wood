<?php
declare(strict_types=1);

namespace TestPrimeWood\Infrastructure\Drivers\Database;

use PgSql\Connection;
use TestPrimeWood\Infrastructure\Exceptions\PgsqlException;

class PgsqlDriver
{
    private static ?self $instance = null;

    private Connection $connection;

    /**
     * @throws PgsqlException
     */
    private function __construct()
    {
        $this->connect(
            env('DB_HOST'),
            env('DB_PORT'),
            env('DB_DATABASE'),
            env('DB_USERNAME'),
            env('DB_PASSWORD')
        );
    }

    public function __destruct()
    {
        pg_close($this->connection);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $host
     * @param string $port
     * @param string $database
     * @param string $user
     * @param string $password
     * @throws PgsqlException
     */
    public function connect(
        string $host,
        string $port,
        string $database,
        string $user,
        string $password,
    ): void
    {
        if (!$connection = pg_connect("host=$host port=$port dbname=$database user=$user password=$password")) {
            throw new PgsqlException(pg_last_error());
        }

        $this->connection = $connection;
    }

    /**
     * @param string $query
     * @return array
     * @throws PgsqlException
     */
    public function query(string $query): array
    {
        if (!$pgsqlResult = pg_query($this->connection, $query)) {
            throw new PgsqlException(pg_last_error($this->connection));
        }

        $result = [];
        while ($line = pg_fetch_array($pgsqlResult, null, PGSQL_ASSOC)) {
            $result[] = $line;
        }

        pg_free_result($pgsqlResult);

        return $result;
    }
}