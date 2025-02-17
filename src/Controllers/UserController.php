<?php

namespace App\Controllers;

use App\Repositories\UserRepository;

class UserController {

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email"] ?? "";
            $password = $_POST["password"] ?? "";

            if (empty($email) || empty($password)) {
                echo json_encode(["success" => false, "message" => "Email and password are required!"]);
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(["success" => false, "message" => "Invalid email format"]);
                return;
            }

            $userRepo = new UserRepository();
            $user = $userRepo->userAccsses($email, $password);

            if($user && password_verify($password, $user['password'])) {
                $_SESSION["id"] = $user["id"];
                $_SESSION["name"] = $user["name"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["role"] = $user["role"];
            } else {
                echo json_encode(["success" => false, "message" => "Invalid credentials!"]);
                return;
            }

            echo json_encode(["success" => true, "message" => "Login successful"]);
        }
    }

    public function Rederiction() {
        if (isset($_SESSION["id"]) && $_SESSION["role"] == "admin") {
            header("Location: /dashboard");
            exit();
        } else if (isset($_SESSION["id"]) && $_SESSION["role"] == "organisator") {
            header("Location: /org_dashboard");
            exit();
        } else if (isset($_SESSION["id"]) && $_SESSION["role"] == "user") {
            header("Location: /platform");
            exit();
        }
    }

    public function signup() {
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
    public function Statistics(){
        
        header("Content-Types: application/json");
            echo json_encode([
                "cards" =>[
                    [
                        "title" => "Total Events",
                        "value" => 6222,
                        "etat" => "up",
                        "percentage" => 99.99
                    ],
                    [
                        "title" => "Active Users",
                        "value" => 5,842,
                        "etat" => "up",
                        "percentage" => 8.2
                    ],
                    [
                        "title" => "Total Revenue",
                        "value" => 128,750,
                        "etat" => "up",
                        "percentage" => 15.3
                    ],
                    [
                        "title" => "AVG",
                        "value" => 12,938                    ,
                        "etat" => "down",
                        "percentage" => 2.7
                    ],
                ]
                ]);
    }
}
