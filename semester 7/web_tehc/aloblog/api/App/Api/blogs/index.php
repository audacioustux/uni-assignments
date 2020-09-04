<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../../vendor/autoload.php';

use App\Models\Blog;

$blogCtx = new Blog();

$_METHOD = $_SERVER['REQUEST_METHOD'];
if($_METHOD === 'GET') {
    preg_match('/(?P<id>\d+)/', $_SERVER['REQUEST_URI'], $url_params);

    if(isset($url_params["id"])){
        $id = $url_params["id"];

        $blog = $blogCtx->get($id);
        echo json_encode(["data" => $blog]);
    } else {
        $blogs = $blogCtx->get_all();
        echo json_encode(["data" => $blogs]);
    }
} elseif ($_METHOD === 'POST') {
    
}