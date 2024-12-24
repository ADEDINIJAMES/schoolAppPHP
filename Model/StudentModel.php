<?php
require_once '../config/Database.php';

class StudentModel {
    private $db;
  public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function registerStudent($name, $email, $phone, $age, $class, $parent_name, $parent_phone) {
        try {
            $stmt = $this->db->prepare("INSERT INTO Student (name, email, phone, age, class, parent_name, parent_phone) VALUES (:name, :email, :phone, :age, :class, :parent_name, :parent_phone)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':class', $class);
            $stmt->bindParam(':parent_name', $parent_name);
            $stmt->bindParam(':parent_phone', $parent_phone);

            return $stmt->execute();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { 
                return false;
            }
            throw $e;
        }
    }

    public function getStudents() {
        $stmt = $this->db->query("SELECT * FROM Student");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
