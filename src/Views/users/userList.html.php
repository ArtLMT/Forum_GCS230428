<?php
ob_start();
?>

<?php if (!empty($users)) : ?>
    <div>
        <p class="place-self-center text-2xl font-semibold">Total user: <?= htmlspecialchars($totalUsers)?></p>
    </div>
    <div class="grid grid-cols-2">
        <?php foreach ($users as $user) : ?>
            <a class="m-8 p-4 w-[450px] bg-white flex rounded-2xl shadow-lg transition-transform hover:scale-105 hover:shadow-xl" href="/forum/public/showProfile?id=<?=$user->getUserId()?>">
                <div class="size-20 flex items-center justify-center bg-indigo-500 text-white rounded-full text-4xl font-bold mr-4">
                    <?php if ($user->getUserImage()) : ?>
                        <img class ="size-20 rounded-full object-cover" src="/forum/public/<?=$user->getUserImage()?>" alt="Profile picture">
                    <?php else : ?>
                        <?= strtoupper(substr($user->getUsername(), 0, 1)) // Get first letter and make it uppercase  ?> 
                    <?php endif; ?>
                </div>
                <div class="group-hover:text-red-700">
                    <div class="m-0 text-3xl text-indigo-700 font-bold"><?= htmlspecialchars($user->getUsername()) ?></div>
                    <div><?=htmlspecialchars($user->getEmail())?></div>
                    <p>Post have posted: <?= htmlspecialchars($postCounts[$user->getUserId()])?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-6">
            <?php if ($totalPages > 1): ?>
                <div class="inline-flex gap-2">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <!-- When clicked, this refreshes the page and passes ?page=NUMBER to the URL -->
                    <!-- Then showDashboard() will run again and load the new page's users -->
                    <a 
                    class="px-3 py-1 rounded <?= $i == $page ? 'bg-blue-500 text-white' : 'bg-gray-300 text-black' ?>" 
                    href="?page=<?= $i ?>&search=<?= urlencode($_GET['search'] ?? '') ?>"
                    >
                        <?= $i ?>
                    </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>
<?php else : ?>
    <p>No users available.</p>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout file to render the page
?>