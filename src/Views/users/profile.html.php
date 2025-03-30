<?php 
ob_start(); // Start output buffering
use src\dal\implementations\PostDAOImpl;
$postDAO = new PostDAOImpl();
?>
<h1 class="text-center text-3xl">This is profile page</h1>
<div class="flex w-5/6 mx-auto rounded-lg"> 
    <div class="h-[800px] w-1/3 border-solid border-2 rounded-lg border-gray-300">
        <div class="mx-auto mt-8 flex items-center justify-center size-[200px] bg-gray-500 text-white rounded-full text-8xl font-bold">
            <?php if ($user->getUserImage()) : ?>
                <img src="/forum/public/<?= htmlspecialchars($user->getUserImage()) ?>" class="size-[200px] rounded-full object-cover" alt="User Profile">
            <?php else : ?>
                <?= strtoupper(substr($user->getUsername($user->getUserId()), 0, 1)) ?>
            <?php endif; ?>
        </div>
        <hr class="w-[85%] place-self-center my-8">
        <div class="flex flex-col items-center justify-center text-2xl">
            <p class="text-3xl"><?=htmlspecialchars($user->getUsername()) ?></p>
            <br>
            <p class="text-2xl">Email: <?=htmlspecialchars($user->getEmail())?></p>
            <br>
            <p class="text-2xl">Password: <?=htmlspecialchars($user->getPassword())?></p>
            <br>
            <a href="/forum/public/updateUser?user_id=<?= htmlspecialchars($user->getUserId())?>">Edit</a>
        </div>
    </div>
    <div class="ml-[4%] w-2/3 border-solid border-2 rounded-lg border-gray-300">
        <?php
        $posts = $postDAO->getPostByUserId($user->getUserId());
        ?>
        <div class="h-[800px] overflow-y-auto hide-scrollbar">
            <?php if(!empty($posts)) : ?>
                <?php foreach ($posts as $post) : ?>
                    <div class="post bg-slate-900 border-solid border-2 rounded-lg border-gray-600 m-2">
                        <!-- header of the post -->
                        <div class="post-header flex p-3">
                            <p class="size-[60px] flex items-center justify-center bg-gray-500 text-white rounded-full text-4xl font-bold">
                                <?php if ($user->getUserImage()) : ?>
                                    <img src="/forum/public/<?= htmlspecialchars($user->getUserImage()) ?>" class="size-[60px] rounded-full object-cover" alt="User Profile">
                                <?php else : ?>
                                    <?= htmlspecialchars(strtoupper(substr($user->getUsername($user->getUserId()), 0, 1))) ?>
                                <?php endif; ?>
                            </p>
                            <div class="ml-3">
                                <h3 class="text-base"><?=htmlspecialchars($user->getUsername()); ?></h3>
                                <h2 class="m-0 text-3xl leading-1"><?= htmlspecialchars($post->getTitle()) ?></h2>
                            </div>
                        </div>
                        <!-- body of the post  -->
                        <div>
                            <?=$post->getContent()?>
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