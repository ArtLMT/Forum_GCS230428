<?php
namespace src\controllers;

use src\utils\Validation;
use src\dal\implementations\UserDAOImpl;

class AuthController {
    /**
     * Display the login form.
     */
    public function loginPage() {
        require_once __DIR__ . '/../views/loginForm.html.php'; // Correct path
    }

    /**
     * Process the login form.
     */
    public function login() {

        $userDAO = new UserDAOImpl(); // Make sure this class exists!

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = Validation::sanitizeInput($_POST['username']);
            $password = Validation::sanitizeInput($_POST['password']);

            if (!Validation::validateNotEmpty($username) || !Validation::validateNotEmpty($password)) {
                echo "Username and password are required.";
                exit();
            }

            $user = $userDAO->getUserByUsername($username);

            if ($password === $user->getPassword()) {
                session_start(); // Why?
                $_SESSION['user_id'] = $user->geUsertId();
                $_SESSION['username'] = $user->getUsername();
                header("Location: http://localhost/forum/public/index.php");
                exit();                
            } else {
                echo "Invalid credentials. Try again.";
            }
        }
    }
}
?>
