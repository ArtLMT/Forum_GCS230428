<?php
ob_start();
?>

<div class="bg-gray-600 h-[calc(100vh-8rem-100px)]">
    <?php if (!empty($users)) : ?>
        <!-- Header row -->
        <div class=" flex justify-center items-center grid grid-cols-5 font-bold text-white bg-gray-800 py-2 px-4"
            style="grid-template-columns: 80px 1fr 2fr 160px 1fr;" >
            <div>User ID</div>
            <div>Username</div>
            <div>Email</div>
            <div>Actions</div>
            <div>Prome</div>
        </div>

        <!-- Data rows -->
        <?php foreach ($users as $user) : ?>
            <div class="flex justify-center items-center grid grid-cols-5 bg-gray-200 text-black py-2 px-4 my-[4px] rounded-full"
            style="grid-template-columns: 80px 1fr 2fr 160px 1fr;">
                <div><?= htmlspecialchars($user->getUserId()) ?></div>
                <div><?= htmlspecialchars($user->getUsername()) ?></div>
                <div><?= htmlspecialchars($user->getEmail()) ?></div>
                <div class="flex gap-2">
                    <a class="flex justify-center bg-blue-400 px-2 py-1 size-12 rounded" href="/forum/public/admin/editUser?user_id=<?= $user->getUserId() ?>"><img class=""src="/forum/public/assets/img/editWhite.svg" alt=""></a>
                    <form action="/forum/public/deleteUser" method="POST" onsubmit="return confirm('Are you sure?');">
                        <input type="hidden" name="user_id" value="<?= $user->getUserId() ?>">
                        <button class=" flex justify-center bg-red-400 px-2 py-1 rounded size-12" type="submit"><img class="" src="/forum/public/assets/img/deleteWhite.svg" alt=""></button>
                    </form>
                </div>
                <div class=" flex justify-center items-center w-[50%] h-8 rounded-full">
                    <?php if($user->getIsAdmin()) : ?>
                        <a class="w-full h-full flex justify-center items-center rounded-full bg-red-400" href="">Demote</a>
                    <?php else : ?>
                        <a class="w-full h-full flex justify-center items-center rounded-full bg-green-400" href="">Promote</a>
                    <?php endif;?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p class="text-white px-4 py-2">No users available.</p>
    <?php endif; ?>
</div>


<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>