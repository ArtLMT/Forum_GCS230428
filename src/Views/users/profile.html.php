<?php 
ob_start(); // Start output buffering
use src\dal\implementations\PostDAOImpl;
// use src\controllers\AuthController;
// use src\utils\SessionManager;
$postDAO = new PostDAOImpl();

$title = $userName;
// echo $userIsAdmin;
?>
<!-- <h1 class="text-center text-3xl">This is profile page</h1> -->
<div class="flex w-[120%] relative right-[10%] mx-auto rounded-lg my-[40px]"> 
    <div class="h-[840px] bg-white w-1/3 border-solid border-2 rounded-lg border-indigo-300">
        <div class="mx-auto mt-8 flex items-center justify-center size-[200px] bg-gray-600 text-gray-300 rounded-full text-8xl font-bold">
            <?php if ($userImage) : ?>
                <img src="/forum/public/<?= htmlspecialchars($userImage) ?>" class="size-[200px] rounded-full object-cover" alt="User Profile">
            <?php else : ?>
                <?= strtoupper(substr($userName, 0, 1)) ?>
            <?php endif; ?>
        </div>
        <hr class="w-[85%] place-self-center my-8">
        <div class="flex flex-col items-center justify-center text-2xl">
            <p class="text-3xl"><?=htmlspecialchars($user->getUsername()) ?>
                <a class="ml-[10px] absolute"href="/forum/public/updateUser?user_id=<?= htmlspecialchars($user->getUserId())?>">
                    <img src="/forum/public/assets/img/edit_black.svg" alt="">
                </a>
            </p>
            <br>
            <p class="text-2xl">Email: <?=htmlspecialchars($userMail)?></p>
            <br>
            <p class="text-2xl">Password: <?=htmlspecialchars($password)?></p>
            <br>
        </div>
    </div>
    <!-- User's post container -->
    <div class="ml-[4%] w-2/3 border-solid border-2 rounded-lg border-indigo-300">
        <div class="h-[840px] overflow-y-auto hide-scrollbar">
            <?php if(!empty($posts)) : ?>
                <?php foreach ($posts as $post) : ?>
                    <div class="post bg-white border-solid border-2 rounded-lg border-indigo-200 shadow-xl m-2 hover:border-indigo-700 duration-700 ease-in-out transform hover:scale-95">
                        <!-- header of the post -->
                        <div class="post-header flex m-3">
                            <p class="size-[60px] flex items-center justify-center bg-gray-500 text-gray-300 rounded-full text-4xl font-bold">
                                <?php if ($userImage) : ?>
                                    <img src="/forum/public/<?= htmlspecialchars($userImage) ?>" class="size-[60px] rounded-full object-cover" alt="User Profile">
                                <?php else : ?>
                                    <?= htmlspecialchars(strtoupper(substr($userName, 0, 1))) ?>
                                <?php endif; ?>
                            </p>
                            <div class="ml-3">
                                <h3 class="text-base"><?=htmlspecialchars($user->getUsername()); ?></h3>
                                <h2 class="m-0 text-3xl leading-1"><?= htmlspecialchars($post->getTitle()) ?></h2>
                            </div>
                        </div>
                        <!-- body of the post  -->
                        <div class="truncate w-96 ml-4">
                            <?=$post->getContent()?>
                        </div>
                        <!-- Auth check -->
                         <div class="flex gap-4 justify-end items-center mr-5 mb-[1rem] text-slate-700">
                            <a class="p-2 hover:italic hover:text-gray-900"href="/forum/public/postDetail?post_id=<?= $post->getPostId()?>">See more</a>
                            <?php if(($isOwner)) :?>
                                 <a class="flex justify-center bg-green-400 border-solid border-green-600 border-2 p-1 size-8 text-xs" href="/forum/public/update?id=<?= htmlspecialchars($post->getPostId()) ?>"><img class=""src="/forum/public/assets/img/editWhite.svg" alt=""></a>
                                 <a class="bg-red-400 border-solid border-red-500 border-2 p-1 size-8 text-xs" href="/forum/public/delete?id=<?= htmlspecialchars($post->getPostId()) ?>" onclick="return confirm('Are you sure?');"><img class="" src="/forum/public/assets/img/deleteWhite.svg" alt=""></a>
                            <?php endif; ?>
                         </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout
?>