<?php
require_once __DIR__ . '/../autoload.php'; // Load autoloader

use src\Router; // Namespace should match Router.php

$router = new Router(); // Instantiating Router

$router->get('', 'PostController@index'); // Home page
$router->get('post', 'PostController@show'); // Show method for posts


$router->dispatch();
