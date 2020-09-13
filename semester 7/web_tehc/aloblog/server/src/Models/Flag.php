<?php

namespace App\Models;

use App\Models\Model;
use App\Core\DBH;

use function Latitude\QueryBuilder\field;

class Flag extends Model
{
    const TABLE = 'flags';
    const SCHEMA = <<<'JSON'
    {
        "user_id": {
            "type": {
                "$ref": "#/definitions/naturalInt"
            }
        },
        "link": {
            "type": "string",
            "format": "uri"
        },
        "message": {
            "type": "string",
            "maxLength": 255
        },
        "flagType": {
            "type": {
                "$ref": "#/definitions/flagTypeEnum"
            }
        }
    }
    JSON;

    public function get_all(?int $cursor, int $limit, $order = "desc")
    {
        $query = self::QueryFactory()
            ->select()
            ->from(self::TABLE)
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
        $query = self::QueryFactory()
            ->select()
            ->from(self::TABLE)
            ->where(field('id')->eq($id))
            ->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());

        return $stmt->fetch();
    }

    public function insert(object $values)
    {
        $changeset = $this->changeset($values)
            ->required("name")
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

    public function update(int $id, object $values)
    {
        // TODO: add cast
        $changeset = $this->changeset($values)
            ->validate();

        if ($changeset->isValid() === false) {
            return $changeset->getErrors();
        }

        $query = self::QueryFactory()
            ->update(self::TABLE, (array) $values)
            ->where(field('id')->eq($id))
            ->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        return $stmt->execute($query->params());
    }
}
