<?php

namespace App\Models;

class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $avatar;
    private $role;

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }
}