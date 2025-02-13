<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Models\User;

class UserController {

    public function signup()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST["name"] ?? "";
            $email = $_POST["email"] ?? "";
            $password = $_POST["password"] ?? "";
            $role = $_POST["role"] ?? "";

            if (empty($name) || empty($email) || empty($password) || empty($role)) {
                echo json_encode(["success" => false, "message" => "All fields are required!"]);
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(["status" => "error", "message" => "Invalid email format"]);
                exit;
            }

            if (strlen($password) < 8) {
                echo json_encode(["status" => "error", "message" => "Password must be at least 8 characters"]);
                exit;
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $userRepo = new UserRepository();
            $result = $userRepo->createUser($name, $email, $hashedPassword, $role);

            if ($result) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["success" => false, "message" => "Signup failed! Try again."]);
            }
        }
    }
}
