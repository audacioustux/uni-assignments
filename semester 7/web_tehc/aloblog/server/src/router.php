<?php

use App\Core\Router;
use App\Classes\Request;
use App\Classes\Response;
use App\Controllers\BlogController;
use App\Controllers\BlogReactController;
use App\Controllers\UserController;
use App\Controllers\AuthController;
use App\Controllers\CommentController;


$router = new Router(new Request(), new Response());

// users
$router
    ->get('/users$/', UserController::class, 'index')
    ->get('/users\/(?<id>\d+)$/', UserController::class, 'show')
    ->post('/users/', UserController::class, 'create')
    ->delete('/users\/(?<id>\d+)$/', UserController::class, 'delete')
    ->patch('/users\/(?<id>\d+)$/', UserController::class, 'update')
    ->get('/whoami$/', UserController::class, 'whoami');

// auth
$router
    ->post('/login$/', AuthController::class, 'login')
    ->get('/logout$/', AuthController::class, 'logout');

//blogs
$router
    ->get('/blogs$/', BlogController::class, 'index')
    ->get('/blogs\/(?<id>\d+)$/', BlogController::class, 'show')
    ->post('/blogs$/', BlogController::class, 'create')
    ->delete('/blogs\/(?<id>\d+)$/', BlogController::class, 'delete')
    ->patch('/blogs\/(?<id>\d+)$/', BlogController::class, 'update')
    ->post('/blogs\/upload-thumb$/', BlogController::class, 'upthumb');
// comments
$router
    ->get('/blogs\/(?<blog_id>\d+)\/comments\/count$/', CommentController::class, 'count')
    ->get('/blogs\/(?<blog_id>\d+)\/comments$/', CommentController::class, 'index')
    ->get('/comments\/(?<id>\d+)$/', CommentController::class, 'show')
    ->post('/comments/', CommentController::class, 'create')
    ->delete('/comments\/(?<id>\d+)$/', CommentController::class, 'delete')
    ->patch('/comments\/(?<id>\d+)$/', CommentController::class, 'update');

// votes/reacts
$router
    ->put('/blogs\/votes$/', BlogReactController::class, 'vote')
    ->get('/blogs\/(?<blog_id>\d+)\/votes$/', BlogReactController::class, 'all')
    ->put('/comments\/votes$/', CommentReactController::class, 'vote')
    ->get('/comments\/(?<comment_id>\d+)\/votes$/', CommentReactController::class, 'all');
