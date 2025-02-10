<?php 

namespace App\Models;

class User {
    private $db;

    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $avatar;
    protected $role;
    protected $isActive;

    public function __construct($id, $name, $email, $password, $avatar, $role, $isActive){
        $this->db = Database::getConnection();

        $this->id = $id;
        $this->name = $name;
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

    public function register($name, $email, $password, $avatar, $role, $isActive) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, avatar, role, isActive) 
                                    VALUES (:name, :email, :password, :avatar, :role, :isActive)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':avatar', $avatar, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->bindParam(':isActive', $isActive, PDO::BOOLVAL);
        return $stmt->execute();
    }
    
}

?>