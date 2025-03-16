<?php
namespace src;

use src\controllers\PostController;

class Router {
    private $routes = [];

    // Register a GET route
    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    // Register a POST route (if needed)
    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    // Dispatch the request
    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        // Get the request URI and trim leading/trailing slashes.
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    
        // For example, if REQUEST_URI is "/forum/public/index.php",
        // after trim() it becomes "forum/public/index.php"
    
        // Define the base path (adjust if necessary)
        $basePath = 'forum/public';
        
        // If the URI starts with the base path, remove it.
        if (strpos($uri, $basePath) === 0) {
             $uri = substr($uri, strlen($basePath));
             $uri = trim($uri, '/');
        }   
        
        // If the remaining URI is "index.php", set it to empty.
        if ($uri === 'index.php') {
             $uri = '';
        }
        
        // Debug output: show the final computed URI.
        // echo "<pre>Dispatching URI: '$uri'</pre>";
    
        // Look up the route based on method and URI.
        if (isset($this->routes[$method][$uri])) {
             $action = $this->routes[$method][$uri];
             list($controllerName, $methodName) = explode('@', $action);
             $controllerClass = 'src\\controllers\\' . $controllerName;
             if (class_exists($controllerClass)) {
                 $controller = new $controllerClass();
                 if (method_exists($controller, $methodName)) {
                     $controller->$methodName();
                 } else {
                     echo "Method '$methodName' not found in controller '$controllerClass'";
                 }
             } else {
                 echo "Controller '$controllerClass' not found.";
             }
        } else {
             echo "404 Not Found - URI: '$uri'";
        }
    }
}
