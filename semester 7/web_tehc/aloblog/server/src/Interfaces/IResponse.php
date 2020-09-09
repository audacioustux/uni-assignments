<?php

namespace App\Interfaces;

interface IResponse
{
    public function json($value);
    public function status($code);
}
