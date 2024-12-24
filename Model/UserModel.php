<?php
require_once '../config/Database.php';

class UserModel {
    private $db;

     public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

  public function registerUser($name, $email, $password, $phone, $is_Admin = 1) {
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Prepare the SQL statement
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, phone, is_Admin) 
                                    VALUES (:name, :email, :password, :phone, :is_Admin)");
        
        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':is_Admin', $is_Admin, PDO::PARAM_INT); 

        // Execute the statement
        return $stmt->execute();
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Duplicate entry error
            return false;
        }
        throw $e;
    }
}


    public function authenticateUser($email, $password) {
        $stmt = $this->db->prepare("SELECT password FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        return false;
    }

     public function updateUser($email, $newPassword = null, $newPhone = null) {
        $query = "UPDATE users SET ";
        $params = [];
        if ($newPassword) {
            $query .= "password = :password, ";
            $params['password'] = password_hash($newPassword, PASSWORD_BCRYPT);
        }
        if ($newPhone) {
            $query .= "phone = :phone, ";
            $params['phone'] = $newPhone;
        }
        $query = rtrim($query, ', ');
        $query .= " WHERE email = :email";

        $params['email'] = $email;

        $stmt = $this->db->prepare($query);

        foreach ($params as $key => $value) {
            $stmt->bindParam(":$key", $value);
        }

        return $stmt->execute();
    }

    public function deleteUser($email) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function getUserByEmail($email) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
