<?php

namespace App\Controllers;

use App\Models\CommentReact;

class CommentReactController
{
    public function __construct()
    {
        $this->commentReactCtx = new CommentReact();
    }

    public function vote($req, $res)
    {
        $body = $req->getBody();

        $react = $this->commentReactCtx->vote($body);
        $res->json($react);
    }

    public function all($req, $res)
    {
        $params = $req->params;

        $res->json($this->commentReactCtx->get_all_by_blog($params["comment_id"]));
    }
}
