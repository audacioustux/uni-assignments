<?php

namespace App\Models;

use App\Models\Model;
use App\Core\DBH;
use App\Core\Enums\BlogStateEnum;

use function Latitude\QueryBuilder\func;
use function Latitude\QueryBuilder\field;

class Comment extends Model
{
    const TABLE = 'comments';
    const SCHEMA = <<<'JSON'
    {
        "user_id": {
            "type": {
                "$ref": "#/definitions/naturalInt"
            }
        },
        "blog_id": {
            "type": {
                "$ref": "#/definitions/naturalInt"
            }
        },
        "content": {
            "type": "string",
            "maxLength": 65536
        },
        "replied_to": {
            "type": {
                "$ref": "#/definitions/naturalInt"
            }
        },
        "state": {
            "type": {
                "$ref": "#/definitions/commentStateEnum"
            }
        }
    }
    JSON;

    public function get_all_by_blog(int $blog_id, ?int $cursor, int $limit, $order = "desc")
    {
        $query = self::QueryFactory()
            ->select()
            ->from(self::TABLE)
            ->where(field('blog_id')
                ->eq($blog_id))
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
            ->required("blog_id", "user_id", "content")
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
        $changeset = $this->changeset($values)->validate();

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
    public function count(int $blog_id)
    {
        $query = self::QueryFactory()
            ->select(func('COUNT', '*'))
            ->from(self::TABLE)
            ->where(field('blog_id')
                ->eq($blog_id))
            ->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());

        return (int)$stmt->fetch()["COUNT(*)"];
    }
}
