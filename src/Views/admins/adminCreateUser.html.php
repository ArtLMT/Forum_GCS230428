<?php
ob_start();
?>

<h2 class="text-center text-3xl">CreateUser Admin</h2>

<form action="/forum/public/admin/storeUser" method = "post" enctype = "multipart/form-data">
    <label> Username </label>
    <input class="border-solid border-2" type="text" name="username" required>
    <br>

    <label>Pasword:</label>
    <input class="border-solid border-2" type="text" name="password">
    <br>

    <label>email:</label>
    <input class="border-solid border-2" style ="text" name ="email">

    <br>
    <input class="border-solid border-2" type="submit" value = "Sign In">
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>