<?php
require_once '../Model/StudentModel.php';
require_once 'UserController.php';
class StudentController {
    private $model;
    private $userController;

    public function __construct() {
        $this->model = new StudentModel();
        $this->userController = new UserController();
    }

    public function registerStudent() {
        try {
             $this->userController->isAdmin();

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $age = $_POST['age'];
            $class = $_POST['class'];
            $parent_name = $_POST['parent_name'];
            $parent_phone = $_POST['parent_phone'];


            if ($this->model->registerStudent($name, $email, $phone, $age, $class, $parent_name, $parent_phone)) {
                header('Location: ?action=viewStudents');
                exit();
            } else {
                $error = 'Student with this email already exists.';
            }
        }
        include '../View/registerStudent.php';
         
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
            
        }
    }
       

   public function viewStudents() {
    $this->userController->isAdmin(); 
    
    // Check if a search term is provided
    $searchTerm = isset($_POST['search']) ? $_POST['search'] : '';
    
    // Get students based on the search term
    $students = $this->model->getStudents($searchTerm);
    
    // Include the view for displaying the students
    include '../View/viewStudent.php';
}

public function viewStudent($id) {
    // Check if the user is an admin
    $this->userController->isAdmin();

    // Fetch student data using the model
    $student = $this->model->getStudent($id);

    // Include the updateStudent view, passing the $student data
    include '../View/updateStudent.php';
}

public function updateStudent($id) {
    try {
        // Assuming $id is being passed to the method
        $this->userController->isAdmin();
        
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];
            $class = $_POST['class'];
            $parent_name = $_POST['parent_name'];
            $parent_phone = $_POST['parent_phone'];

            if ($this->model->updateStudent($id, $name, $email, $age, $phone, $class, $parent_name, $parent_phone)) {
                header('Location: index.php?action=viewStudents');
                exit();
            } else {
                $error = 'An error occurred !!';
            }
        }

        // Load the student data for editing
        $student = $this->model->getStudentById($id); // Assuming you have a method to fetch the student by ID
        include '../View/viewStudent.php';
    } catch (Exception $e) {
        throw new Exception("Error Processing Request", 1);
    }
}

public function deleteStudent($id){
$this->userController->isAdmin();
       if($this->model->deleteStudent($id)){
        header('Location: index.php?action=viewStudents');
        exit();
       }
       include '../View/viewStudents.php';
    
}
}
?>
