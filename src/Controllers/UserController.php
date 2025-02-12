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
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $input = json_decode(file_get_contents("php://input"), true);
            
            if (!$input) {
                echo json_encode(["status" => "error", "message" => "Invalid input"]);
                exit;
            }

            $name = htmlspecialchars(strip_tags($input['name'] ?? ''));
            $email = filter_var($input['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $password = $input['password'] ?? '';
            $avatar = filter_var($input['avatar'] ?? '', FILTER_SANITIZE_URL);
            $role = htmlspecialchars(strip_tags($input['role'] ?? 'user'));
            $isActive = filter_var($input['isActive'] ?? true, FILTER_VALIDATE_BOOLEAN);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(["status" => "error", "message" => "Invalid email format"]);
                exit;
            }

            if (strlen($password) < 8) {
                echo json_encode(["status" => "error", "message" => "Password must be at least 8 characters"]);
                exit;
            }

            $user = new User(null, $name, $email, $password, $avatar, $role, $isActive);
    
            if ($this->userModel->register($user)) {
                echo json_encode(["status" => "success", "message" => "User registered successfully"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Registration failed"]);
            }
            
            exit;
        }
    }
    

}


?>