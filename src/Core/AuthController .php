<?php

namespace App\Core;


class AuthController {
    public function signup() {
        $data = $_POST;

        if (empty($data['email']) || empty($data['password'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Email and Password are required']);
            return;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid email format']);
            return;
        }

        $authService = new AuthService();
        $response = $authService->registerUser($data);
        echo json_encode($response);
    }
}

