<?php
namespace src\controllers;

use src\dal\implementations\UserDAOImpl;
use src\controllers\UserController;
use src\utils\SessionManager;

class AuthController {
    private $authDAO;
    private $userDAO;

    public function __construct() {
        $this->userDAO = new userDAOImpl();
    }

    public function showLoginForm() 
    {
        include_once __DIR__ . "/../views/auth/loginForm.html.php"; 
    }

    public function showSignInForm()
    {
        include_once __DIR__ . "/../views/auth/SignInForm.html.php";
    }

    public function login() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
    
            $user = $this->userDAO->getUserByEmail($email);
            echo $getPassword = $user->getPassword();
            // getUserId -> ra password???
            // getPassword->username
    
            if ($getPassword == $password) {
                SessionManager::start();
                SessionManager::set('user',$user);
                SessionManager::set('user_id', $user->getUserId());
                SessionManager::set('username', $user->getUsername());
    
                // Redirect to dashboard
                header("Location: /forum/public/");
                exit();
            } else {
                echo "Invalid email or password";
                SessionManager::set('error', 'Invalid email or password.');
                header("Location: /forum/public/login"); // Redirect back to login
                exit();
            }
        }
    }
    
    public function logout() {
        SessionManager::destroy();
        include_once __DIR__ . "/../views/auth/loginForm.html.php"; 
        exit();
    }

    public function isOwner($userId)
    {
        $userController = new UserController();
        $currentUser = $userController->getCurrentUser();
        $currentUserId = $currentUser->getUserId();

        return $userId == $currentUserId ? true : false;
    }
}