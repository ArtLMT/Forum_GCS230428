<?php
ob_start();
$title = "Feedback";
?>

<div class="max-w-6xl mx-auto mt-1 p-4 bg-white rounded-2xl shadow-md space-y-4 bg-gray-50">

    <form class="spacy-y-4" action="/forum/public/createMessage" method="post" enctype="multipart/form-data">
        <h2 class="text-2xl font-bold text-center text-gray-800">Send Feedback</h2>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Title</label>
            <input class="w-full px-4 py-2 border rounded-lg shadow-sm" type="text" name="title" required>
        </div>
        
        <div>
            <label class="block mb-1 font-medium text-gray-700">Content</label>
            <textarea class="w-full h-[200px] px-4 py-2 border rounded-lg shadow-sm" name="content" required></textarea>
        </div>
        
        <div class="text-center ">
            <button type="submit" value="Send Message"
                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                Send Message
            </button>   
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/layouts/layout.html.php'
?>