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
$currentUser = SessionManager::get('user');
$isAdmin = $currentUser->getIsAdmin();
?>
<!DOCTYPE html>
<html lang="en" class="hide-scrollbar scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars( $title)?></title>
    <link rel="stylesheet" href="/forum/public/assets/css/reset.css">
    <link rel="stylesheet" href="/forum/public/assets/css/style.css">
    <link rel="stylesheet" href="/forum/public/assets/css/input.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen text-[62.5%] text-lg box-border">
    <!-- Navigation Bar -->
    <header class="fixed top-0 w-full h-[4rem] bg-neutral-800 z-50 border-b border-solid border-gray-400 shadow-sm shadow-gray-500">
        <nav class="flex items-center h-full px-8 text-white font-semibold">
            <a class="nav-home text-2xl flex-[3] min-w-[20%] font-black text-white p-2" href="/forum/public/">Study-Hub</a>
            <input class=" bg-gray-300 flex-[6] justify-self-center min-w-[20%] text-center bg-gray-200 text-black rounded-xl" placeholder="Search bar"></input>
            <div class="flex-[1] min-w-[25%] flex justify-end items-center">
                <!-- Navigate to other functionality page -->
                <a class="p-3 rounded-xl transition duration-400 ease-in-out transform hover:scale-105 hover:bg-neutral-700 hover:shadow-lg" href="/forum/public/createPost">Add post</a>
                <a class="p-3 rounded-xl transition duration-400 ease-in-out transform hover:scale-105 hover:bg-neutral-700 hover:shadow-lg" href="/forum/public/moduleLists">Modules</a>
                <a class="p-3 rounded-xl transition duration-400 ease-in-out transform hover:scale-105 hover:bg-neutral-700 hover:shadow-lg" href="/forum/public/messageList">Messages</a>
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
                    <div id="avatar-dropdown" class="absolute  mt-2 w-48 flex flex-col justify-center text-center algin-center  bg-white text-black rounded-b-3xl shadow-lg hidden z-50">
                        <a href="/forum/public/showProfile?id=<?= $currentUser->getUserId() ?>" class="block py-2 hover:bg-gray-200">View Profile</a>
                        <a href="/forum/public/createMessagePage" class="block py-2 hover:bg-gray-200">Help & support</a>
                        <?php if($isAdmin) :?>
                            <a href="/forum/public/dashboard" class="block py-2 hover:bg-gray-200">Admin dashboard</a>
                            <a href="/forum/public/messageList" class="block py-2 hover:bg-gray-200" >Feedbacks</a>
                        <?php endif; ?>
                        <a href="/forum/public/logout" class="block py-2 hover:bg-red-500 hover:text-white rounded-b-3xl">Logout</a>
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

    <!-- Main Section -->
    <main class="flex-1 flex pt-[4rem] bg-gray-800 text-white">
        <!-- Side Menu -->
        <div class="bg-slate-900 text-white sticky top-[4rem] w-[16rem] h-[calc(100vh-4rem)] flex flex-col p-4 border-r border-solid border-gray-400 font-semibold">
            <a class="mb-2 hover:bg-stone-300" href="/forum/public/createModule">Create Module</a>
            <hr class="mb-4 mt-2">
            <a class ="side-menu-content mb-2 hover:bg-stone-300" href="/forum/public/userLists">List all user</a>
            <a class="side-menu-content mb-2 hover:bg-stone-300" href="/forum/public/signIn">Create User</a>
            <hr class="mb-4 mt-2">
            <a class="side-menu-content mb-2 hover:bg-stone-300" href="/forum/public/createMessagePage">Give Feedback</a>
            <a class="side-menu-content mb-2 hover:bg-stone-300" href="/forum/public/messageList">Feedback</a>
            <a class="flex flex-row w-[100%] side-menu-content logout mt-auto hover:bg-red-700 hover:scale-105 hover:animate-bounce p-[10px] rounded-xl items-center transition duration-400 ease-in-out transform" href="/forum/public/logout">
                <img class="w-[36px] mr-[10px]" src="/forum/public/assets/img/logout.svg" alt="logout">logout
            </a>
        
        </div>

        <!-- Main Content -->
        <div class="flex-1"> 
            <div class="post-area w-2/3 mx-auto border-gray-300 mt-[2rem]">
                <?= $content;?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-neutral-800 text-white text-center p-2 mt-auto py-6 border-t border-solid border-gray-400">
        <p>&copy; <?php echo date("Y"); ?> Forum Test. All rights reserved.</p>
    </footer>
</body>

</html>
