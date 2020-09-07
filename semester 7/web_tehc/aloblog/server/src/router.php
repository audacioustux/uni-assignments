<?php

use App\Core\Router;
use App\Classes\Request;

$router = new Router(new Request());

$router->get('/blogs\/(?P<id>\d+)$/', function ($request) {
    // The $request argument of the callback
    // will contain information about the request
    return "Content";
}); // How POST requests will be defined
$router->post('/some\/route/', function ($request) {
    // How to get data from request body
    $body = $request->getBody();
    return json_encode($body);
});
