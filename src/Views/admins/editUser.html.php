<?php 
ob_start();
?>

<h1 class="text-center text-3xl">Update page by Admin</h1>
<?php if (isset($user) && $user !== null) : ?>
    
    <form action="/forum/public/admin/updateUser" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user->getUserId()) ?>">

        <label>Username:</label>
        <input class="text-gray-700" type="text" name="username" value="<?=htmlspecialchars($user->getUsername())?>">
        <br>

        <label>password:</label>
        <input class="text-gray-700" type="text" name="password" value="<?=htmlspecialchars($user->getPassword())?>">
        <br>

        <label>Email:</label>
        <input class="text-gray-700" type="text" name="email" value="<?=htmlspecialchars($user->getEmail())?>">
        <br>

        <?php if ($user->getUserImage()) : ?>
            <img src="/forum/public/<?=$user->getUserImage()?>" alt="">
            <p>Current image</p>
            <label>
                <input type="checkbox" name="remove_image" value ="1">
                remove this image
            </label>
            <br>
        <?php endif; ?>

        <label>Upload profile picture</label>
        <input type="file" name="image">
        <br>

        <input class="p-2 border-2 rounded-xl text-center"type="submit" value = "Update User">
    </form>
<?php else: ?>
    <p>Error: User not found.</p>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>