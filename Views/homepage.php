<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../Public/login.html.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum Home</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>You are now logged into the forum.</p>
    <a href="../Controller/logout.php">Logout</a>
</body>
</html>
