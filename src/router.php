<?php
namespace src;

class Router {
    private $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        
        // Extract URI properly (remove unnecessary parts)
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = str_replace(['/forum/public/index.php', '/forum/public'], '', $uri);
        $uri = trim($uri, '/');
    
        // Debugging output
        echo "<pre>Request Method: $method</pre>";
        echo "<pre>Fixed Request URI: $uri</pre>";
        echo "<pre>Registered Routes:</pre>";
        print_r($this->routes);
    
        if (isset($this->routes[$method][$uri])) {
            $action = $this->routes[$method][$uri];
            echo "<pre>Dispatching: $action</pre>";
            $this->executeAction($action);
        } else {
            http_response_code(404);
            die("<pre>❌ 404 Not Found</pre>");
        }
    }
    
    private function executeAction($action) {
        list($controllerName, $methodName) = explode('@', $action);
        $controllerName = 'src\\controllers\\' . $controllerName; 
    
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $methodName)) {
                $controller->$methodName();
            } else {
                die("<pre>❌ Method '$methodName' not found in '$controllerName'</pre>");
            }
        } else {
            die("<pre>❌ Controller '$controllerName' not found!</pre>");
        }
    }
    
}