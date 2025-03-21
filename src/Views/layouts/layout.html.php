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
<body>
    <header>
        <nav class="fixed h-[40px] bg-orange-400 inline-flex">
            <a class = "nav-home" href="/forum/public/">Nerds For Nerds</a>
             <p>Search bar</p>
             <a href="/forum/public/createPost">Add post</a>
             <a href="/forum/public/moduleLists">Modules</a>
             <a href="">Messages</a>
             <a href="">Profile</a>
        </form>
        </nav>
        
    </header>
    <main>
    <p class="text-2xl text-red-600">Welcome to Forum Test</p>
        <!-- side menu -->
        <div class="side-menu">
        <p>This is the side menu</p>
        <a href="" class = "side-menu-content">Create User</a>
        <a href="" class = "side-menu-content">option_2</a>
        <a href="" class = "side-menu-content">Feedback</a>
        <a href="" class = "side-menu-content logout">Logout</a>   
        </div>
        <!-- main content -->
        <div class="content">
            <div class="post-area">
                <?php echo $content; ?>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Forum Test. All rights reserved.</p>
    </footer>
</body>
</html>
