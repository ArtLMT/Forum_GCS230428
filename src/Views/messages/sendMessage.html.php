<?php
ob_start(); 
?>
<h2>Send Feedback</h2>

<form action="/forum/public/createMessage" method="post" enctype="multipart/form-data">
    <label>Title</label>
    <input class="text-black" type="text" name="title" required>
    <br>

    <label>Conetent</label>
    <textarea class="text-black" name="content" required></textarea>
    <br>

    <label>User Id</label>
    <textarea class="text-black" name="userId" required></textarea>
    <br>
    <input type="submit" value ="Send Message">
</form>


<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/layouts/layout.html.php'
?>