<?php

namespace App\Repositories;

use App\Models\User;
use PDO;

class UserRepository {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function login(User $user): ?User {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->bindValue(':email', $user->email, \PDO::PARAM_STR);
        $stmt->execute();

        $dbUser = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($dbUser && password_verify($user->password, $dbUser['password'])) {
            $authenticatedUser = new User();
            foreach ($dbUser as $key => $value) {
                $authenticatedUser->$key = $value;
            }
            return $authenticatedUser;
        }

        return null;
    }
}
