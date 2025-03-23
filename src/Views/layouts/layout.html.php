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
<body class="flex flex-col min-h-screen text-[62.5%] text-lg">
    <!-- Navigation Bar -->
    <header class="fixed top-0 w-full h-[4rem] bg-orange-400 z-50">
        <nav class="flex items-center h-full px-8 ">
            <a class="nav-home text-2xl flex-[2] min-w-[20%]" href="/forum/public/">Nerds For Nerds</a>
            <p class="flex-[4] min-w-[40%] text-center">Search bar</p>
            <div class="flex-[4] min-w-[40%] flex justify-end gap-8">

                <a href="/forum/public/createPost">Add post</a>
                <a href="/forum/public/moduleLists">Modules</a>
                <a href="">Messages</a>
                <a href="">Profile</a>
            </div>
        </nav>
    </header>

    <!-- Main Section -->
    <main class="flex-1 flex">
        <!-- Side Menu -->
        <div class="fixed left-0 top-[4rem] w-[16rem] h-[calc(100%-4rem)] flex flex-col bg-gray-800 text-white p-4">
            <p class="mb-4">This is the side menu</p>
            <a href="" class="side-menu-content mb-2">Create User</a>
            <a href="" class="side-menu-content mb-2">option_2</a>
            <a href="" class="side-menu-content mb-2">Feedback</a>
            <a href="" class="side-menu-content logout mt-auto">Logout</a>   
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-[16rem] mt-[4rem] p-4">
            <div class="post-area border-2 border-gray-300 p-4">
                <?php echo $content; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-2 mt-auto">
        <p>&copy; <?php echo date("Y"); ?> Forum Test. All rights reserved.</p>
    </footer>
</body>

</html>
