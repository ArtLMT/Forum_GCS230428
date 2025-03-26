<?php
require_once __DIR__ . '/../autoload.php';

use src\Router;

$router = new Router();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Register other routes
$router->get('', 'PostController@index'); 
$router->get('createPost', 'PostController@createPost');  
$router->post('createPost', 'PostController@store'); 
$router->post('update', 'PostController@update');
$router->get('update', 'PostController@edit');
$router->post('delete', 'PostController@delete');
$router->get('delete', 'PostController@delete');

// Module's routes
// $router->get('moduleLists', 'ModuleController@listModules');  

// $router->get('createModule', 'ModuleController@createModule');  
// $router->post('createModule', 'ModuleController@store');  

// $router->get('updateModule', 'ModuleController@edit');  
// $router->post('updateModule', 'ModuleController@update');  

// $router->get('deleteModule', 'ModuleController@delete');  
// $router->post('deleteModule', 'ModuleController@delete');  

$router->get('moduleLists', 'ModuleController@index'); // List all posts

$router->get('createModule', 'ModuleController@create'); // Show create post form
$router->post('createModule', 'ModuleController@store'); // Store new post

$router->get('updateModule', 'ModuleController@edit'); // Show edit post form (expects ?id= in query)
$router->post('updateModule', 'ModuleController@update'); // Update post data

$router->get('deleteModule', 'ModuleController@destroy'); // Delete post (expects ?id= in query)



// User's router
$router->get('signIn','UserController@createUser');
$router->post('signIn','UserController@createUser');
$router->get('userLists','UserController@getAllUser');
$router->post('userLists','UserController@getAllUser');
$router->get('updateUser','UserController@editUser');
$router->post('updateUser','UserController@editUser');
$router->get('deleteUser','UserController@deleteUser');
$router->post('deleteUser','UserController@deleteUser');
// $router->post()

// Email Message router
$router->get('messageList','EmailMessageController@listMessage');
$router->post('messageList','EmailMessageController@listMessage');
$router->get('createMessage','EmailMessageController@createMessage');
$router->post('createMessage','EmailMessageController@createMessage');
$router->dispatch();
?>
