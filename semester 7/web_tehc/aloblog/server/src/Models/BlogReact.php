<?php

namespace App\Models;

use App\Models\Model;
use App\Core\DBH;

use function Latitude\QueryBuilder\func;
use function Latitude\QueryBuilder\field;

class BlogReact extends Model
{
    const TABLE = 'blog_reacts';
    const SCHEMA = <<<'JSON'
    {
        "blog_id": {
            "type": {
                "$ref": "#/definitions/naturalInt"
            }
        },
        "user_id": {
            "type": {
                "$ref": "#/definitions/naturalInt"
            }
        },
        "is_liked": {
            "type": "boolean"
        }
    }
    JSON;

    public function vote(object $values)
    {
        $changeset = $this->changeset($values)
            ->required("blog_id", "user_id", "is_liked")
            ->validate();

        if ($changeset->isValid() === false) {
            return $changeset->getErrors();
        }

        $query = "INSERT INTO %s (blog_id, user_id, is_liked) 
        VALUES (:blog_id, :user_id, :is_liked)
        ON DUPLICATE KEY UPDATE is_liked=:is_liked";

        $stmt = DBH::connect()->prepare(sprintf($query, self::TABLE));
        $stmt->bindParam(':blog_id', $values->blog_id, \PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $values->user_id, \PDO::PARAM_INT);
        $stmt->bindParam(':is_liked', $values->is_liked, \PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    // NOTE: oopsie.. this is shit
    public function get_all_by_blog(int $blog_id)
    {
        $query = self::QueryFactory()
            ->select()
            ->from(self::TABLE)
            ->where(field('blog_id')->eq($blog_id))
            ->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());

        return $stmt->fetchAll();
    }
}
