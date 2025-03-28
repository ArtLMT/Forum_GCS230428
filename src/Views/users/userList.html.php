<?php
ob_start();
?>

<?php if (!empty($users)) : ?>
    <div>
        <?php foreach ($users as $user) : ?>
            <p>getUserId</p>
            <div><?= htmlspecialchars($user->getUserId()) ?></div>
            <br>
            
            <p>getUsername</p>
            <div><?= htmlspecialchars($user->getUsername()) ?></div>
            <br>

            <p>getEmail</p>
            <div><?=htmlspecialchars($user->getEmail())?></div>
            <br>

            <p>getPassword</p>
            <div><?=htmlspecialchars($user->getPassword())?></div>
            <br>
            
            <?php if ($user->getUserImage()) : ?>
                <p>Profile Picture</p>
                <img src="/forum/public/<?=$user->getUserImage()?>" alt="Profile picture">
            <?php endif ?>

            <div class="flex gap-4 justify-end text-center">
                <a class="bg-green-400 border-solid border-green-500 border-2 p-2 w-20"href="/forum/public/updateUser?user_id=<?= htmlspecialchars($user->getUserId())?>">Edit</a>
                <form action="/forum/public/deleteUser" method="POST" onsubmit="return confirm('Are you sure?');">
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user->getUserId()) ?>">
                    <button class="bg-red-400 p-2 w-20 border-solid border-red-500 border-2" type="submit">Delete</button>
                </form>
            </div>
            <p>======================================</p>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>No users available.</p>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout file to render the page
?>