<?php
namespace src\controllers;

session_start();

use src\dal\implementations\UserDAOImpl;
use src\dal\implementations\PostDAOImpl;

class UserController {
    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAOImpl();
    }
    
    public function index()
    {
        $users = $this->userDAO->getAllUsers();
        require_once __DIR__ . '/../views/users/userList.html.php';
    }

    public function createUser() {
        require_once __DIR__ . '/../views/users/signInForm.html.php';
    }

    public function store() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $this->userDAO->createUser($username, $password, $email);
            header("Location: /forum/public/");
        }
    }

    public function editUser() {
        $userId = $_GET['user_id'];
        $user = $this->userDAO->getUserById($userId);
        require_once __DIR__ . '/../views/users/profile.html.php';
    }

    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $this->userDAO->editUser($username, $password, $email, $userId);
            header("Location: /forum/public/userLists");
        } 
    }

    public function deleteUser() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? null;
            if (!$userId) {
                echo "Error: invalid User ID.";
                return;
            }
            
            $this->userDAO->deleteUser($userId);
            header("Location: /forum/public/userLists");
            exit();
        } else {
            echo "Invalid request method!";
        }
    }


    public function login() 
    {

    }
}
?>