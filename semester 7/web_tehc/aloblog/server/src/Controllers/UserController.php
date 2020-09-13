<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function __construct()
    {
        $this->userCtx = new User();
    }

    public function create($req, $res)
    {
        $body = $req->getBody();

        $res->json($this->userCtx->insert($body));
    }
    public function delete($req, $res)
    {
        $res->json($this->userCtx->delete($req->params["id"]));
    }
    public function index($req, $res)
    {
        $params = $req->params;

        $cursor = @$params['cursor'];
        $limit = @$params['limit'] ?? 24;

        $users = $this->userCtx->get_all_active($cursor, $limit);
        $res->json($users);
    }
    public function show($req, $res)
    {
        $params = $req->params;

        $user = $this->userCtx->get($params["id"]);
        $res->json($user);
    }

    public function update($req, $res)
    {
        $params = $req->params;
        $body = $req->getBody();

        $user = $this->userCtx->update($params["id"], $body);
        $res->json($user);
    }
}
