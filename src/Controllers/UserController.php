<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Models\User;


class UserController {
    private $userModel;
    public function __construct() {
        $this->userModel = new UserRepository();
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $name = htmlspecialchars(strip_tags($_POST['name']));
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $avatar = filter_var($_POST['avatar'], FILTER_SANITIZE_URL);
            $role = htmlspecialchars(strip_tags($_POST['role']));
            $isActive = filter_var($_POST['isActive'], FILTER_VALIDATE_BOOLEAN);


            // $name = $_POST['name'];
            // $email = $_POST['email'];
            // $password = $_POST['password'];
            // $avatar = $_POST['avatar'];
            // $role = $_POST['role'];
            // $isActive = $_POST['isActive'];

            $user = new User(id: null, name: $name, email: $email, password: $password, avatar: $avatar, role: $role, isActive: $isActive);

            if ($this->userModel->register($user)) {
                $_SESSION['registered'] = true;
                header("Location: /signin");
                exit;

            }
        }
    }

}


?>