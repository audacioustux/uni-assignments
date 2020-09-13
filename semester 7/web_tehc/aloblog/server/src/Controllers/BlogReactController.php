<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function __construct()
    {
        $this->userCtx = new User();
    }

    public function show($req, $res)
    {
        $params = $req->params;

        $user = $this->userCtx->get($params["id"]);
        $res->json($user);
    }
}
