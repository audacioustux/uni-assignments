<?php

use App\Core\Router;
use App\Classes\Request;
use App\Classes\Response;
use App\Controllers\BlogController;
use App\Controllers\UserController;

$router = new Router(new Request(), new Response());

$router
    ->get('/blogs$/', BlogController::class, 'index')
    ->get('/blogs\/(?<id>\d+)$/', BlogController::class, 'show')
    ->post('/blogs/', BlogController::class, 'create')
    ->delete('/blogs\/(?<id>\d+)$/', BlogController::class, 'delete')
    ->patch('/blogs\/(?<id>\d+)$/', BlogController::class, 'update')
    ->get('/users$/', UserController::class, 'index')
    ->get('/users\/(?<id>\d+)$/', UserController::class, 'show')
    ->post('/users/', UserController::class, 'create')
    ->delete('/users\/(?<id>\d+)$/', UserController::class, 'delete')
    ->patch('/users\/(?<id>\d+)$/', UserController::class, 'update');
