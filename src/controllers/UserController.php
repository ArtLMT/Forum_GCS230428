<?php
namespace src\controllers;

use src\dal\implementations\UserDAOImpl;
use src\dal\implementations\PostDAOImpl;

class UserController {
    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAOImpl();
    }

    public function listUsers() {
        $users = $this->userDAO->getAllUsers();
        // Note 1: The views haven;t been created yet, so this will throw an error.
        require_once __DIR__ . '/../views/userList.html.php';
    }

    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $this->userDAO->createUser($username, $password, $email);
            header("Location: /Forum/public/");
        } else {
            // Note 1: The views haven;t been created yet, so this will throw an error.
            require_once __DIR__ . '/../views/userForm.html.php';
        }
    }

    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $this->userDAO->updateUser($userId, $username, $password, $email);
            header("Location: /Forum/public/");
        } else {
            $userId = $_GET['user_id'];
            $user = $this->userDAO->getUserById($userId);
            // Note 1: The views haven;t been created yet, so this will throw an error.
            require_once __DIR__ . '/../views/userForm.html.php';
        }
    }

    public function deleteUser() {
        $userId = $_GET['user_id'];
        $this->userDAO->deleteUser($userId);
        header("Location: /Forum/public/");
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->userDAO->getUserByUsername($username);
            
            if ($user && password_verify($password, $user->getPassword())) {
                $_SESSION['user_id'] = $user->getUserId();
                header("Location: /Forum/public/");
            } else {
                echo "Invalid username or password.";
            }
        } else {
            // Note 1: The views haven;t been created yet, so this will throw an error.
            require_once __DIR__ . '/../views/loginForm.html.php';
        }
    }
}
?>