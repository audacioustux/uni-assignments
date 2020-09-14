<?php

namespace App\Models;

use App\Models\Model;
use App\Core\DBH;
use App\Models\User;

use Ramsey\Uuid\Uuid;

use function Latitude\QueryBuilder\func;
use function Latitude\QueryBuilder\field;

class Session extends Model
{
    const TABLE = 'sessions';
    const SCHEMA = <<<'JSON'
    {
        "user_id": {
            "type": {
                "$ref": "#/definitions/naturalInt"
            }
        }
    }
    JSON;

    public function create(int $user_id)
    {
        $sid = Uuid::uuid4()->toString();
        $query = self::QueryFactory()->insert(self::TABLE, [
            "user_id" => $user_id,
            "sid" => $sid
        ])->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());

        return $sid;
    }

    public function get_user_by_sid($sid)
    {
        $query = self::QueryFactory()
            ->select()
            ->from(self::TABLE)
            ->where(field('sid')->eq($sid))
            ->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());

        $user_id = $stmt->fetch()["user_id"];

        // NOTE: yah i know.. this is shit :) 
        // just wanna get done with this project ASAP :)
        return (new user)->get_user_by_field("id", $user_id);
    }
}
