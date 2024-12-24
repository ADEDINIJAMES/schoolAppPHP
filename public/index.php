<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once '../Controller/UserController.php';
require_once '../Controller/StudentController.php';

// Initialize controllers
$controller = new UserController();
$studentController = new StudentController();

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
$adminRoutes = ['registerStudent', 'viewStudents'];
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
    default:
        $controller->login();
        break;
}
