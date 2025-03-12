<?php
// spl_autoload_register(function ($className) {
//     // Convert namespace separator "\" to "/"
//     $classPath = str_replace('\\', '/', $className);

//     // Construct file path relative to `/src/`
//     $file = __DIR__ . '/src/' . $classPath . '.php';

//     // Check if file exists and require it
//     if (file_exists($file)) {
//         require_once $file;
//     } else {
//         http_response_code(404);
//         die("Class '$className' not found at $file");
//     }
// });

// spl_autoload_register(function ($className) {
//     // Convert namespace separator "\" to "/"
//     $classPath = str_replace('\\', '/', $className);

//     // Fix the file path: No extra `/src/`
//     $file = __DIR__ . '/' . $classPath . '.php';

//     // Debugging output
//     if (!file_exists($file)) {
//         http_response_code(500);
//         die("Autoloader Error: Class '$className' not found at '$file'");
//     }

//     require_once $file;
// });


spl_autoload_register(function ($className) {
    // Convert namespace separator "\" to "/"
    $classPath = str_replace('\\', '/', $className);

    // Fix the file path
    $file = __DIR__ . '/' . $classPath . '.php';

    // Debugging output
    if (!file_exists($file)) {
        http_response_code(500);
        die("❌ Autoloader Error: Class '$className' not found at '$file'");
    }

    echo "✅ Autoloader Loaded: $file<br>"; // Debugging output
    require_once $file;
});
