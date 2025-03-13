<?php
require_once __DIR__ . '/../autoload.php';

use src\Router;

$router = new Router();

// Register routes:
$router->get('', 'PostController@listPosts');
$router->get('create', 'PostController@store');  // For GET: display form
$router->post('create', 'PostController@store'); // For POST: process form submission
$router->post('update', 'PostController@update');
$router->get('update', 'PostController@update');
$router->post('delete', 'PostController@delete');
$router->get('delete', 'PostController@delete');

$router->dispatch();
