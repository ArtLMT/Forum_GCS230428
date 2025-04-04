<?php
ob_start();
$title = "Feedback";
?>

<form class="bg-slate-900 border-solid border-2 rounded-lg"action="/forum/public/createMessage" method="post" enctype="multipart/form-data">
    <div class="m-[1rem] flex flex-col items-center">
        <h2>Send Feedback</h2>
        <label>Title</label>
        <input class="px-[12px] bg-gray-300 text-gray-700 mb-[1rem] w-[80%] rounded-xl" type="text" name="title" required>
    
        <label>Conetent</label>
        <textarea class="text-gray-700 bg-gray-300 mb-[1rem] w-[80%] h-[200px] text-justify rounded-3xl px-[12px]"name="content" required></textarea>
    
        <label>User Id</label>
        <textarea class="text-gray-700 bg-gray-300 mb-[1rem] w-[80%] rounded-xl" name="userId" required></textarea>
    
        <input class="flex justify-center bg-green-400 border-solid border-green-600 border-2 p-3 rounded-2xl transition duration-400 ease-in-out transform hover:scale-105" type="submit" value ="Send Message">

    </div>
</form>


<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/layouts/layout.html.php'
?>