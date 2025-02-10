<?php
namespace App\Config;
require_once __DIR__ . '/../vendor/autoload.php';
use Dotenv;
use Pdo;
use PDOException;

class Database {

    private $host;
    private $database;
    private $username;
    private $password;
    private static $pdo;
    private $error;

    public function __construct() {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $this->host = $_ENV['host'];
        $this->database = $_ENV['database'];
        $this->username = $_ENV['user'];
        $this->password = $_ENV['pass'];

        $conn = "pgsql:host={$this->host};dbname={$this->database}";
        try {
            self::$pdo = new PDO($conn, $this->username, $this->password);
            echo "Connection is good";
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public static function getConnection() {
        return self::$pdo;
    }
}

new Database();
Database::getConnection();

?>