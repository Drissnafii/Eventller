<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Models\User;

class UserController {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
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
        
            if ($this->userRepository->register($user)) {
                $_SESSION['registered'] = true;
                header("Location: /signin");
                exit;
            }
        }
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User(null, null, $email, $password);

        $authenticatedUser = $this->userRepository->login($user);

        if ($authenticatedUser) {
            $_SESSION['id'] = $authenticatedUser->getId();
            $_SESSION['email'] = $authenticatedUser->getEmail();
            $_SESSION['role'] = $authenticatedUser->getRole();
            $_SESSION['registered'] = true;

            if ($authenticatedUser->getRole() === 'admin') {
                header("Location: /dashboard");
            } else if ($authenticatedUser->getRole() === 'organization'){
                header("Location: /organization/dashboard");
            } else if ($authenticatedUser->getRole() === 'user') {
                header("Location: /user/dashboard");
            }
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid credentials.";
            header("Location: /signin");
            exit();
        }
    }
}
