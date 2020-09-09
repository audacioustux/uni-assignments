<?php

namespace App\Controllers;

use App\Models\Blog;

class BlogController
{
    public function __construct()
    {
        $this->blogCtx = new Blog();
    }

    public function create($req, $res)
    {
        $body = $req->getBody();

        $json = <<<'JSON'
        {
            "sdsd": 43
        }
        JSON;
        // $validator = new \JsonSchema\Validator();

        // $validator->validate(
        //     $data,
        //     (object) ['$ref' => 'file://' . realpath('BlogSchema.json')],
        // );

        // if ($validator->isValid()) {
        //     $res->json($this->blogCtx->create($body));
        // } else {
        //     $errors = [];
        //     foreach ($validator->getErrors() as $error) {
        //         $errors[] = sprintf(
        //             "[%s] %s",
        //             $error['property'],
        //             $error['message'],
        //         );
        //     }
        // }
    }

    public function index($req, $res)
    {
        $params = $req->params;

        $cursor = @$params['cursor'];
        $limit = @$params['limit'] ?? 24;

        $blogs = $this->blogCtx->get_all_listed($cursor, $limit);
        $res->json($blogs);
    }
}
