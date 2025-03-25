<!DOCTYPE html>
<html lang="en">
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
    <header class="fixed top-0 w-full h-[4rem] bg-neutral-800 z-50 border-b border-solid border-green-500">
        <nav class="flex items-center h-full px-16 text-white font-semibold">
            <a class="nav-home text-2xl flex-[2] min-w-[20%] font-black text-white p-2" href="/forum/public/">Study-Hub</a>
            <p class="flex-[4] min-w-[40%] text-center">Search bar</p>
            <div class="flex-[4] min-w-[40%] flex justify-end gap-16">
                <!-- navigate to other functionality page -->
                <a class="p-3 hover:bg-orange-300 rounded-xl"href="/forum/public/createPost">Add post</a>
                <a class="p-3 hover:bg-orange-300 rounded-xl"href="/forum/public/moduleLists">Modules</a>
                <a class="p-3 hover:bg-orange-300 rounded-xl"href="/forum/public/messageList">Messages</a>
                <a class="p-3 hover:bg-orange-300 rounded-xl"href="">Profile</a>
            </div>
        </nav>
    </header>

    <!-- Main Section -->
    <main class="flex-1 flex pt-[4rem] bg-gray-800 text-white">
        <!-- Side Menu -->
        <div class="bg-black text-white sticky top-[4rem] w-[16rem] h-[calc(100vh-4rem)] flex flex-col p-4 border-r border-solid border-green-500">
            <a class="mb-2 hover:bg-stone-300" href="/forum/public/createModule">Create Module</a>
            <a class="side-menu-content mb-2 hover:bg-stone-300" href="">Feedback</a>
            <hr class="mb-4 mt-2">
            <a class ="side-menu-content mb-2 hover:bg-stone-300" href="/forum/public/userLists">List all user</a>
            <a class="side-menu-content mb-2 hover:bg-stone-300" href="/forum/public/signIn">Create User</a>
            <a class="side-menu-content logout mt-auto hover:bg-stone-300" href="">Logout</a>   
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <div class="post-area p-4 w-2/3 mx-auto">
                <?php echo $content; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-neutral-800 text-white text-center p-2 mt-auto py-6 border-t border-solid border-green-500">
        <p>&copy; <?php echo date("Y"); ?> Forum Test. All rights reserved.</p>
    </footer>
</body>

</html>
