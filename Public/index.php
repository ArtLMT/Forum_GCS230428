<?php
require_once __DIR__ . '/../autoload.php';

use src\Router;

session_start(); // Start the session

$router = new Router();

// Show login page if not logged in
if (!isset($_SESSION['user_id'])) {
    $router->get('', 'AuthController@loginPage'); // Show login form
    $router->post('login', 'AuthController@login'); // Handle login
} else {
    $router->get('home', 'PostController@listPosts'); // Show posts if logged in
}

// Register other routes
$router->post('index.php/login', 'AuthController@login');
$router->get('index.php/login', 'AuthController@loginPage');

$router->get('index', 'PostController@listPosts'); 
$router->get('create', 'PostController@store');  
$router->post('create', 'PostController@store'); 
$router->post('update', 'PostController@update');
$router->get('update', 'PostController@update');
$router->post('delete', 'PostController@delete');
$router->get('delete', 'PostController@delete');
$router->get('profile', 'UserController@profile');

$router->dispatch();
?>
