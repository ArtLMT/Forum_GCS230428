<?php
require_once __DIR__ . '/../autoload.php';

use src\Router;

$router = new Router();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Register other routes
$router->get('', 'PostController@listPosts'); 
$router->get('createPost', 'PostController@store');  
$router->post('createPost', 'PostController@store'); 
$router->post('update', 'PostController@update');
$router->get('update', 'PostController@update');
$router->post('delete', 'PostController@delete');
$router->get('delete', 'PostController@delete');

// Module's routes
$router->get('moduleLists', 'ModuleController@listModules');
$router->post('moduleLists', 'ModuleController@listModules');
$router->get('createModule', 'ModuleController@store');
$router->post('createModule', 'ModuleController@store');
$router->post('updateModule', 'ModuleController@update');
$router->get('updateModule', 'ModuleController@update');
$router->post('deleteModule', 'ModuleController@delete');
$router->get('deleteModule', 'ModuleController@delete');

// User's router
$router->get('createUser','UserController@create');
$router->post('createUser','UserController@create');


// $router->get('profile', 'UserController@profile');

$router->dispatch();
?>
