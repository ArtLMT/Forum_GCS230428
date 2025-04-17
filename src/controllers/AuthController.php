<?php
namespace src\controllers;

use src\controllers\UserController;
use src\utils\SessionManager;
use src\utils\Validation;

class AuthController {
    private $authDAO;
    private $userControl;

    public function __construct() {
        $this->userControl = new userController();
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

            $errors = [];
            if (!Validation::checkUserByEmail($email)) {
                $errors['duplicateEmail'] = "Invalid email or password.";
                SessionManager::set('errors', $errors);
                header("Location: /forum/public/login"); // Redirect back to login
                exit();
            }


            $user = $this->userControl->getUserByEmail($email);
            $getPassword = $user->getPassword();
    
            if (password_verify($password, $getPassword)) {
                SessionManager::start();
                SessionManager::set('user', $user);
                // SessionManager::set('user_id', $user->getUserId());
                // SessionManager::set('username', $user->getUsername());
    
                // Redirect to dashboard
                header("Location: /forum/public/");
                exit();
            } else {
                $errors = [];
                $errors['wrongPassword'] = "Invalid email or password.";
                SessionManager::set('errors', $errors);
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
        $currentUser = SessionManager::get('user');
        $currentUserId = $currentUser->getUserId();

        return $userId == $currentUserId ? true : false;
    }
}