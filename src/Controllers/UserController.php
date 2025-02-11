<?php

namespace App\Controllers;

use App\Repositories\UserRepository;


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
        
            if ($this->userModel->register($name, $email, $password, $avatar, $role, $isActive)) {
                $_SESSION['registered'] = true;
                header("Location: /signin");
                exit;
            }
        }
    }
    
}


?>