<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../Public/Assets/reset.css">
    <link rel="stylesheet" href="../Public/Assets/style.css">
</head>
<body>
    <h2>Login to Your Forum</h2>
    <div class='loginform'>
        <form action="../Controller/login.php" method="POST">

            <label class="label_login" for="username">Username:</label><br>
            <input type="text" name="username" required><br><br>
    
            <label class="label_login" for="password">Password:</label><br>
            <input type="password" name="password" required><br><br>
    
            <input type="submit" value="Login">
        </form>
    </div>

    <?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>
</body>
</html>
