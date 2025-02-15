<?php
namespace App\Core;

class Database {
  
    private static $pdo;

    public function conn() {
        $dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
        $host = $_ENV['DB_HOST'];
        $db = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASSWORD'];
        
        $dsn = "pgsql:host={$host};dbname={$db}";
        try {
            self::$pdo = new \PDO($dsn, $user, $pass);
            return "Connected to the database";
        } catch (\PDOException $e) {
            $error = $e->getMessage();
            echo $error;
        }
    }

    public static function getConnection() {
        if (self::$pdo === null) {
            $db = new Database();
            $db->conn();
        }
        return self::$pdo;
    }
}