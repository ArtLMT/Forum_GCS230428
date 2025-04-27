<?php
ob_start();
use src\utils\SessionManager;
SessionManager::start();
$errors = SessionManager::getOnce('errors');
?>

<div class="login-container">
        <h2 class="text-center text-4xl font-bold mb-5 text-blue-500">Sign In</h2>

        <form class="space-y-5" action="/forum/public/signIn" method="POST" enctype="multipart/form-data">
            <div>
                <input class="w-full px-4 py-2 border px-3 rounded-lg focus:outline-none <?= !empty($errors) ? 'focus:ring-2 focus:ring-red-500' : 'focus:ring-2 focus:ring-blue-600' ?> <?= !empty($errors) ? 'border-red-500' : 'border-gray-300' ?>" 
                    type="text" name="username" placeholder="Username" required>
                <?php if (isset($errors['username'])) : ?>
                    <p class="error text-red-500 text-sm"><?= htmlspecialchars($errors['username']) ?></p>
                <?php endif; ?>
            </div>

            <div>
                <input class="w-full px-4 py-2 border px-3 rounded-lg focus:outline-none <?= !empty($errors) ? 'focus:ring-2 focus:ring-red-500' : 'focus:ring-2 focus:ring-blue-600' ?> <?= !empty($errors) ? 'border-red-500' : 'border-gray-300' ?>" 
                    type="email" name="email" placeholder="Email" required>
                <?php if (isset($errors['duplicateEmail'])) : ?>
                    <p class="error text-red-500 text-sm"><?= htmlspecialchars($errors['duplicateEmail']) ?></p>
                <?php endif; ?>
            </div>

            <div>
                <input class="w-full px-4 py-2 border px-3 rounded-lg focus:outline-none <?= !empty($errors) ? 'focus:ring-2 focus:ring-red-500' : 'focus:ring-2 focus:ring-blue-600' ?> <?= !empty($errors) ? 'border-red-500' : 'border-gray-300' ?>" 
                    type="password" name="password" placeholder="Password" minlength="8">
                <?php if (isset($errors['password'])) : ?>
                    <p class="error text-red-500 text-sm m-0"><?= htmlspecialchars($errors['password']) ?></p>
                <?php endif; ?>
            </div>
            <button class="w-full h-12 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Sign In</button>
        </form>

        <p class="mt-5">Already have an account? <a href="/forum/public/login" class="text-blue-600 font-bold">Login.</a></p>
    </div>

<?php
$form = ob_get_clean();
include dirname(__DIR__) . '/layouts/loginLayout.html.php';
?>