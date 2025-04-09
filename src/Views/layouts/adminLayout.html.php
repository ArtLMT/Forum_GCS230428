<?php
use src\utils\SessionManager;
use src\controllers\UserController;
use src\controllers\AdminController;

SessionManager::start();

// Check if user is logged in
if (!SessionManager::get('user')) {
    header("Location: /forum/public/login");
    exit();
}

// Get current user 
$currentUser = SessionManager::get('user');
$isAdmin = $currentUser->getIsAdmin();

$AdminController = new AdminController();
$totalUser = $AdminController->getTotalUser();

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
<body class="flex flex-col min-h-screen text-[62.5%] text-lg box-border overflow-hidden">
    <header class="w-full h-[4rem] bg-zinc-300 z-50 border-b border-solid border-zinc-400 shadow-sm shadow-gray-500">
        <nav class="flex items-center h-full px-8 text-black font-semibold">
            <a class="nav-home text-2xl flex-[3] min-w-[20%] font-black p-2" href="/forum/public/">Study-Hub</a>
            <input class=" bg-gray-300 flex-[6] justify-self-center min-w-[20%] text-center bg-gray-300 text-neutral-500 rounded-xl border-solid border-2 border-neutral-500" placeholder="Search bar"></input>
            <div class="flex-[1] min-w-[25%] flex justify-end items-center">
                <div class="relative">
                    <button id="avatar-button" class="flex items-center transition duration-400 ease-in-out transform hover:scale-110 focus:outline-none">
                        <?php if ($currentUser->getUserImage()) : ?>
                            <img src="/forum/public/<?= htmlspecialchars($currentUser->getUserImage()) ?>" class="size-[48px] rounded-full object-cover" alt="User Profile">
                        <?php else : ?>
                            <p class="flex items-center justify-center bg-gray-600 text-white rounded-full text-xl font-bold size-[48px]">
                                <?= strtoupper(substr($currentUser->getUsername($currentUser->getUserId()), 0, 1)) ?>
                            </p>
                        <?php endif; ?>
                        <p class="ml-[0.4rem]"><?= $currentUser->getUsername($currentUser->getUserId()) ?></p>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="avatar-dropdown" class="absolute mt-2 w-48 flex flex-col justify-center text-center algin-center bg-white text-black rounded-b-xl shadow-lg hidden z-50">
                        <a href="/forum/public/showProfile?id=<?= $currentUser->getUserId() ?>" class="relative flex justify-center items-center py-2 hover:bg-gray-200">
                            <img src="/forum/public/assets/img/user_black.svg" alt="" class="absolute left-2">
                            <p class="flex justify-center-safe">View Profile</p>
                        </a>
                        <!-- <a href="/forum/public/createMessagePage" class="block py-2 hover:bg-gray-200">Help & support</a> -->
                        <?php if($isAdmin) :?>
                            <a href="/forum/public/dashboard" class="relative flex justify-center items-center py-2 hover:bg-gray-200">
                                <img src="/forum/public/assets/img/admin_mode_black.svg" alt="" class="absolute left-2 size-6">
                                <p>Dashboard</p>
                            </a>
                            <a href="/forum/public/messageList" class="relative flex justify-center items-center py-2 hover:bg-gray-200" >
                                <img src="/forum/public/assets/img/feedback_black.svg" alt="" class="absolute left-2">
                                <p>Feedbacks</p>
                            </a>
                        <?php endif; ?>
                        <a href="/forum/public/logout" class="relative flex justify-center items-center py-2 hover:bg-red-500 hover:text-white rounded-b-xl">
                            <img src="/forum/public/assets/img/logout_black.svg" alt="" class="absolute left-2 size-6">
                            <p>Logout</p>
                        </a>
                    </div>
                </div>
                <script>
                    const avatarButton = document.getElementById('avatar-button');
                    const dropdownMenu = document.getElementById('avatar-dropdown');

                    avatarButton.addEventListener('click', function (e) {
                        e.stopPropagation(); // Prevent click from bubbling
                        dropdownMenu.classList.toggle('hidden');
                    });

                    // Close dropdown when clicking outside
                    document.addEventListener('click', function () {
                        if (!dropdownMenu.classList.contains('hidden')) {
                            dropdownMenu.classList.add('hidden');
                        }
                    });
                </script>
            </div>

        </nav>
    </header>
    <main class="flex">
        <!-- Sidebar -->
        <div class="flex flex-col w-[300px] bg-stone-100 h-[calc(100vh-4rem)]">
            <a class="bg-green-400"href="/forum/public/">Back to normal</a>
            <a href="/forum/public/admin/createUser">Create User</a>
        </div>

        <!-- Main content area -->
        <div class="flex flex-col mt-[2rem] mx-24 w-full text-2xl">
            <!-- Counter Section -->
            <div class="flex gap-24 mx-auto">
                <div class="flex items-center w-[300px] h-[100px] rounded-xl bg-cyan-300 border-solid border-2 border-cyan-400">
                    <div class="size-[60px] rounded-full font-bold text-3xl bg-cyan-200 mx-5 flex items-center justify-center"><?=htmlspecialchars($totalUser)?></div>
                    <a class="flex items-center justify-center" href="/forum/public/dashboard">
                        <p class="w-[120px] text-center">Users</p>
                        <img class="size-12 justify-end"src="/forum/public/assets/img/users_black.svg" alt="">
                    </a>
                </div>
                <div class="flex items-center w-[300px] h-[100px] rounded-xl bg-violet-400 border-solid border-2 border-violet-500">
                    <div class="size-[60px] rounded-full font-bold text-3xl bg-violet-200 mx-5 flex items-center justify-center">18</div>
                    <a class="flex items-center justify-center" href="">
                        <p class="w-[120px] text-center">Post</p>
                        <img class="size-12 justify-end"src="/forum/public/assets/img/post_black.svg" alt="">
                    </a>
                </div>
                <div class="flex items-center w-[300px] h-[100px] rounded-xl bg-emerald-300 border-solid border-2 border-emerald-400">
                    <div class="size-[60px] rounded-full font-bold text-3xl bg-emerald-200 mx-5 flex items-center justify-center">18</div>
                    <a class="flex items-center justify-center" href="">
                        <p class="w-[120px] text-center">Module</p>
                        <img class="size-12 justify-end"src="/forum/public/assets/img/module_black.svg" alt="">
                    </a>
                </div>
                <div class="flex items-center w-[300px] h-[100px] rounded-xl bg-orange-200 border-solid border-2 border-orange-300">
                    <div class="size-[60px] rounded-full font-bold text-3xl bg-orange-100 mx-5 flex items-center justify-center">18</div>
                    <a class="flex items-center justify-center" href="">
                        <p class="w-[120px] text-center">Feedbacks</p>
                        <img class="size-12 justify-end"src="/forum/public/assets/img/feedback_black.svg" alt="">
                    </a>
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