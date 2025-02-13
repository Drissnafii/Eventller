<?php

namespace App\Repositories;

use App\Models\User;
use App\Core\Database;

class UserRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function login(User $user): ?User {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $stmt->execute();

        $dbUser = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($dbUser && password_verify($user->getPassword(), $dbUser['password'])) {
            $authenticatedUser = new User();
            foreach ($dbUser as $key => $value) {
                $authenticatedUser->$key = $value;
            }
            return $authenticatedUser;
        }

        return null;
    }

    public function register(User $user) {
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, avatar, role, isActive) 
                                    VALUES (:name, :email, :password, :avatar, :role, :isActive)");
        $stmt->bindValue(':name', $user->getName(), \PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->getEmail(), \PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashedPassword, \PDO::PARAM_STR);
        $stmt->bindValue(':avatar', $user->getAvatar(), \PDO::PARAM_STR);
        $stmt->bindValue(':role', $user->getRole(), \PDO::PARAM_STR);
        $stmt->bindValue(':isActive', $user->getIsActive(), \PDO::PARAM_BOOL);
        return $stmt->execute();
    }


}
