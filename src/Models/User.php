<?php 

namespace App\Models;

class User {
    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $avatar;
    protected $role;
    protected $isActive;

    public function __construct($id = null, $name = null, $email = null, $password = null, $avatar = null, $role = null, $isActive = null){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->$avatar = $avatar;
        $this->role = $role;
        $this->isActive = $isActive;
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getAvatar() { return $this->avatar; }
    public function getRole() { return $this->role; }
    public function getIsActive() { return $this->isActive; }

    public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setAvatar($avatar) { $this->avatar = $avatar; }
    public function setRole($role) { $this->role = $role; }
    public function setIsActive($isActive) { $this->isActive = $isActive; }
    
}

?>