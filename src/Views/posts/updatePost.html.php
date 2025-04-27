<?php
ob_start();
?>

<?php if (isset($post) && $post !== null): ?>
    <div class="max-w-2xl mx-auto mt-6 p-6 bg-white rounded-2xl shadow-md space-y-6 bg-gray-50">
        <h2 class="text-2xl font-bold text-center text-gray-800">Edit Post</h2>
        <form action="/forum/public/update" method="post" enctype="multipart/form-data" class="space-y-5">
            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post->getPostId()) ?>">

            <!-- Title -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Title</label>
                <input type="text" name="title"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 border-gray-300"
                    value="<?= htmlspecialchars($title) ?>" required>
            </div>

            <!-- Content -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Content</label>
                <textarea name="content" rows="5"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 border-gray-300"
                    required><?= htmlspecialchars($content) ?></textarea>
            </div>

            <!-- Module Selection -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Module</label>
                <select name="module_id"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 border-gray-300" required>
                    <option value="">Select a Module</option>
                    <?php foreach ($modules as $module): ?>
                        <option value="<?= $module->getModuleId() ?>" 
                            <?= $post->getModuleId() == $module->getModuleId() ? 'selected' : '' ?>>
                            <?= htmlspecialchars($module->getModuleName()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Current Image -->
            <?php if ($post->getPostImage()): ?>
                <div>
                    <p class="font-medium text-gray-700">Current Image:</p>
                    <img src="/forum/public/<?= $post->getPostImage() ?>" alt="Current Image" class="w-40 h-auto rounded-md my-2">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="remove_image" value="1" id="remove_image" class="rounded">
                        <label for="remove_image" class="text-gray-600">Remove this image</label>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Upload New Image -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Upload New Image (optional)</label>
                <input type="file" name="image" class="w-full text-gray-700">
            </div>

            <!-- Submit -->
            <div class="text-center">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                    Update Post
                </button>
            </div>
        </form>
    </div>
<?php else: ?>
    <p class="text-center text-red-500 font-semibold mt-6">Error: Post not found.</p>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/layout.html.php';
?>
