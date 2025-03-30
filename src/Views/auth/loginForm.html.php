<?php
use src\utils\SessionManager;
SessionManager::start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/public/assets/css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (SessionManager::get('error')): ?>
            <p class="error"><?php echo SessionManager::get('error'); SessionManager::remove('error'); ?></p>
        <?php endif; ?>
        <form action="/forum/public/login" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="/forum/public/signIn">Sign Up</a></p>
    </div>
</body>
</html>
