<?php
namespace App\Core;
use PDOException;
use pdo_drivers;
use PDO;
class Database {
    private $host;
    private $db;
    private $user;
    private $pass;
    private $port;
    private static $pdo;
    private $error;

    public function __construct() {
        $dotenv = \Dotenv\Dotenv::createImmutable(realpath($_SERVER['DOCUMENT_ROOT'] . '/../'));    
        $dotenv->load();
        // $this->dburl = $_ENV['DATABASE_URL'];
        $this->host = $_ENV['DB_HOST'];
        $this->db = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->pass = $_ENV['DB_PASSWORD'];
        $this->port = $_ENV['PORT'];
        $dsn = "pgsql:host={$this->host};dbname={$this->db};port={$this->port}";
        self::$pdo = new PDO($dsn, $this->user, $this->pass);
        try {
            echo "Connected to the database";
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public static function getConnection() {
        return self::$pdo;
    }
}

