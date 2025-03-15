<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <!-- Update the path to your actual CSS file -->
    <link rel="stylesheet" href="/Forum/public/assets/style.css">
</head>
<body>
    <header>
        <nav>
            <!-- <a class = "nav-home" href="/Forum/public/">Home</a> -->
            <ul>
                <!-- Link to the home route (which shows the post list) -->
                <li><a href="/Forum/public/">Home</a></li>
                <!-- Link to create a new post -->
                <li><a href="/Forum/public/create">Create Post</a></li>
            </ul>
        </form>
        </nav>
        <h1>Welcome to Forum Test</h1>

    </header>
    <main>
        <!-- side menu -->
        <div>

        </div>
        <!-- main content -->
        <div>
            <?php echo $content; ?>
        </div>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Forum Test. All rights reserved.</p>
    </footer>
</body>
</html>
