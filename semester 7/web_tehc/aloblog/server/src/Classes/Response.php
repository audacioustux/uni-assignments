<?php

namespace App\Classes;

use App\Interfaces\IResponse;

class Response implements IResponse
{
    private $body;

    public function json($raw_value)
    {
        header('Content-Type: application/json');
        $this->body = json_encode($raw_value);

        return $this;
    }

    public function status($code)
    {
        http_response_code($code);
        return $this;
    }

    public function __destruct()
    {
        echo $this->body;
    }
}
