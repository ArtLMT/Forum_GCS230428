<?php 
ob_start(); // Start output buffering
use src\dal\implementations\PostDAOImpl;
use src\controllers\AuthController;
use src\utils\SessionManager;
$postDAO = new PostDAOImpl();

$title = $userName;
?>
<!-- <h1 class="text-center text-3xl">This is profile page</h1> -->
<div class="flex w-5/6 mx-auto rounded-lg my-[40px]"> 
    <div class="h-[840px] bg-slate-900 w-1/3 border-solid border-2 rounded-lg border-gray-400">
        <div class="mx-auto mt-8 flex items-center justify-center size-[200px] bg-gray-600 text-white rounded-full text-8xl font-bold">
            <?php if ($userImage) : ?>
                <img src="/forum/public/<?= htmlspecialchars($userImage) ?>" class="size-[200px] rounded-full object-cover" alt="User Profile">
            <?php else : ?>
                <?= strtoupper(substr($userName, 0, 1)) ?>
            <?php endif; ?>
        </div>
        <hr class="w-[85%] place-self-center my-8">
        <div class="flex flex-col items-center justify-center text-2xl">
            <p class="text-3xl"><?=htmlspecialchars($user->getUsername()) ?></p>
            <br>
            <p class="text-2xl">Email: <?=htmlspecialchars($userMail)?></p>
            <br>
            <p class="text-2xl">Password: <?=htmlspecialchars($password)?></p>
            <br>
            <a href="/forum/public/updateUser?user_id=<?= htmlspecialchars($user->getUserId())?>">Edit</a>
        </div>
    </div>
    <!-- User's post container -->
    <div class="ml-[4%] w-2/3 border-solid border-2 rounded-lg border-gray-400">
        <div class="h-[840px] overflow-y-auto hide-scrollbar">
            <?php if(!empty($posts)) : ?>
                <?php foreach ($posts as $post) : ?>
                    <div class="post bg-slate-900 border-solid border-2 rounded-lg border-gray-600 m-2 hover:border-gray-300 duration-700 ease-in-out transform hover:scale-95">
                        <!-- header of the post -->
                        <div class="post-header flex m-3">
                            <p class="size-[60px] flex items-center justify-center bg-gray-500 text-white rounded-full text-4xl font-bold">
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
                        <?php if($authController->isOwner($userId)) :?>
                            <div class="flex gap-4 justify-end text-center mr-5 mb-[1rem]">
                                <a class="bg-green-400 border-solid border-gray-600 border-2 p-1 w-14 text-xs" href="/forum/public/update?id=<?= htmlspecialchars($post->getPostId()) ?>">Edit</a>
                                <a class="bg-red-400 border-solid border-red-500 border-2 p-1 w-14 text-xs" href="/forum/public/delete?id=<?= htmlspecialchars($post->getPostId()) ?>" onclick="return confirm('Are you sure?');">Delete</a>
                            </div>
                        <?php endif; ?>
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