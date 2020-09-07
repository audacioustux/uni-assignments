<?php

namespace App\Classes;

use App\Interfaces\IResponse;

class Response implements IResponse
{
    public function json($value)
    {
        return $value;
    }
}
