<?php
ob_start();
?>

<h2 class="text-center text-3xl mb-[2rem]">CreateUser Admin</h2>
<div class="flex item-center justify-center bg-gray-300 h-[400px] w-[600px] rounded-3xl place-self-center">
    <form action="/forum/public/admin/storeUser" method = "post" enctype = "multipart/form-data" class="flex flex-col my-auto ">
        <label> Username </label>
        <input class="border-solid border-2 border-gray-400" type="text" name="username" required>
        <br>
    
        <label>Pasword:</label>
        <input class="border-solid border-2 border-gray-400" type="text" name="password">
        <br>
    
        <label>email:</label>
        <input class="border-solid border-2 border-gray-400" style ="text" name ="email">
    
        <br>
        <input class="border-solid border-2 border-gray-400 rounded-full bg-green-400 hover:bg-green-600" type="submit" value = "Create">
    </form>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>