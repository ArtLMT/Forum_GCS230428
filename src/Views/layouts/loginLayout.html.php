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
    <link rel="stylesheet" href="/forum/public/assets/css/input.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body>
    <div class="login-container h-[100vh] flex items-center justify-center bg-gradient-to-r from-purple-400 via-pink-500 to-red-500">
        <div class="relative">
            <div class="absolute -top-2 -left-2 -right-2 -bottom-2 rounded-lg bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 shadow-lg animate-pulse"></div>
            <!-- form container -->
            <div class="bg-white p-16 rounded-lg shadow-2xl w-80 relative z-10 transform transition duration-500 ease-in-out">
                <?= $form ?>
                <!-- <h2 class="text-center text-3xl font-bold mb-10 text-gray-800">Login</h2>
                <?php if (SessionManager::get('error')): ?>
                    <p class="error"><?php echo SessionManager::get('error'); SessionManager::remove('error'); ?></p>
                <?php endif; ?>
                <form class="space-y-5" action="/forum/public/login" method="POST">
                    <input class="w-full h-12 border border-gray-800 px-3 rounded-lg" type="email" name="email" placeholder="Email" required>
                    <input class="w-full h-12 border border-gray-800 px-3 rounded-lg" type="password" name="password" placeholder="Password" required>
                    <button class="w-full h-12 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Login</button>
                </form>
                <p>Don't have an account? <a href="/forum/public/signIn">Sign Up</a></p> -->
            </div>
        </div>
    </div>
</body>
</html>
