<?php
require_once __DIR__ . '/../autoload.php';

use src\Router;

$router = new Router();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Post's routes
$router->get('', 'PostController@index'); 
$router->get('createPost', 'PostController@createPost');  
$router->post('createPost', 'PostController@store'); 
$router->post('update', 'PostController@update');
$router->get('update', 'PostController@edit');
// $router->post('delete', 'PostController@destroy');
$router->get('delete', 'PostController@destroy');
$router->get('userPost', 'PostController@getPostByUserId');
$router->get('postDetail', 'PostController@openPost');
$router->get('postByModule', 'PostController@showPostByModule');

// Module's routes
$router->get('moduleLists', 'ModuleController@index'); // List all posts
$router->get('createModule', 'ModuleController@create'); // Show create post form
$router->post('createModule', 'ModuleController@store'); // Store new post
$router->get('updateModule', 'ModuleController@edit'); // Show edit post form (expects ?id= in query)
$router->post('updateModule', 'ModuleController@update'); // Update post data
$router->get('deleteModule', 'ModuleController@destroy'); // Delete post (expects ?id= in query)

// User's router
$router->get('signIn', 'UserController@createUser');
$router->post('signIn', 'UserController@store');
$router->get('userLists', 'UserController@index');
$router->post('userLists', 'UserController@index');
$router->get('updateUser', 'UserController@editUser');
$router->post('updateUser' ,'UserController@updateUser');
$router->get('deleteUser', 'UserController@deleteUser');
$router->post('deleteUser', 'UserController@deleteUser');
$router->get('showProfile', 'UserController@showProfile');

// Email Message router
$router->get('messageList', 'EmailMessageController@listMessage');
$router->post('messageList', 'EmailMessageController@listMessage');
$router->get('createMessagePage', 'EmailMessageController@createMessage');
$router->post('createMessage', 'EmailMessageController@store');
$router->get('editMessage', 'EmailMessageController@edit');
$router->post('updateMessage', 'EmailMessageController@update');
$router->get('deleteEmailMessage', 'EmailMessageController@destroy');

// comment router
$router->post('addComment', 'CommentController@store');
$router->post('updateComment', 'CommentController@update');
$router->get('deleteComment', 'CommentController@destroy');


// Authentication Routes
$router->get('login', 'AuthController@showLoginForm'); // Show login page
$router->post('login', 'AuthController@login'); // Handle login form submission
$router->get('logout', 'AuthController@logout'); // Logout user
$router->get('signIn', 'AuthController@showSignInForm');

// Admin controller routes
$router->get('dashboard', 'AdminController@showDashboard');
$router->get('admin/createUser', 'AdminController@showUserCreate');
$router->post('admin/storeUser', 'AdminController@storeUser');
$router->post('admin/updateUserRole', 'AdminController@updateUserRole');
$router->post('admin/deleteUser', 'adminController@deleteUser');
$router->get('admin/showPostList', 'adminController@showPostList');
$router->get('admin/showCreatePost', 'adminController@showCreatePost');
$router->post('admin/createPost', 'adminController@storePost');
$router->post('admin/deletePost', 'adminController@deletePost');
$router->get('admin/showModuleList', 'adminController@showModuleList');
$router->post('admin/createModule', 'adminController@storeModule');
$router->get('admin/showCreateModule', 'adminController@showCreateModule');
$router->post('admin/deleteModule', 'adminController@deleteModule');
$router->get('admin/editModule', 'AdminController@showEditModule');
$router->post('admin/updateModule', 'AdminController@updateModule');
$router->get('admin/listFeedback', 'AdminController@showFeedback');


$router->dispatch();
?>
