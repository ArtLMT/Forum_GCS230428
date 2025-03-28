<?php
ob_start();
?>
<h2>Update Message</h2>
<?php if (isset($message)) : ?>
    <form action="/forum/public/updateMessage" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($message->getEmailMessageId()) ?>">

        <label>Title:</label>
        <input class="text-gray-700" type="text" name="title" value="<?= htmlspecialchars($message->getTitle()) ?>" required>
        <br>

        <label>Content:</label>
        <textarea class="text-gray-700"name="content" required><?= htmlspecialchars($message->getContent()) ?></textarea>
        <br>

        <input type="submit" value="Update Message">
    </form>
<?php else: ?>
    <p>Error: Message not found.</p>
<?php endif; ?>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout
?>
