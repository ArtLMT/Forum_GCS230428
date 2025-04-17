<?php
ob_start();
use src\utils\SessionManager;
SessionManager::start();
$errors = SessionManager::getOnce('form_errors');
?>

<div class="login-container">
        <h2 class="text-center text-3xl font-bold mb-10 text-gray-800">Sign In</h2>
        <?php if (isset($errors['duplicateEmail'])) : ?>
            <p class="error text-red-700 font-bold">
                <?= htmlspecialchars($errors['duplicateEmail'])?>
            </p>
        <?php endif; ?>

        <form class="space-y-5" action="/forum/public/signIn" method="POST" enctype="multipart/form-data">
            <input class="w-full h-12 border border-gray-800 px-3 rounded-lg focus:outline-none <?= isset($errors['duplicateEmail']) ? 'focus:ring-2 focus:ring-red-500' : 'focus:ring-2 focus:ring-blue-600' ?> <?= isset($errors['duplicateEmail']) ? 'border-red-500' : 'border-blue-300' ?>" 
                type="text" name="username" placeholder="Username" required>
            <input class="w-full h-12 border border-gray-800 px-3 rounded-lg focus:outline-none <?= isset($errors['duplicateEmail']) ? 'focus:ring-2 focus:ring-red-500' : 'focus:ring-2 focus:ring-blue-600' ?> <?= isset($errors['duplicateEmail']) ? 'border-red-500' : 'border-blue-300' ?>" 
                type="email" name="email" placeholder="Email" required>
            <input class="w-full h-12 border border-gray-800 px-3 rounded-lg focus:outline-none <?= isset($errors['duplicateEmail']) ? 'focus:ring-2 focus:ring-red-500' : 'focus:ring-2 focus:ring-blue-600' ?> <?= isset($errors['duplicateEmail']) ? 'border-red-500' : 'border-blue-300' ?>" 
                type="password" minlength="8" name="password" placeholder="Password" required>
            <button class="w-full h-12 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Sign In</button>
        </form>

        <p class="mt-5">Already have an account? <a href="/forum/public/login" class="text-blue-600 font-bold">Login</a></p>
    </div>

<?php
$form = ob_get_clean();
include dirname(__DIR__) . '/layouts/loginLayout.html.php';
?>