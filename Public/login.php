<?php
require_once '../autoload.php';

use src\controllers\AuthController;
use src\utils\Validation;

$authController = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = Validation::sanitizeInput($_POST['username']);
    $password = Validation::sanitizeInput($_POST['password']);

    if (!Validation::validateNotEmpty($username) || !Validation::validateNotEmpty($password)) {
        echo "Username and password are required.";
        exit();
    }

    $user = $authController->login($username, $password);

    $_SESSION['user_id'] = $user->getId();
    $_SESSION['username'] = $user->getUsername();
    if ($user) {
        header("Location: forum/index.php");  // Redirect to main page
        exit();
    } else {
        echo "Invalid credentials. Try again.";
    }
} else {
    require_once '../src/views/loginForm.html.php';  // Show the login form
}
?>
