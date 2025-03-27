<?php
ob_start();
?>
<h2>Update Message</h2>
<?php if (!isset($message) && $message === null): ?>
    <form action="/forum/public/updateMessage" method="post" enctype="multipart/form-data">
        <input type="hidden" name="email_id" value="<?= htmlspecialchars($message->getEmailMessageId()) ?>">

        <label>title:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($message->getTitle()) ?>" required><br>

        <label>Content:</label>
        <textarea name="content" value="<?= htmlspecialchars($message->getContent()) ?>" required></textarea><br>

        <input type="submit" value="Update Message">
    </form>
<?php else: ?>
    <p>Error: Message not found.</p>
<?php endif; ?>
<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/layouts/layout.html.php';
?>