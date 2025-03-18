<?php
require_once __DIR__ . '/../autoload.php';

use src\Router;

$router = new Router();

// Register other routes
$router->get('', 'PostController@listPosts'); 
$router->get('create', 'PostController@store');  
$router->post('create', 'PostController@store'); 
$router->post('update', 'PostController@update');
$router->get('update', 'PostController@update');
$router->post('delete', 'PostController@delete');
$router->get('delete', 'PostController@delete');
$router->get('moduleLists', 'ModuleController@listModules');
$router->post('moduleLists', 'ModuleController@listModules');



// $router->get('profile', 'UserController@profile');

$router->dispatch();
?>
