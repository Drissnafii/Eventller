<?php

namespace App\Controller;

use App\Repositories\UserRepository;
use App\Models\User;

class UserController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new UserRepository();
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

             $user = new User(null, null, $email, $password);

            $authenticatedUser = $this->userModel->login($user);

            if ($authenticatedUser) {
                $_SESSION['id'] = $authenticatedUser->getId();
                $_SESSION['email'] = $authenticatedUser->getEmail();
                $_SESSION['role'] = $authenticatedUser->getRole();
                $_SESSION['registered'] = true;

                header("Location: /dashboard");
                exit;
            } else {
                echo "Invalid credentials.";
            }
        }
    }
}