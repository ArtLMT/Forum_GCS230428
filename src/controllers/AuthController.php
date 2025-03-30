<?php
namespace src\controllers;

use src\dal\implementations\AuthDAOImpl;
use src\utils\SessionManager;

class AuthController {
    private $authDAO;

    public function __construct() {
        $this->authDAO = new AuthDAOImpl();
    }

    public function showLoginForm() {
        include_once __DIR__ . "/../views/auth/loginForm.html.php"; 
    }

    public function showSignInForm()
    {
        include_once __DIR__ . "/../views/auth/SignInForm.html.php";
    }

    // POST /auth/login - Handle user login
    public function login() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
    
            $user = $this->authDAO->getUserByEmail($email);
            echo $getPassword = $user->getPassword();
            // getUserId -> ra password???
            // getPassword->username
    
            if ($getPassword == $password) {  // ✅ Use object method
                SessionManager::start();
                SessionManager::set('user_id', $user->getUserId());
                SessionManager::set('username', $user->getUsername());
    
                // Redirect to dashboard
                header("Location: /forum/public/");
                exit();
            } else {
                echo "Invalid email or password";
                // $_SESSION['error'] = "Invalid email or password";
                header("Location: /forum/public/signIn"); // Redirect back to login
                exit();
            }
        }
    }
    

    // GET /auth/logout - Handle user logout
    public function logout() {
        SessionManager::destroy();
        include_once __DIR__ . "/../views/auth/loginForm.html.php"; 
        exit();
    }
}