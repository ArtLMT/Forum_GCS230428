<?php
use src\utils\SessionManager;
use src\controllers\UserController;
SessionManager::start();

// Check if user is logged in
if (!SessionManager::get('user')) {
    header("Location: /forum/public/login");
    exit();
}

// Get current user
// $userController = new UserController();
$currentUser = SessionManager::get('user');
$isAdmin = $currentUser->getIsAdmin();

// if (!$currentUser) {
//     header("Location: /forum/public/login");
//     exit();
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars( $title)?></title>
    <link rel="stylesheet" href="/forum/public/assets/css/reset.css">
    <link rel="stylesheet" href="/forum/public/assets/css/style.css">
    <link rel="stylesheet" href="/forum/public/assets/css/input.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header class="min-h-[4rem] bg-gray-400">
        <h1>Study hub</h1>
    </header>
    <main class="flex">
        <!-- Sidebar -->
        <div class="w-[200px] bg-gray-600 h-[calc(100vh-4rem)]">
            <a class="bg-green-400"href="/forum/public/">Back to normal</a>
        </div>

        <!-- Main content area -->
        <div class="flex flex-col mt-[2rem] mx-24 w-full">
            <!-- Counter Section -->
            <div class="flex gap-24">
                <div class="flex items-center w-[300px] h-[100px] rounded-3xl bg-gray-400">
                    <div class="w-[40px] h-[40px] bg-blue-300 mx-5 flex items-center">counter</div>
                    <a class="" href="">User</a>
                </div>
                <div class="flex items-center w-[300px] h-[100px] rounded-3xl bg-gray-400">
                    <div class="w-[40px] h-[40px] bg-blue-300 mx-5 flex items-center">counter</div>
                    <a class="" href="">Post</a>
                </div>
                <div class="flex items-center w-[300px] h-[100px] rounded-3xl bg-gray-400">
                    <div class="w-[40px] h-[40px] bg-blue-300 mx-5 flex items-center">counter</div>
                    <a class="" href="">Module</a>
                </div>
            </div>

            <!-- Dynamic Content Section -->
            <div class="block mt-[2rem]">
                <?= $content ?>
            </div>
        </div>
    </main>
</body>
</html>