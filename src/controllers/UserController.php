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

    // Note2: Work on this later
    // public function login() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $username = $_POST['username'];
    //         $password = $_POST['password'];
    
    //         // Get user by username
    //         $user = $this->userDAO->getUserByUsername($username);
    
    //         if ($user && password_verify($password, $user->getPassword())) {
    //             // Start session & store user ID
    //             session_start();
    //             $_SESSION['user_id'] = $user->getUserId();
    //             header("Location: /Forum/public/index.php?action=profile");
    //             exit();
    //         } else {
    //             echo "Invalid username or password.";
    //         }
    //     } else {
    //         require_once __DIR__ . '/../views/loginForm.html.php';
    //     }
    // }    

    // public function profile() 
    // {
    //     // Check if the user is logged in
    //     if (!isset($_SESSION['user_id'])) {
    //         echo "Error: You must be logged in to view this page.";
    //         return;
    //     }

    //     $userId = $_SESSION['user_id'];
    //     $user = $this->userDAO->getUserById($userId);

    //     if (!$user) {
    //         echo "Error: User not found.";
    //         return;
    //     }

    //     $postDAO = new PostDAOImpl();

    //     // Check if the method exists before calling it
    //     // if (!method_exists($postDAO, 'getPostsByUserId')) {
    //     //     echo "Error: getPostsByUserId() method does not exist in PostDAOImpl.";
    //     //     return;
    //     // }

    //     // $posts = $postDAO->getPostsByUserId($userId);

    //     require_once __DIR__ . '/../views/profile.html.php';
    // }

    public function createUser() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $this->userDAO->createUser($username, $password, $email);
            header("Location: /forum/public/");
        } else {
            // Note 1: The views haven't been created yet, so this will throw an error.
            require_once __DIR__ . '/../views/users/signInForm.html.php';
        }
    }

    public function editUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $this->userDAO->editUser($username, $password, $email, $userId);
            header("Location: /forum/public/userLists");
        } else {
            $userId = $_GET['user_id'];
            $user = $this->userDAO->getUserById($userId);

            require_once __DIR__ . '/../views/users/profile.html.php';
        }
    }

    // public function deleteUser() 
    // {
    //     $userId = $_GET['user_id'] ?? null;
    //     if (!$userId) {
    //         echo "Error: invalid User ID.";
    //         return;
    //     }
        
    //     $this->userDAO->deleteUser($userId);
    //     header("Location: /forum/public/userLists");
    //     exit();
    // }

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

    public function getAllUser()
    {
        $users = $this->userDAO->getAllUsers();
        require_once __DIR__ . '/../views/users/userList.html.php';
    }
}
?>