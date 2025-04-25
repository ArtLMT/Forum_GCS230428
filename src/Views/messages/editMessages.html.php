label<?php
ob_start();
?>
<?php if (isset($message)) : ?>
    <div class="max-w-xl mx-auto mt-1 p-4 bg-white rounded-2xl shadow-md space-y-4 bg-gray-50">
        <form action="/forum/public/updateMessage" method="post" enctype="multipart/form-data" class="space-y-5">
            <h2 class="text-2xl font-bold text-center text-gray-800">Edit Email Message</h2>
            <input type="hidden" name="id" value="<?= htmlspecialchars($message->getEmailMessageId()) ?>">

            <div>
                <label class="block mb-1 font-medium text-gray-700">Title:</label>
                <input class="w-full px-4 py-2 border rounded-lg shadow-sm" type="text" name="title" value="<?= htmlspecialchars($message->getTitle()) ?>" required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Content:</label>
                <textarea class="w-full h-[200px] px-4 py-2 border rounded-lg shadow-sm" name="content" required><?= htmlspecialchars($message->getContent()) ?></textarea>
            </div>

            <div class="text-center ">
                <button type="submit" value="Update Message"
                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                Update Message
                </button>   
            </div>
        </form>
    </div>
<?php else: ?>
    <p>Error: Message not found.</p>
<?php endif; ?>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout
?>
