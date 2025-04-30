<?php 
ob_start();
?>
<?php if (isset($user) && $user !== null): ?>
    <div class="max-w-xl mx-auto mt-10 p-8 bg-white rounded-2xl shadow-lg space-y-6">
        <h2 class="text-2xl font-bold text-gray-800 text-center">Update User</h2>
        
        <form action="/forum/public/admin/updateUser" method="post" class="space-y-4">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user->getUserId())?>">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="username">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username"
                    value="<?= htmlspecialchars($user->getUsername()) ?>" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="password">New Password</label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        placeholder="Enter new password" 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <!-- Toggle Image Button -->
                    <button 
                        type="button" 
                        onclick="togglePassword()" 
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 size-6"
                    >
                        <img id="toggleIconShow" class="block" src="/forum/public/assets/img/show.png" alt="Show Password">
                        <img id="toggleIconHide" class="hidden" src="/forum/public/assets/img/hide.png" alt="Hide Password">
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button 
                    type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200"
                >
                    Update User
                </button>
            </div>
        </form>
    </div>
<?php else : ?>
    <p class="text-center text-red-500 font-semibold mt-10">Error: User not found.</p>
<?php endif; ?>

<?php 
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>
