<?php

namespace App\Controllers;
// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');

// require_once '../../../vendor/autoload.php';

use App\Models\Blog;

class BlogController
{
    public function __construct()
    {
        $this->blogCtx = new Blog();
    }

    public function post($req, $res)
    {
        $body = $req->getBody();
        $res->json($body);
    }
}
// $_METHOD = $_SERVER['REQUEST_METHOD'];

// $status = 200;
// $body = "";

// if ($_METHOD === 'GET') {
//     $data = [];
//     if (
//         preg_match('/blogs\/(?P<id>\d+)/', $_SERVER['REQUEST_URI'], $url_params)
//     ) {
//         $id = $url_params["id"];
//         $data = $blogCtx->get($id);
//     } elseif (preg_match('/blogs\/?$/', $_SERVER['REQUEST_URI'])) {
//         $data = $blogCtx->get_all();
//     }
//     if (count($data)) {
//         $body .= json_encode(["data" => $data]);
//     } else {
//         $status = 404;
//     }
// } elseif ($_METHOD === 'POST') {
//     $data = json_decode(file_get_contents('php://input'));

//     $validator = new JsonSchema\Validator();

//     $validator->validate(
//         $data,
//         (object) ['$ref' => 'file://' . realpath('schema.json')],
//     );

//     if ($validator->isValid()) {
//         try {
//             $blogCtx->create((array) $data);
//             $status = 201;
//         } catch (\PDOException $e) {
//             if ($e->getCode() !== "23000") {
//                 throw $e;
//             }

//             $status = 422;
//         }
//     } else {
//         $errors = [];
//         foreach ($validator->getErrors() as $error) {
//             $errors[] = sprintf(
//                 "[%s] %s",
//                 $error['property'],
//                 $error['message'],
//             );
//         }
//         $status = 422;
//         $body .= json_encode(["errors" => $errors]);
//     }
// } elseif ($_METHOD === "DELETE") {
//     if (preg_match('/(?P<id>\d+)/', $_SERVER['REQUEST_URI'], $url_params)) {
//         $id = $url_params["id"];

//         $blogCtx->delete($id);
//         $status = 202;
//     } else {
//         $status = 404;
//     }
// } else {
//     $status = 405;
// }

// http_response_code($status);
// if ($body === "") {
//     if ($status == 200) {
//         $body .= json_encode(["ok" => true]);
//     } elseif ($status == 201) {
//         $body .= json_encode(["created" => true]);
//     } elseif ($status == 202) {
//         $body .= json_encode(["accepted" => true]);
//     } elseif ($status == 404) {
//         $body .= json_encode(["error" => "Not Found"]);
//     } elseif ($status == 422) {
//         $body .= json_encode(["error" => "Unprocessable Entity"]);
//     } elseif ($status == 405) {
//         $body .= json_encode(["error" => "Method Not Allowed"]);
//     } elseif ($status == 500) {
//         $body .= json_encode(["error" => "Internal Server Error"]);
//     }
// }

// echo $body;
