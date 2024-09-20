<?php

namespace YourProject\Database;

interface DatabaseInterface
{
    public function connect(string $connectionString);
    public function query(string $query, array $params = []);
}
