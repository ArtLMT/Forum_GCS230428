<?php
session_start();

// Dummy user data for testing without a database
$users = [
    'john_doe' => 'password123', 
    'jane_doe' => 'mypassword'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username exists and password matches
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['username'] = $username;
        header("Location: ../Views/homepage.php"); // Redirect to homepage
        exit();
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: ../Public/login.html.php");
        exit();
    }
}
?>
