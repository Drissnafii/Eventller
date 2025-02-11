<?php
namespace App\Core;

class Database {

    private static $pdo = null;

    public static function connect() {
        $dotenv = \Dotenv\Dotenv::createImmutable(realpath($_SERVER['DOCUMENT_ROOT'] . '/../'));
        $dotenv->load();
        $host = $_ENV['DB_HOST'];
        $db = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASSWORD'];
        
        $dsn = "pgsql:host={$host};dbname={$db}";
        try {
            self::$pdo = new \PDO($dsn, $user, $pass);
            echo "Connected to the database";
        } catch (\PDOException $e) {
            $error = $e->getMessage();
            echo $error;
        }
    }

    public static function getConnection() {
        if(self::$pdo === null) {
            self::connect();
        }
        return self::$pdo;
    }
}

// new Database();
// Database::getConnection();