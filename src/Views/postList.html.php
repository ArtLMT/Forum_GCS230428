<?php foreach ($posts as $post): ?>
    <blockquote>
        <?=htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') ?>
        At 
        <?=htmlspecialchars($post['create_date'], ENT_QUOTES,'UTF-8') ?>

    </blockquote>

<?php endforeach;?>