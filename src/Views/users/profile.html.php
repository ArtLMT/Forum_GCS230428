<?php 
ob_start(); // Start output buffering
?>
<h1>This is profile page / Update page</h1>
<?php if (isset($user) && $user !== null) : ?>
    <form action="/forum/public/updateUser" method="post">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user->getUserId()) ?>">

        <label>Username:</label>
        <input type="text" name="username" value="<?=htmlspecialchars($user->getUsername())?>">
        <br>

        <label>password:</label>
        <input type="text" name="password" value="<?=htmlspecialchars($user->getPassword())?>">
        <br>

        <label>Email:</label>
        <input type="text" name="email" value="<?=htmlspecialchars($user->getEmail())?>">
        <br>

        <input type="submit" value = "Update User">
    </form>
<?php else: ?>
    <p>Error: User not found.</p>
<?php endif; ?>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout
?>