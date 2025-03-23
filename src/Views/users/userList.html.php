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
            <div class="footer">
                <a href="/forum/public/updateUser?user_id=<?= htmlspecialchars($user->getUserId())?>">Edit</a>

                <form action="/forum/public/deleteUser" method="POST" onsubmit="return confirm('Are you sure?');">
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($user->getUserId()) ?>">
                    <button type="submit">Delete</button>
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