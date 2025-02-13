<?php

namespace App\Repositories;

use App\Models\User;
use App\Core\Database;

class UserRepository {
    private $pdo;

    public function __construct() {
        
    }


    public function createUser($name, $email, $password, $role) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
        $resultat = $stmt->execute([
            ":name" => $name,
            ":email" => $email,
            ":password" => $password,
            ":role" => $role
        ]);
        return $resultat ;
        
    }


}