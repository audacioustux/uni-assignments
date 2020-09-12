<?php

namespace App\Models;

use App\Models\Model;
use App\Core\DBH;
use App\Core\Enums\BlogStateEnum;

use function Latitude\QueryBuilder\field;

class Blog extends Model
{
    const TABLE = 'blogs';
    const SCHEMA = <<<'JSON'
    {
        "title": {
            "type": "string",
            "minLength": 8,
            "maxLength": 128
        },
        "content": {
            "type": "string",
            "minLength": 255,
            "maxLength": 65536
        },
        "user_id": {
            "type": {
                "$ref": "#/definitions/naturalInt"
            }
        },
        "read_time": {
            "type": {
                "$ref": "#/definitions/wholeInt"
            }
        }
    }
    JSON;

    public function get_all_listed(?int $cursor, int $limit, $order = "desc")
    {
        $query = self::QueryFactory()
            ->select()
            ->from(self::TABLE)
            ->where(field('state')
                ->eq(BlogStateEnum::LISTED()->getValue()))
            ->orderBy('id', $order)
            ->limit($limit);

        if (!is_null($cursor)) {
            $query = $order === 'desc'
                ? $query->where(field('id')->lt($cursor))
                : $query->where(field('id')->gt($cursor));
        }

        $query = $query->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());

        return $stmt->fetchAll();
    }

    public function get(int $id)
    {
        $query = "SELECT * from %s WHERE id = :id";

        $stmt = DBH::connect()->prepare(sprintf($query, self::TABLE));
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function insert(object $values)
    {
        $changeset = $this->changeset($values)
            ->required("content", "title", "read_time", "user_id")
            ->validate();

        if ($changeset->isValid() === false) {
            return $changeset->getErrors();
        }

        $query = self::QueryFactory()->insert(self::TABLE, (array) $values)->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        return $stmt->execute($query->params());
    }

    public function delete(int $id)
    {
        $query = self::QueryFactory()
            ->delete(self::TABLE)
            ->where(field("id")->eq($id))
            ->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        return $stmt->execute($query->params());
    }
}
