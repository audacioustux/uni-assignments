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
    }

    public function __destruct()
    {
        echo $this->body;
    }
}
