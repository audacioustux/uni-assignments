<?php

namespace App\Controllers;

use App\Models\BlogReact;

class BlogReactController
{
    public function __construct()
    {
        $this->blogReactCtx = new BlogReact();
    }

    public function vote($req, $res)
    {
        $body = $req->getBody();

        $react = $this->blogReactCtx->vote($body);
        $res->json($react);
    }

    public function all($req, $res)
    {
        $params = $req->params;

        $res->json($this->blogReactCtx->get_all_by_blog($params["blog_id"]));
    }
}
