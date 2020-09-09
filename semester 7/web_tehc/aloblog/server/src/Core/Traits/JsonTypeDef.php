<?php

namespace App\Core\Traits;

trait JsonTypeDef
{
    public static function get_json_def()
    {
        $enumName = array_pop(explode('\\', __CLASS__));
        return (object) ["definition" => array_map('strtolower', self::keys())];
    }
}
