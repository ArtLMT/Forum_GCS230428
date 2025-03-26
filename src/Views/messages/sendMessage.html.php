<?php
ob_start(); 
?>
<h2>Send Feedback</h2>

<form action="forum/public/messageList" method="post">
    <label>Title</label>
    <input type="text" name="title" required>
    <br>

    <label>Conetent</label>
    <textarea name="content" required></textarea>
    <br>

    <input type="submit" value ="Send Message">
</form>


<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/layouts/layout.html.php'
?>