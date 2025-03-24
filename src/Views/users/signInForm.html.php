<?php
ob_start();

?>
<h2 class="text-center text-3xl">Sign in</h2>

<form action="/forum/public/signIn" method = "post" enctype = "multipart/form-data">
    <label> Username </label>
    <input class="border-solid border-4" type="text" name="username" required>
    <br>

    <label>Pasword:</label>
    <input class="border-solid border-4" type="text" name="password">
    <br>

    <label>email:</label>
    <input class="border-solid border-4" style ="text" name ="email">

    <br>
    <input class="border-solid border-4" type="submit" value = "Sign In">
</form>



<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout file to render the page
?>