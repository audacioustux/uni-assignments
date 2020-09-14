<?php

use App\Core\Router;
use App\Classes\Request;
use App\Classes\Response;
use App\Controllers\BlogController;
use App\Controllers\BlogReactController;
use App\Controllers\UserController;
use App\Controllers\AuthController;

$router = new Router(new Request(), new Response());

$router
    ->get('/users$/', UserController::class, 'index')
    ->get('/users\/(?<id>\d+)$/', UserController::class, 'show')
    ->post('/users/', UserController::class, 'create')
    ->delete('/users\/(?<id>\d+)$/', UserController::class, 'delete')
    ->patch('/users\/(?<id>\d+)$/', UserController::class, 'update');

$router
    ->post('/login$/', AuthController::class, 'login')
    ->get('/logout$/', AuthController::class, 'logout');

$router
    ->get('/blogs$/', BlogController::class, 'index')
    ->get('/blogs\/(?<id>\d+)$/', BlogController::class, 'show')
    ->post('/blogs/', BlogController::class, 'create')
    ->delete('/blogs\/(?<id>\d+)$/', BlogController::class, 'delete')
    ->patch('/blogs\/(?<id>\d+)$/', BlogController::class, 'update')
    ->put('/blogs\/vote$/', BlogReactController::class, 'vote')
    ->get('/blogs\/(?<blog_id>\d+)\/votes$/', BlogReactController::class, 'all');

$router
    ->get('/comment$/', CommentController::class, 'index')
    ->get('/comment\/(?<id>\d+)$/', CommentController::class, 'show')
    ->post('/comment/', CommentController::class, 'create')
    ->delete('/comment\/(?<id>\d+)$/', CommentController::class, 'delete')
    ->patch('/comment\/(?<id>\d+)$/', CommentController::class, 'update')
    ->put('/comment\/vote$/', CommentReactController::class, 'vote')
    ->get('/comment\/(?<comment_id>\d+)\/votes$/', CommentReactController::class, 'all');
