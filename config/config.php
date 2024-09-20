<?php

return [
    'DB_TYPE' => $_ENV['DB_TYPE'] ?: 'mysql',
    'DB_CONNECTION_STRING' => $_ENV['DB_CONNECTION_STRING'] ?: 'mysql:host=localhost;dbname=testdb',
];
