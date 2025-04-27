<?php
use src\utils\SessionManager;
use src\controllers\UserController;
use src\controllers\AdminController;

SessionManager::start();

// Get current user 
$currentUser = SessionManager::get('user');
$isAdmin = $currentUser->getIsAdmin();

$AdminController = new AdminController();
$totalUser = $AdminController->countTotalUser();
$totalPost = $AdminController->countTotalPost();
$totalModule = $AdminController->countTotalModule();
$totalFeedback = $AdminController->countTotalEmailMessage();

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
<body class="flex flex-col min-h-screen text-[62.5%] text-lg box-border overflow-hidden bg-slate-700">
    <header class="bg-gradient-to-r from-[#0a1225] to-[#6c8dc2] shadow-sm w-full h-[4rem] z-50 border-b border-solid border-zinc-400 shadow-sm shadow-gray-500">
        <nav class="flex items-center h-full px-8 text-slate-100 font-semibold">
            <a class="nav-home text-2xl p-2 text-shadow-white text-shadow-lg" href="/forum/public/">StudyRoom</a>
            <!-- <input class=" bg-gray-300 flex-[6] justify-self-center min-w-[20%] text-center bg-gray-300 text-neutral-500 rounded-xl border-solid border-2 border-neutral-500" placeholder="Search bar"></input> -->
            <div class="flex-[1] min-w-[25%] flex justify-end items-center mr-[3rem]">
                <div class="relative">
                    <button id="avatar-button" class="flex items-center transition duration-400 ease-in-out transform hover:scale-110 focus:outline-none">
                        <?php if ($currentUser->getUserImage()) : ?>
                            <img src="/forum/public/<?= htmlspecialchars($currentUser->getUserImage()) ?>" class="size-[48px] rounded-full object-cover" alt="User Profile">
                        <?php else : ?>
                            <p class="flex items-center justify-center bg-gray-600 text-white rounded-full text-xl font-bold size-[48px]">
                                <?= strtoupper(substr($currentUser->getUsername($currentUser->getUserId()), 0, 1)) ?>
                            </p>
                        <?php endif; ?>
                        <!-- Down Arrow Icon -->
                        <svg class="relative right-4 top-4 size-4 text-white bg-gray-800 rounded-full p-0.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                        <p class="ml-[0.4rem]"><?= $currentUser->getUsername($currentUser->getUserId()) ?></p>
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
                                <img src="/forum/public/assets/img/user_black.svg" class="size-6 mr-3"/>
                                View Profile
                            </a>
  
                            
                                <a href="/forum/public/admin/listFeedback" class="flex items-center px-4 py-3 hover:bg-indigo-100">
                                    <img src="/forum/public/assets/img/feedback_black.svg" class="size-6 mr-3" />
                                    Feedbacks
                                </a>
                                <a href="/forum/public/" class="flex items-center px-4 py-3 hover:bg-indigo-100">
                                    <img src="/forum/public/assets/img/admin_mode_black.svg" class="size-6 mr-3" />
                                    Normal mode
                                </a>

                            <a href="/forum/public/logout" class="flex items-center px-4 py-3 hover:bg-red-600 hover:text-white rounded-b-xl">
                                <img src="/forum/public/assets/img/logout_black.svg" class="size-7 mr-3" />
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </nav>
    </header>
    <main class="flex">
        <!-- Side Menu -->
        <div class="bg-gray-900 text-white sticky top-[4rem] w-[16rem] h-[calc(100vh-4rem)] pt-4 flex flex-col border-r border-solid border-gray-700 text-lg font-semibold">
            <!-- <a href="/forum/public/admin/createUser">Create User</a> -->
            <!-- Header -->
            <div class="px-4 py-2">
                <h2 class="text-xl font-bold">Forum Manager</h2>
                <p class="text-sm text-gray-400">Admin Dashboard</p>
            </div>

            <!-- Dashboard Section -->
            <div class="mt-4">
                <p class="text-xs px-4 py-2 text-gray-400 uppercase">Dashboard</p>
                <a class="flex items-center hover:bg-gray-700 py-2 px-4" href="/forum/public/dashboard">
                    <img src="/forum/public/assets/img/home_white.svg" alt="" class="size-5 mr-3">
                    <p>Overview</p>
                </a>
            </div>

            <!-- Content Management Section -->
            <div class="mt-4">
                <p class="text-xs px-4 py-2 text-gray-400 uppercase">Content Management</p>
                <a class="flex items-center hover:bg-gray-700 py-2 px-4" href="/forum/public/admin/showPostList">
                    <img class="size-5 mr-3" src="/forum/public/assets/img/post_white.svg" alt="">
                    <p>Posts</p>
                </a>
                <a class="flex items-center hover:bg-gray-700 py-2 px-4" href="/forum/public/admin/showCreatePost">
                    <img class="size-5 mr-3" src="/forum/public/assets/img/add_post_white.svg" alt="">
                    <p>Add Posts</p>
                </a>
                <a class="flex items-center hover:bg-gray-700 py-2 px-4" href="/forum/public/dashboard">
                    <img class="size-5 mr-3" src="/forum/public/assets/img/users_white.svg" alt="">
                    <p>Users</p>
                </a>
                <a class="flex items-center hover:bg-gray-700 py-2 px-4" href="/forum/public/admin/createUser">
                    <img class="size-5 mr-3" src="/forum/public/assets/img/add_user_white.svg" alt="">
                    <p>Add User</p>
                </a>
                <a class="flex items-center hover:bg-gray-700 py-2 px-4" href="/forum/public/admin/showModuleList">
                    <img class="size-5 mr-3"src="/forum/public/assets/img/module_white.svg" alt="">
                    <p>Modules</p>
                </a>
                <a class="flex items-center hover:bg-gray-700 py-2 px-4" href="/forum/public/admin/showCreateModule">
                    <img class="size-5 mr-3"src="/forum/public/assets/img/module_white.svg" alt="">
                    <p>Create Modules</p>
                </a>
                <a class="flex items-center hover:bg-gray-700 py-2 px-4" href="/forum/public/admin/listFeedback">
                    <img class="size-5 mr-3"src="/forum/public/assets/img/feedback_white.svg" alt="">
                    <p>Feedbacks</p>
                </a>
            </div>
            <!-- Logout (at the bottom) -->
            <a class="flex items-center hover:bg-red-600 py-2 px-4 mt-auto mb-4" href="/forum/public/logout">
                <svg class="size-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                <p>Logout</p>
            </a>
        </div>
        <!-- Main content area -->
        <div class="flex flex-col mt-[2rem] mx-16 w-full text-2xl">
            <!-- Counter Section -->
            <div class="flex gap-16 font-semibold">
                <div class="flex items-center w-[350px] h-[100px] rounded-xl bg-gray-900 border-solid border-2 border-cyan-400">
                    <a class="flex items-center justify-center" href="/forum/public/dashboard">
                        <div class="size-[60px] rounded-full font-bold text-3xl bg-cyan-200 mx-5 flex items-center justify-center"><?=htmlspecialchars($totalUser)?></div>
                        <p class="w-[160px] text-center text-white">Users</p>
                        <img class="size-12 justify-end"src="/forum/public/assets/img/users_white.svg" alt="">
                    </a>
                </div>
                <div class="flex items-center w-[350px] h-[100px] rounded-xl bg-gray-900 border-solid border-2 border-violet-500">
                    <a class="flex items-center justify-center" href="/forum/public/admin/showPostList">
                        <div class="size-[60px] rounded-full font-bold text-3xl bg-violet-200 mx-5 flex items-center justify-center"><?=htmlspecialchars($totalPost)?></div>
                        <p class="w-[160px] text-center text-white">Post</p>
                        <img class="size-12 justify-end" src="/forum/public/assets/img/post_white.svg" alt="">
                    </a>
                </div>
                <div class="flex items-center w-[350px] h-[100px] rounded-xl bg-gray-900 border-solid border-2 border-emerald-400">
                    <a class="flex items-center justify-center" href="/forum/public/admin/showModuleList">
                        <div class="size-[60px] rounded-full font-bold text-3xl bg-emerald-200 mx-5 flex items-center justify-center"><?=htmlspecialchars($totalModule)?></div>
                        <p class="w-[160px] text-center text-white">Module</p>
                        <img class="size-12 justify-end"src="/forum/public/assets/img/module_white.svg" alt="">
                    </a>
                </div>
                <div class="flex items-center w-[350px] h-[100px] rounded-xl bg-gray-900 border-solid border-2 border-orange-300">
                    <a class="flex items-center w-full" href="/forum/public/admin/listFeedback">
                        <div class="size-[60px] rounded-full font-bold text-3xl bg-orange-100 mx-5 flex items-center justify-center"><?= htmlspecialchars($totalFeedback)?></div>
                        <p class="w-[160px] text-center text-white">Feedbacks</p>
                        <img class="size-12 justify-end"src="/forum/public/assets/img/feedback_white.svg" alt="">
                    </a>
                </div>
            </div>

            <!-- Dynamic Content Section -->
            <div class="block mt-[2rem]">
                <?= $content ?>
            </div>
        </div>
    </main>
    <script src="/forum/public/assets/js/script.js"></script>
</body>
</html>