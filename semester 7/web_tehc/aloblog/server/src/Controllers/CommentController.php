<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController
{
    public function __construct()
    {
        $this->commentCtx = new Comment();
    }

    public function create($req, $res)
    {
        $body = $req->getBody();

        $res->json($this->commentCtx->insert($body));
    }
    public function delete($req, $res)
    {
        $res->json($this->commentCtx->delete($req->params["id"]));
    }
    public function index($req, $res)
    {
        $params = $req->params;

        $cursor = @$params['cursor'];
        $limit = @$params['limit'] ?? 24;

        $blogs = $this->commentCtx->get_all_by_blog($params["blog_id"], $cursor, $limit);
        $res->json($blogs);
    }
    public function show($req, $res)
    {
        $params = $req->params;

        $blog = $this->commentCtx->get($params["id"]);
        $res->json($blog);
    }

    public function update($req, $res)
    {
        $params = $req->params;
        $body = $req->getBody();

        $blog = $this->commentCtx->update($params["id"], $body);
        $res->json($blog);
    }
    public function count($req, $res)
    {
        $count = $this->commentCtx->count($req->params["blog_id"]);
        $res->json($count);
    }
}
