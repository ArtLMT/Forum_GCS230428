<?php 
ob_start(); // Start output buffering
?>
<?php if (isset($user) && $user !== null) : ?>
    <div class="max-w-xl mx-auto mt-2 p-4 bg-white rounded-2xl shadow-md space-y-4 bg-gray-50">
    <h2 class="text-2xl font-bold text-center text-gray-800">Edit User Details</h2>
    <form action="/forum/public/updateUser" method="post" enctype="multipart/form-data" class="space-y-6">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user->getUserId()) ?>">

        <div>
            <label class="block mb-1 font-medium text-gray-700">Username</label>
            <input 
                type="text" 
                name="username" 
                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" 
                value="<?= htmlspecialchars($user->getUsername()) ?>"
            >
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Password</label>
            <input 
                type="text" 
                name="password" 
                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" 
                value="<?= htmlspecialchars($user->getPassword()) ?>"
            >
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Email</label>
            <input 
                type="text" 
                name="email" 
                class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" 
                value="<?= htmlspecialchars($user->getEmail()) ?>"
            >
        </div>

        <!-- Profile Image -->
        <?php if ($user->getUserImage()) : ?>
            <div class="space-y-2">
                <p class="font-medium text-gray-700">Current Profile Image</p>
                <img src="/forum/public/<?= $user->getUserImage() ?>" alt="User Image" class="w-24 h-24 rounded-full object-cover border border-gray-300">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="remove_image" value="1" class="accent-red-500">
                    <span class="text-sm text-red-600">Remove current image</span>
                </label>
            </div>
        <?php endif; ?>

        <!-- Upload New Image -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Upload New Profile Picture</label>
            <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button 
                type="submit" 
                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                Update User
            </button>
        </div>
    </form>
</div>

<?php else: ?>
    <p>Error: User not found.</p>
<?php endif; ?>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout
?>