<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../../vendor/autoload.php';

use App\Models\Blog;

$blogCtx = new Blog();

$_METHOD = $_SERVER['REQUEST_METHOD'];

$status = 200;

if($_METHOD === 'GET') {
    if(preg_match('/blogs\/(?P<id>\d+)/', $_SERVER['REQUEST_URI'], $url_params)){
        $id = $url_params["id"];

        $blog = $blogCtx->get($id);
        echo json_encode(["data" => $blog]);
    } elseif (preg_match('/blogs\/?$/', $_SERVER['REQUEST_URI'])) {
        $blogs = $blogCtx->get_all();
        if(count($blogs)){
            echo json_encode(["data" => $blogs]);
        } else {
            $status = 404;
        }
    } else {
        $status = 404;
    }
} elseif ($_METHOD === 'POST') {
    $data = json_decode(file_get_contents('php://input'));

    $validator = new JsonSchema\Validator();

    $validator->validate($data, (object) array('$ref' => 'file://' . realpath('schema.json')));

    if ($validator->isValid()) {
        try {
            $blogCtx->create((array) $data);
            $status = 201;
        } catch (\PDOException $e) {
            $status = $e->getCode() === "23000" ? 422 : 500;
        }
    } else {
        $errors = [];
        foreach ($validator->getErrors() as $error) {
            $errors[] = sprintf("[%s] %s", $error['property'], $error['message']);
        }
        echo json_encode(["errors" => $errors]);
    }
} elseif ($_METHOD === "DELETE") {
    if(preg_match('/(?P<id>\d+)/', $_SERVER['REQUEST_URI'], $url_params)){
        $id = $url_params["id"];
        
        $blogCtx->delete($id);
        $status = 201;
    } else {
        $status = 404;
    }
} else {
    // TODO: ¯\_(ツ)_/¯
    echo "u wan.. sum fak?";
}

http_response_code($status);
if($status = 201){
    echo json_encode(["ok" => "true"]);
} elseif ($status === 404) {
    echo json_encode(["error" => "Not Found"]);
} elseif ($status = 422) {
    echo json_encode(["error" => "Unprocessable Entity"]);
} else {
    echo json_encode(["error" => "Internal Server Error"]);
}