<?php
use src\utils\SessionManager;
SessionManager::start();

// Check if user is logged in
if (!SessionManager::get('user_id')) {
    header("Location: /forum/public/login");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en" class="hide-scrollbar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="/forum/public/assets/css/reset.css">
    <link rel="stylesheet" href="/forum/public/assets/css/style.css">
    <link rel="stylesheet" href="/forum/public/assets/css/input.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen text-[62.5%] text-lg box-border">
    <!-- Navigation Bar -->
    <header class="fixed top-0 w-full h-[4rem] bg-neutral-800 z-50 border-b border-solid border-gray-400 shadow-sm shadow-gray-500">
        <nav class="flex items-center h-full px-16 text-white font-semibold">
            <a class="nav-home text-2xl flex-[2] min-w-[20%] font-black text-white p-2" href="/forum/public/">Study-Hub</a>
            <p class="flex-[4] min-w-[40%] text-center bg-gray-200 text-black rounded-xl">Search bar</p>
            <div class="flex-[4] min-w-[40%] flex justify-end gap-2">
                <!-- Navigate to other functionality page -->
                <a class="p-3 rounded-xl transition duration-400 ease-in-out transform hover:scale-105 hover:bg-neutral-700 hover:shadow-lg" href="/forum/public/createPost">Add post</a>
                <a class="p-3 rounded-xl transition duration-400 ease-in-out transform hover:scale-105 hover:bg-neutral-700 hover:shadow-lg" href="/forum/public/moduleLists">Modules</a>
                <a class="p-3 rounded-xl transition duration-400 ease-in-out transform hover:scale-105 hover:bg-neutral-700 hover:shadow-lg" href="/forum/public/messageList">Messages</a>
                <a class="p-3 rounded-xl transition duration-400 ease-in-out transform hover:scale-105 hover:bg-neutral-700 hover:shadow-lg" href="">Profile</a>
            </div>

        </nav>
    </header>

    <!-- Main Section -->
    <main class="flex-1 flex pt-[4rem] bg-gray-800 text-white">
        <!-- Side Menu -->
        <div class="bg-slate-900 text-white sticky top-[4rem] w-[16rem] h-[calc(100vh-4rem)] flex flex-col p-4 border-r border-solid border-gray-400">
            <a class="mb-2 hover:bg-stone-300" href="/forum/public/createModule">Create Module</a>
            <hr class="mb-4 mt-2">
            <a class ="side-menu-content mb-2 hover:bg-stone-300" href="/forum/public/userLists">List all user</a>
            <a class="side-menu-content mb-2 hover:bg-stone-300" href="/forum/public/signIn">Create User</a>
            <hr class="mb-4 mt-2">
            <a class="side-menu-content mb-2 hover:bg-stone-300" href="/forum/public/createMessagePage">Give Feedback</a>
            <a class="side-menu-content mb-2 hover:bg-stone-300" href="/forum/public/messageList">Feedback</a>
            <a class="side-menu-content logout mt-auto hover:bg-stone-300" href="/forum/public/logout">Logout</a>   
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <div class="post-area">
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
