<?php

namespace App\Services;

class ValidationController{

    /**
     * Validation of route parametres 
     * 
     * @param array $parametres
     * @param array $data
     * @return bool
     */
    public static function Validation($parametres , $data){ 
        foreach ($parametres as $para => $dtype) {
            if (empty($data[$para])) {
                http_response_code(400);
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Missing parametres']);
                return false;
            }
            switch($dtype){
                case 'string':
                    if (!is_string($data[$para])) {
                        http_response_code(400);
                        header('Content-Type: application/json');
                        echo json_encode(['error' => 'Invalid data format']);
                        return false;
                    }
                    break;
                case 'int':
                    if (!filter_var($data[$para],FILTER_VALIDATE_INT)) {
                        http_response_code(400);
                        header('Content-Type: application/json');
                        echo json_encode(['error' => 'Invalid data format']);
                        return false;
                    }
                    break;
                case 'email':
                    if (!filter_var($data[$para], FILTER_VALIDATE_EMAIL)) {
                        http_response_code(400);
                        header('Content-Type: application/json');
                        echo json_encode(['error' => 'Invalid email format']);
                        return false;
                    }
                    break;
                case 'password':
                    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $data[$para])) {
                        http_response_code(400);
                        header('Content-Type: application/json');
                        echo json_encode(['error' => 'The password must be between 8 and 12 characters long and contain at least one letter and one number']);
                        return false;
                    }
                    break;
            }
        }
        return true;
    }
}

