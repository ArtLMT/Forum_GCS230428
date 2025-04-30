<?php
ob_start();

?>
<?php if (!empty($messages)) : ?>
    <div>
        <div class=" flex justify-center items-center grid grid-cols-4 font-bold text-white bg-gray-800 py-2 px-4"
            style="grid-template-columns: 80px 180px 0.8fr 2fr;" >
            <div class="flex justify-center items-center">User ID</div>
            <div class="flex justify-center items-center">Author</div>
            <div>title</div>
            <div>Content</div>
        </div>
        <?php foreach($messages as $message) : ?>
                <div class=" flex justify-center items-center grid grid-cols-4 text-black text-base py-2 px-4 my-[4px] rounded-full bg-gray-300"
                style="grid-template-columns: 80px 180px 0.5fr 2fr;" >
                    <div class="flex justify-center items-center"><?= htmlspecialchars($message->getUserId())?></div>
                    <div class="flex items-center">
                        <div class="size-12 flex items-center justify-center mr-4 bg-indigo-500 text-white rounded-full text-4xl font-bold">
                            <?php if ($message->getAvatar()) : ?>
                                    <img src="/forum/public/<?= htmlspecialchars($message->getAvatar()) ?>" class="size-12 rounded-full object-cover" alt="User Profile">
                                <?php else : ?>
                                    <?= strtoupper(substr($message->getUsername(), 0, 1)) // Get first letter and make it uppercase  ?> 
                                <?php endif; ?>
                        </div>
                        <div><?= htmlspecialchars($message->getUsername())?></div>
                    </div>
                    <div><?= htmlspecialchars($message->getTitle())?></div>
                    <div><?= htmlspecialchars($message->getContent())?></div>
                </div>
        <?php endforeach;?>
            <div class="text-center">
                <?php if ($totalPages > 1): ?>
                    <div class="inline-flex gap-2">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <!-- When clicked, this refreshes the page and passes ?page=NUMBER to the URL -->
                        <!-- Then showDashboard() will run again and load the new page's users -->
                            <a class="px-3 py-1 rounded <?= $i == $page ? 'bg-blue-500 text-white' : 'bg-gray-300 text-black' ?>" href="?page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
    </div>
<?php else : ?>
    <p class="text-white text-3xl px-4 py-2 place-self-center">No Feedback available.</p>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>