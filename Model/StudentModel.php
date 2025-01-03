<?php
require_once '../config/Database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class StudentModel {
    private $db;
  public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function registerStudent($name, $email, $phone, $age, $class, $parent_name, $parent_phone) {
        try {
            $stmt = $this->db->prepare("INSERT INTO students (name, email, phone, age, class, parent_name, parent_phone) VALUES (:name, :email, :phone, :age, :class, :parent_name, :parent_phone)");
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

 public function getStudents($searchTerm = '') {
    // Start the query with a basic SELECT statement
    $query = "SELECT * FROM students";
    
    // If a search term is provided, modify the query to include a WHERE clause
    if (!empty($searchTerm)) {
        $searchTerm = '%' . $searchTerm . '%'; // Adding wildcard for LIKE search
        $query .= " WHERE name LIKE :search OR email LIKE :search OR phone LIKE :search"; // Example of searching by name, email, or phone
    }
    
    // Prepare and execute the statement
    $stmt = $this->db->prepare($query);
    
    // Bind the search term if applicable
    if (!empty($searchTerm)) {
        $stmt->bindParam(':search', $searchTerm);
    }
    
    $stmt->execute();
    
    // Return the results
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

     public function deleteStudent($id) {
        $stmt = $this->db->prepare("DELETE FROM students WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function updateStudent($id, $name, $email, $age, $phone, $class, $parent_name, $parent_phone) {
    $stmt = $this->db->prepare("UPDATE students SET name = :name, email = :email, age = :age, phone = :phone, class = :class, parent_name = :parent_name, parent_phone = :parent_phone   WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':class', $class);
    $stmt->bindParam(':parent_phone', $parent_phone);
    $stmt->bindParam(':parent_name', $parent_name);

    return $stmt->execute();
}

public function getStudent($id) {
    // Prepare the SQL statement with a placeholder
    $stmt = $this->db->prepare("SELECT * FROM students WHERE id = :id");

    // Bind the actual value to the placeholder
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Fetch all results as an associative array
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
?>
