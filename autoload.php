<?php

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

//    echo "✅ Autoloader Loaded: $file<br>"; // Debugging output
    require_once $file;
});
