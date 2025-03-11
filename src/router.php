<?php
namespace Src;

use Src\Controllers\PostController;
use Src\Controllers\CommentController;
use Src\Controllers\ModuleController;
use Src\Controllers\AuthController;

class Router {
    private $routes = [];

    public function __construct() {
        // Define default routes for the forum
        $this->routes = [
            'GET' => [],
            'POST' => []
        ];
    }

    // // Define a route for GET requests
    // public function get($uri, $action) {
    //     $this->routes['GET'][$uri] = $action;
    // }

    // // Define a route for POST requests
    // public function post($uri, $action) {
    //     $this->routes['POST'][$uri] = $action;
    // }

    // // Dispatch the request to the appropriate controller and method
    // public function dispatch() {
    //     $method = $_SERVER['REQUEST_METHOD'];
    //     $uri = trim($_SERVER['REQUEST_URI'], '/');

    //     // Check if the route exists for the given URI and method
    //     if (isset($this->routes[$method][$uri])) {
    //         $action = $this->routes[$method][$uri];
    //         $this->executeAction($action);
    //     } else {
    //         echo "Route not found!";
    //     }
    // }

    // // Execute the controller and method
    // private function executeAction($action) {
    //     list($controllerName, $methodName) = explode('@', $action);
    //     $controllerName = 'Src\\Controllers\\' . $controllerName;

    //     if (class_exists($controllerName)) {
    //         $controller = new $controllerName();
    //         if (method_exists($controller, $methodName)) {
    //             $controller->$methodName();
    //         } else {
    //             echo "Method not found!";
    //         }
    //     } else {
    //         echo "Controller not found!";
    //     }
    // }
}
