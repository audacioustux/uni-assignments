<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../../vendor/autoload.php';

use App\Models\Blog;

$blogCtx = new Blog();

$_METHOD = $_SERVER['REQUEST_METHOD'];

if($_METHOD === 'GET') {
    if(preg_match('/blogs\/(?P<id>\d+)/', $_SERVER['REQUEST_URI'], $url_params)){
        $id = $url_params["id"];

        $blog = $blogCtx->get($id);
        echo json_encode(["data" => $blog]);
    } elseif (preg_match('/blogs\/?$/', $_SERVER['REQUEST_URI'])) {
        $blogs = $blogCtx->get_all();
        echo json_encode(["data" => $blogs]);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Not Found"]);
    }
} elseif ($_METHOD === 'POST') {
    $data = json_decode(file_get_contents('php://input'));

    $validator = new JsonSchema\Validator();

    $validator->validate($data, (object) array('$ref' => 'file://' . realpath('schema.json')));

    if ($validator->isValid()) {
        try {
            $blogCtx->create((array) $data);
            echo json_encode(["ok" => true]);
        } catch (\PDOException $e) {
            if($e->getCode() === "23000") {
                http_response_code(422);
                echo json_encode(["error" => "Unprocessable Entity"]);
            }
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
        echo json_encode(["ok" => true]);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Not Found"]);
    }
} else {
    // TODO: ¯\_(ツ)_/¯
    echo "u wan.. sum fak?";
}