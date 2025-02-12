<?php

namespace App\Controller;

use App\Repositories\UserRepository;
use App\Models\User;

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserRepository();
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $avatar = $_POST['avatar'];
            $role = $_POST['role'];
            $isActive = $_POST['isActive'];
            
            $user = new User(id: null, name: $name, email: $email, password: $password, avatar: $avatar, role: $role, isActive: $isActive);
        
            if ($this->userModel->register($user)) {
                $_SESSION['registered'] = true;
                header("Location: /signin");
                exit;
            }
        }
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
