<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Jika menggunakan Composer

use YourProject\Database\DatabaseInterface;
use YourProject\Database\MySQLDatabase;
use YourProject\Database\PostgresDatabase;
use YourProject\Database\SQLiteDatabase;
use Dotenv\Dotenv; // Tambahkan ini untuk memuat environment variables

// Muat file .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Muat konfigurasi dari file config.php
$config = require __DIR__ . '/../config/config.php'; // Memuat konfigurasi dari file config.php


// Pilih driver berdasarkan konfiguras
$database = null;
switch ($config['DB_TYPE']) {
    case 'mysql':
        $database = new MySQLDatabase();
        break;
    case 'postgres':
        $database = new PostgresDatabase();
        break;
    case 'sqlite':
        $database = new SQLiteDatabase();
        break;
    default:
        throw new Exception("Database type not supported");
}

// Connect ke database
$database->connect($config['DB_CONNECTION_STRING']);

// Query database
$query = "SELECT * FROM users WHERE id = :id";
$params = ['id' => 1];
$results = $database->query($query, $params);

// Tampilkan hasil
foreach ($results as $row) {
    echo "User ID: {$row['id']}, Name: {$row['name']}" . PHP_EOL;
}
