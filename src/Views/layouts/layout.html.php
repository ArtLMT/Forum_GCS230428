<?php
use src\utils\SessionManager;
use src\controllers\UserController;
SessionManager::start();

if (!SessionManager::get('user')) {
    header("Location: /forum/public/login");
    exit();
}

$currentUser = SessionManager::get('user');
$isAdmin = $currentUser->getIsAdmin();
?>
<!DOCTYPE html>
<html lang="en" class="hide-scrollbar scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="/forum/public/assets/css/reset.css">
    <link rel="stylesheet" href="/forum/public/assets/css/style.css">
    <link rel="stylesheet" href="/forum/public/assets/css/input.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen text-[62.5%] text-lg box-border bg-slate-100 text-slate-800">

    <!-- Navigation Bar -->
    <header class="fixed top-0 w-full h-[4rem] bg-indigo-700 z-50 border-b border-solid border-indigo-800 shadow-sm shadow-indigo-500">
        <nav class="flex items-center h-full px-12 text-white font-semibold">
            <a class="text-2xl flex-[3] min-w-[20%] font-black p-2" href="/forum/public/">Study-Hub</a>
            <input class="bg-slate-100 text-slate-800 flex-[6] text-center rounded-xl" placeholder="Search bar" />
            <div class="flex-[1] min-w-[25%] flex justify-end items-center mr-[3rem]">
                <a class="p-3 rounded-xl hover:bg-indigo-600 hover:shadow-md" href="/forum/public/moduleLists">Modules</a>
                <a class="p-3 rounded-xl hover:bg-indigo-600 hover:shadow-md" href="/forum/public/messageList">Messages</a>
                <div class="relative ml-[1rem]">
                    <button id="avatar-button" class="flex items-center hover:scale-110 focus:outline-none">
                        <?php if ($currentUser->getUserImage()) : ?>
                            <img src="/forum/public/<?= htmlspecialchars($currentUser->getUserImage()) ?>" class="size-[48px] rounded-full object-cover" alt="User Profile">
                        <?php else : ?>
                            <p class="flex items-center justify-center bg-indigo-600 shadow-2xl text-white rounded-full text-xl font-bold size-[48px] border-2 border-solid border-blue-900">
                                <?= strtoupper(substr($currentUser->getUsername($currentUser->getUserId()), 0, 1)) ?>
                            </p>
                        <?php endif; ?>
                    </button>
                    <div id="avatar-dropdown" class="absolute right-0 mt-2 w-64 bg-white text-slate-800 rounded-xl shadow-xl hidden z-50 overflow-hidden">
                        <!-- User Info at Top -->
                        <div class="flex items-center gap-3 px-4 py-3 border-b border-slate-200">
                            <?php if ($currentUser->getUserImage()) : ?>
                                <img src="/forum/public/<?= htmlspecialchars($currentUser->getUserImage()) ?>" class="size-12 rounded-full object-cover" />
                            <?php else : ?>
                                <div class="size-12 bg-indigo-600 text-white flex items-center justify-center rounded-full text-xl font-bold">
                                    <?= strtoupper(substr($currentUser->getUsername($currentUser->getUserId()), 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                            <div>
                                <p class="text-base font-semibold"><?= $currentUser->getUsername($currentUser->getUserId()) ?></p>
                                <p class="text-sm text-gray-500"><?= $isAdmin ? 'Admin' : 'Student' ?></p>
                            </div>
                        </div>

                        <!-- Dropdown Options -->
                        <div class="flex flex-col text-left">
                            <a href="/forum/public/showProfile?id=<?= $currentUser->getUserId() ?>" class="flex items-center px-4 py-3 hover:bg-indigo-100">
                                <img src="/forum/public/assets/img/user_black.svg" class="size-6 mr-3" />
                                View Profile
                            </a>
                            <a href="/forum/public/createMessagePage" class="flex items-center px-4 py-3 hover:bg-indigo-100">
                                <img src="/forum/public/assets/img/contact_black.svg" class="size-6 mr-3" />
                                Contact
                            </a>
                            <?php if($isAdmin): ?>
                                <a href="/forum/public/messageList" class="flex items-center px-4 py-3 hover:bg-indigo-100">
                                    <img src="/forum/public/assets/img/feedback_black.svg" class="size-6 mr-3" />
                                    Feedbacks
                                </a>
                                <a href="/forum/public/dashboard" class="flex items-center px-4 py-3 hover:bg-indigo-100">
                                    <img src="/forum/public/assets/img/admin_mode_black.svg" class="size-6 mr-3" />
                                    Admin mode
                                </a>
                            <?php endif; ?>
                            <a href="/forum/public/logout" class="flex items-center px-4 py-3 hover:bg-red-600 hover:text-white rounded-b-xl">
                                <img src="/forum/public/assets/img/logout_black.svg" class="size-7 mr-3" />
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
                <script>
                    const avatarButton = document.getElementById('avatar-button');
                    const dropdownMenu = document.getElementById('avatar-dropdown');

                    avatarButton.addEventListener('click', function (e) {
                        e.stopPropagation();
                        dropdownMenu.classList.toggle('hidden');
                    });

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
    <main class="flex-1 flex pt-[4rem] bg-slate-100 text-slate-800">
        <!-- Side Menu -->
        <div class="bg-white sticky top-[4rem] w-[16rem] h-[calc(100vh-4rem)] pt-4 flex flex-col border-r border-solid border-slate-300 text-xl font-semibold">
            <a href="/forum/public/createPost"
            class="group relative flex items-center justify-center bg-emerald-400 hover:bg-emerald-600 h-[40px] rounded-full text-stone-100 py-3">
                <img src="/forum/public/assets/img/add_post_black.svg"
                    class="absolute left-6 size-8 group-hover:hidden" alt="Add Post" />
                <img src="/forum/public/assets/img/add_post_white.svg"
                    class="absolute left-6 size-8 hidden group-hover:block" alt="Add Post Hover" />
                <p class="ps-2">Add post</p>
            </a>
            <a class="flex justify-start items-center hover:bg-violet-100 py-3" href="/forum/public/createModule">
                <p class="ps-2">Create Module</p>
            </a>
            <a class="flex justify-start items-center hover:bg-violet-100 py-3" href="/forum/public/userLists">
                <p class="ps-2">List all user</p>
            </a>
            <a class="flex justify-start items-center hover:bg-violet-100 py-3" href="/forum/public/signIn">
                <p class="ps-2">Create User</p>
            </a>
            <a class="flex justify-start items-center hover:bg-violet-100 py-3" href="/forum/public/createMessagePage">
                <p class="ps-2">Give Feedback</p>
            </a>
            <a class="flex justify-start items-center hover:bg-violet-100 py-3" href="/forum/public/messageList">
                <p class="ps-2">Feedback</p>
            </a>
            <a class="group relative flex flex justify-start items-center w-full mt-auto py-3 hover:bg-red-600 hover:text-white p-[10px] rounded-xl transition duration-400 ease-in-out transform" href="/forum/public/logout">
                <img class="absolute left-6 size-8 group-hover:hidden" src="/forum/public/assets/img/logout_black.svg" alt="logout">
                <img class="absolute left-6 size-8 hidden group-hover:block" src="/forum/public/assets/img/logout_white.svg" alt="logout">
                <p class="ml-[35%]">Logout</p>
            </a>
        </div>

        <!-- Main Content -->
        <div class="flex-1"> 
            <div class="post-area w-2/3 mx-auto border-slate-300 mt-[2rem]">
                <?= $content; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-indigo-700 text-white text-center p-2 mt-auto py-6 border-t border-solid border-indigo-800">
        <p>&copy; <?php echo date("Y"); ?> Forum Test. All rights reserved.</p>
    </footer>
</body>
</html>
