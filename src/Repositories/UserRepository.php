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
}
