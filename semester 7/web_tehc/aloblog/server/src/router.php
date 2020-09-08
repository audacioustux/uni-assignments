<?php

use App\Core\Router;
use App\Classes\Request;
use App\Classes\Response;
use App\Controllers\BlogController;

$router = new Router(new Request(), new Response());

// $router->get('/blogs\/(?<id>\d+)$/', function ($req, $res) {
//     return json_encode($req->params);
// });
$router->post('/blogs/', BlogController::class);
