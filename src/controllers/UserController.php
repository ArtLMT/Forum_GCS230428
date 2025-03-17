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

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            // Get user by username
            $user = $this->userDAO->getUserByUsername($username);
    
            if ($user && password_verify($password, $user->getPassword())) {
                // Start session & store user ID
                session_start();
                $_SESSION['user_id'] = $user->getUserId();
                header("Location: /Forum/public/index.php?action=profile");
                exit();
            } else {
                echo "Invalid username or password.";
            }
        } else {
            require_once __DIR__ . '/../views/loginForm.html.php';
        }
    }    

    public function profile() 
    {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            echo "Error: You must be logged in to view this page.";
            return;
        }

        $userId = $_SESSION['user_id'];
        $user = $this->userDAO->getUserById($userId);

        if (!$user) {
            echo "Error: User not found.";
            return;
        }

        $postDAO = new PostDAOImpl();

        // Check if the method exists before calling it
        // if (!method_exists($postDAO, 'getPostsByUserId')) {
        //     echo "Error: getPostsByUserId() method does not exist in PostDAOImpl.";
        //     return;
        // }

        // $posts = $postDAO->getPostsByUserId($userId);

        require_once __DIR__ . '/../views/profile.html.php';
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