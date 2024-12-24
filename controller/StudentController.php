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
    }

    public function viewStudents() {
        $this->userController->isAdmin(); 
        $students = $this->model->getStudents();
        include '../View/viewStudent.php';
    }
}
?>
