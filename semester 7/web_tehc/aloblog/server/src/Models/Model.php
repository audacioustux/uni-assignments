<?php

namespace App\Models;

use Latitude\QueryBuilder\Engine\MySqlEngine;
use Latitude\QueryBuilder\QueryFactory;
use App\Core\Changeset;

abstract class Model
{
    const SCHEMA = self::SCHEMA;

    protected static function QueryFactory()
    {
        return new QueryFactory(new MySqlEngine());
    }

    public function changeset(object $data = null, $options = [])
    {
        $def_opt = [
            "additionalProperties" => false,
            ...$options
        ];

        $changeset = new Changeset(
            json_decode($this::SCHEMA),
            $data,
            $def_opt
        );

        return $changeset;
    }
}
