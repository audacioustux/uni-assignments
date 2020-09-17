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

        $result = $this->blogCtx->insert($body);
        if (isset($result["errors"])) $res->status(422);
        $res->json($result);
    }
    public function delete($req, $res)
    {
        $res->json($this->blogCtx->delete($req->params["id"]));
    }
    public function index($req, $res)
    {
        $params = $req->params;

        $cursor = @$params['cursor'];
        $limit = @$params['limit'] ?? 12;

        $blogs = $this->blogCtx->get_all_listed($cursor, $limit);
        $res->json($blogs);
    }
    public function show($req, $res)
    {
        $params = $req->params;

        $blog = $this->blogCtx->get($params["id"]);
        $res->json($blog);
    }

    public function update($req, $res)
    {
        $params = $req->params;
        $body = $req->getBody();

        $blog = $this->blogCtx->update($params["id"], $body);
        $res->json($blog);
    }
}
