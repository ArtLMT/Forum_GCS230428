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
    <div class="login-container h-[100vh] flex items-center justify-center bg-gradient-to-r from-[#112042] via-[#3f62b5] to-[#6c8dc2]">
        <div class="relative">
            <div class="absolute -top-2 -left-2 -right-2 -bottom-2 rounded-lg bg-gradient-to-r from-[#e027e3] via-[#a80f94] to-[#bf0885] shadow-lg animate-pulse">

            </div>
            <!-- form container -->
            <div class="h-[450px] w-[500px] bg-white p-16 rounded-lg shadow-2xl relative z-10 transform transition duration-500 ease-in-out flex flex-col justify-center">                    <?= $form ?>
            </div>
        </div>
    </div>
    <script src="/forum/public/assets/js/script.js"></script>
</body>
</html>
