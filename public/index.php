<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../Controller/UserController.php';
require_once '../Controller/StudentController.php';
require_once '../controller/QuestionController.php';

// Initialize controllers
$controller = new UserController();
$studentController = new StudentController();
$questionController = new QuestionController();

// Get the action from the query parameter
$action = $_GET['action'] ?? 'login';

// Allowed routes without login
$publicRoutes = ['login', 'register'];

// Check if the user is logged in or accessing a public route
if (!isset($_SESSION['user']) && !in_array($action, $publicRoutes)) {
    header('Location: index.php?action=login');
    exit();
}

// Check if the user is an admin for restricted actions
$adminRoutes = ['registerStudent', 'viewStudents', 'addQuestion','update' ];
if (in_array($action, $adminRoutes) && ($_SESSION['user']['is_Admin'] ?? 0) != 1) {
    die('Access denied: Admins only.');
}

// Route actions based on the `action` query parameter
switch ($action) {
    case 'register':
        $controller->register();
        break;
    case 'dashboard':
        $controller->dashboard();
        break;
    case 'logout':
        $controller->logout();
        break;
    case 'registerStudent':
        $studentController->registerStudent();
        break;
    case 'viewStudents':
        $studentController->viewStudents();
        break;
   case 'addquestion': 
        $questionController->addQuestion();
        break;

    case 'deleteStudent': 
          $id = $_GET['id'] ?? null; // Safely get the 'id' parameter or default to null
    if ($id) {
        $studentController->deleteStudent($id); // Pass the $id to the controller method
    } else {
        echo "Error: No ID provided for update.";
    }
    break;
  case 'update':
        $id = $_GET['id'] ?? null; // Safely get the 'id' parameter or default to null
    if ($id) {
        $studentController->viewStudent($id); // Pass the $id to the controller
    } else {
        echo "Error: No ID provided for update.";
    }
    break;



  case 'updateStudent':
    $id = $_GET['id'] ?? null; // Safely get the 'id' parameter or default to null
    if ($id) {
        $studentController->updateStudent($id); // Pass the $id to the controller method
    } else {
        echo "Error: No ID provided for update.";
    }
    break;


    default:
        $controller->login();
        break;
}
