<?php
ob_start();
use src\utils\SessionManager;
SessionManager::start();
$errors = SessionManager::getOnce('form_errors');

?>

<h2 class="text-center text-3xl font-bold mb-10 text-gray-800">Log in</h2>
<?php if (isset($errors['wrongPassword'])) : ?>
    <p class="error text-red-700 font-bold">
        <?= htmlspecialchars($errors['wrongPassword'])?>
    </p>
<?php endif; ?>
<form class="space-y-5" action="/forum/public/login" method="POST">
    <input class="w-full h-12 border px-3 rounded-lg focus:outline-none <?= isset($errors['wrongPassword']) ? 'focus:ring-2 focus:ring-red-500' : 'focus:ring-2 focus:ring-blue-600' ?> <?= isset($errors['wrongPassword']) ? 'border-red-500' : 'border-blue-300' ?>" 
            type="email" name="email" placeholder="Email" required>
    <input class="w-full h-12 border px-3 rounded-lg focus:outline-none <?= isset($errors['wrongPassword']) ? 'focus:ring-2 focus:ring-red-500' : 'focus:ring-2 focus:ring-blue-400' ?> <?= isset($errors['wrongPassword']) ? 'border-red-500' : 'border-gray-300' ?>" 
            type="password" name="password" placeholder="Password" required>
    <button class="w-full h-12 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Sign In</button>
</form>
<p class="mt-5">Don't have an account? <a href="/forum/public/signIn" class="text-blue-600 font-bold">Sign up.</a></p>


<?php
$form = ob_get_clean();
include dirname(__DIR__) . '/layouts/loginLayout.html.php';
?>