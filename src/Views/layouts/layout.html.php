<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="/forum/public/assets/css/reset.css">
    <link rel="stylesheet" href="/forum/public/assets/css/style.css">
    <link rel="stylesheet" href="/forum/public/assets/css/input.css">
</head>
<body class="m-0 p-0 box-border text-[62.5%]">
    <header class="sticky top-0 w-full h-[2.5rem] bg-orange-400">
        <nav class="inline-flex">
            <a class = "nav-home" href="/forum/public/">Nerds For Nerds</a>
             <p>Search bar</p>
             <a href="/forum/public/createPost">Add post</a>
             <a href="/forum/public/moduleLists">Modules</a>
             <a href="">Messages</a>
             <a href="">Profile</a>
        </form>
        </nav>
    </header>
    <main class="">
    <p class="text-2xl text-red-600">Welcome to Forum</p>
        <!-- side menu -->
        <div class="side-menu sticky top-0 block flex flex-col">
            <p>This is the side menu</p>
            <a href="" class = "side-menu-content">Create User</a>
            <a href="" class = "side-menu-content">option_2</a>
            <a href="" class = "side-menu-content">Feedback</a>
            <a href="" class = "side-menu-content logout">Logout</a>   
        </div>
        <!-- main content -->
        <div class="absolute content ml-[100px]">
            <div class="post-area">
                <?php echo $content; ?>
            </div>
        </div>
    </main>
    <footer class = "relative">
        <p>&copy; <?php echo date("Y"); ?> Forum Test. All rights reserved.</p>
    </footer>
</body>
</html>
