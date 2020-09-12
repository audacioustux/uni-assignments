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

        $res->json($this->blogCtx->insert($body));
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
