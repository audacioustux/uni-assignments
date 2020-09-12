<?php

use App\Core\Router;
use App\Classes\Request;
use App\Classes\Response;
use App\Controllers\BlogController;

$router = new Router(new Request(), new Response());

$router
    ->get('/blogs$/', BlogController::class, 'index')
    ->get('/blogs\/(?<id>\d+)$/', BlogController::class, 'show')
    ->post('/blogs/', BlogController::class, 'create')
    ->delete('/blogs/', BlogController::class, 'delete')
    ->patch('/blogs/', BlogController::class, 'update');
