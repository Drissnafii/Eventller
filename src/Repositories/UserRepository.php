<?php

namespace App\Repositories;

use App\Core\Database;

class UserRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function userAccsses($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([":email" => $email]);
        return $stmt->fetch();
    }


    public function createUser($name, $email, $password, $role) {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
        return $stmt->execute([
            ":name" => $name,
            ":email" => $email,
            ":password" => $password,
            ":role" => $role
        ]);
    }

}
