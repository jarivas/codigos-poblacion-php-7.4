<?php

declare(strict_types=1);

namespace CodigosPoblacion;

use SQLite3;

class Connection
{
    protected SQLite3 $connection;

    public function __construct(string $path)
    {
        $this->connection = new SQLite3($path);
    }

    /**
     * Returns an array of $className
     * @param string $sql
     * @param string $className
     * @return array
     */
    public function query(string $sql, string $className): array
    {
        $queryResult = $this->connection->query($sql);
        $result = [];

        while (($row = $queryResult->fetchArray(SQLITE3_ASSOC))) {
            $result[] = new $className($row);
        }

        return $result;
    }
}
