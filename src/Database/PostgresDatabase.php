<?php

namespace YourProject\Database;

use PDO;
use PDOException;

class PostgresDatabase implements DatabaseInterface
{
    private $connection;

    public function connect(string $connectionString)
    {
        try {
            $this->connection = new PDO($connectionString);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new \Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function query(string $query, array $params = [])
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
