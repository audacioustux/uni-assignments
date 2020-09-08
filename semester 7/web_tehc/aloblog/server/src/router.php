<?php

use App\Core\Router;
use App\Classes\Request;
use App\Classes\Response;
use App\Controllers\BlogController;

$router = new Router(new Request(), new Response());

$router->get('/blogs$/', BlogController::class, 'index');
$router->get('/blogs\/(?<id>\d+)$/', BlogController::class, 'show');
$router->post('/blogs/', BlogController::class, 'create');
$router->delete('/blogs/', BlogController::class, 'delete');
$router->patch('/blogs/', BlogController::class, 'update');
