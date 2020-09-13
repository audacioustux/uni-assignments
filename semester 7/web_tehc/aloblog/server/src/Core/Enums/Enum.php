<?php


namespace App\Core\Enums;

use MyCLabs\Enum\Enum as MyCLabsEnum;

abstract class Enum extends MyCLabsEnum
{
    public static function get_json_def()
    {
        $enumName = lcfirst(array_pop(...[explode('\\', get_called_class())]));

        return (object)  [
            $enumName => (object) [
                "type" => "string",
                // TODO: refactor
                // "enum" => array_map('strtolower', self::keys())
                "enum" => self::values()
            ]
        ];
    }
}
