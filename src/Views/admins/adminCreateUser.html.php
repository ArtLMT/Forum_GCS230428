<?php
ob_start();
use src\utils\SessionManager;
SessionManager::start();
$errors = SessionManager::getOnce('errors');
?>

<h2 class="text-center text-3xl mb-[2rem] text-white font-bold">Add User</h2>

<div class="flex items-center justify-center bg-gray-300 h-[500px] w-[600px] rounded-3xl place-self-center">
    <form action="/forum/public/admin/storeUser" method="POST" enctype="multipart/form-data" class="flex flex-col my-auto space-y-5 w-4/5">

        <div>
            <label> Username </label>
            <input 
                class="w-full px-4 py-2 border rounded-lg focus:outline-none <?= isset($errors['username']) ? 'focus:ring-2 focus:ring-red-500 border-red-500' : 'focus:ring-2 focus:ring-blue-600 border-gray-300' ?>" 
                type="text" 
                name="username" 
                placeholder="Username"
                required
            >
            <?php if (isset($errors['username'])) : ?>
                <p class="error text-red-500 text-sm"><?= htmlspecialchars($errors['username']) ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label>Pasword:</label>
            <input 
                class="w-full px-4 py-2 border rounded-lg focus:outline-none <?= isset($errors['password']) ? 'focus:ring-2 focus:ring-red-500 border-red-500' : 'focus:ring-2 focus:ring-blue-600 border-gray-300' ?>" 
                type="password" 
                name="password" 
                placeholder="Password"
                minlength="8"
                required
            >
            <?php if (isset($errors['password'])) : ?>
                <p class="error text-red-500 text-sm"><?= htmlspecialchars($errors['password']) ?></p>
            <?php endif; ?>
        </div>

        <div>
            <label>Email:</label>
            <input 
                class="w-full px-4 py-2 border rounded-lg focus:outline-none <?= isset($errors['email']) || isset($errors['duplicateEmail']) ? 'focus:ring-2 focus:ring-red-500 border-red-500' : 'focus:ring-2 focus:ring-blue-600 border-gray-300' ?>" 
                type="email" 
                name="email" 
                placeholder="Email"
                required
            >
            <?php if (isset($errors['email'])) : ?>
                <p class="error text-red-500 text-sm"><?= htmlspecialchars($errors['email']) ?></p>
            <?php endif; ?>
            <?php if (isset($errors['duplicateEmail'])) : ?>
                <p class="error text-red-500 text-sm"><?= htmlspecialchars($errors['duplicateEmail']) ?></p>
            <?php endif; ?>
        </div>

        <div>
            <input 
                class="w-full h-12 bg-green-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full cursor-pointer" 
                type="submit" 
                value="Create"
            >
        </div>

    </form>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>
