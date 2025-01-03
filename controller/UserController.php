<?php
require_once '../Model/UserModel.php';
require_once '../config/Database.php';

class UserController {
    private $model;


    public function __construct() {
        $this->model = new UserModel();
    }

    public function isAdmin() {
    if (!isset($_SESSION['user']) || empty($_SESSION['user']['is_Admin']) || $_SESSION['user']['is_Admin'] != 1) {
          echo '<pre>'; print_r($_SESSION); echo '</pre>'; // Check the session contents
        die('Access denied.');
        header('Location: ?action=login');
        exit();
    }
}

    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->model->getUserByEmail($email);
            
            if ($user && password_verify($password, $user['password'])) {
                // Store user data in session
                $_SESSION['user'] = [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'is_Admin'=>$user['is_Admin']
                ];
                header('Location: ?action=dashboard');
                exit();
            } else {
                $error = 'Invalid email or password.';
            }
        }
        include '../View/login.php';
    }

    public function register() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            if ($this->model->registerUser($name, $email, $password, $phone)) {
                header('Location: ?action=login');
                exit();
            } else {
                $error = 'User already exists.';
            }
        }
        include '../View/register.php';
    }

    public function dashboard() {
        if (!isset($_SESSION['user']) || !is_array($_SESSION['user'])) {
            header('Location: ?action=login');
            exit();
        }
        include '../View/dashboard.php';
    }

    public function logout() {
        session_destroy();
        header('Location: ?action=login');
        exit();
    }
    
}
