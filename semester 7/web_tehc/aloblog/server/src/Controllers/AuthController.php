<?php

namespace App\Controllers;

use App\Models\Session;
use App\Models\User;

class AuthController
{
    public function __construct()
    {
        $this->sessionCtx = new Session();
        $this->userCtx = new User();
    }

    public function login($req, $res)
    {
        $body = $req->getBody();

        $user = (object) [];
        if (isset($body->email)) {
            $user = $this->userCtx->get_user_by_field("email", $body->email, true);
        } elseif (isset($body->username)) {
            $user = $this->userCtx->get_user_by_field("username", $body->username, true);
        }

        if (!$user) {
            $res->status(422);
            $res->json((object)["errors" => [["property" => "username", "message" => "username not found"]]]);
            return;
        } elseif (
            !isset($body->password) ||
            !password_verify(
                $body->password,
                $user["password_hash"]
            )
        ) {
            $res->status(422);
            $res->json((object)["errors" => [["property" => "password", "message" => "password didn't match"]]]);
            return;
        }

        $sid = $this->sessionCtx->create($user["id"]);
        setcookie("sid", $sid);
        unset($user["password_hash"]);
        $res->json($user);
    }

    public function all($req, $res)
    {
        $params = $req->params;

        $res->json($this->sessionCtx->get_all_by_user($params["user_id"]));
    }

    public function logout($req, $res)
    {
        // https://www.php.net/manual/en/function.setcookie.php#73484
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }
        }
    }
}
