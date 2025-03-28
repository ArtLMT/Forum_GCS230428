<?php 
ob_start(); // Start output buffering
?>
<h1 class="text-center text-3xl">This is profile page</h1>
<div class="flex w-5/6 mx-auto border-solid border-2 rounded-lg border-green-700"> 
    <div class="h-[800px] w-1/3 border-solid border-2 rounded-lg border-green-200">
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
    <div class="ml-[4%] w-2/3 border-solid border-2 rounded-lg border-green-200">
        User's post
    </div>
    <!-- <img class="min-w-[200px]" src="/forum/public/<?=$user->getUserImage()?>" alt="profile picture"> -->
</div>


<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout
?>