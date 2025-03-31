<?php
ob_start();
use src\utils\SessionManager;
// SessionManager::start();
?>

<h2 class="text-center text-3xl font-bold mb-10 text-gray-800">Login</h2>
<?php if (isset($_SESSION['error'])) : ?>
    <p class="error text-black">
        <?php
        $error = SessionManager::get('error');
        echo htmlspecialchars($error);
        SessionManager::remove('error'); 
        ?>
    </p>
<?php endif; ?>
<form class="space-y-5" action="/forum/public/login" method="POST">
    <input class="w-full h-12 border border-gray-800 px-3 rounded-lg" type="email" name="email" placeholder="Email" required>
    <input class="w-full h-12 border border-gray-800 px-3 rounded-lg" type="password" name="password" placeholder="Password" required>
    <button class="w-full h-12 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Login</button>
</form>
<p class="mt-5">Don't have an account? <a href="/forum/public/signIn">Who cares?</a></p>


<?php
$form = ob_get_clean();
include dirname(__DIR__) . '/layouts/loginLayout.html.php';
?>