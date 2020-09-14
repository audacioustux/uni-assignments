<?php

namespace App\Models;

use App\Models\Model;
use App\Core\DBH;

use function Latitude\QueryBuilder\func;
use function Latitude\QueryBuilder\field;

class CommentReact extends Model
{
    const TABLE = 'comment_reacts';
    const SCHEMA = <<<'JSON'
    {
        "comment_id": {
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
            ->required("comment_id", "user_id", "is_liked")
            ->validate();

        if ($changeset->isValid() === false) {
            return $changeset->getErrors();
        }

        $query = "INSERT INTO %s (comment_id, user_id, is_liked) 
        VALUES (:comment_id, :user_id, :is_liked)
        ON DUPLICATE KEY UPDATE is_liked=:is_liked";

        $stmt = DBH::connect()->prepare(sprintf($query, self::TABLE));
        $stmt->bindParam(':comment_id', $values->comment_id, \PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $values->user_id, \PDO::PARAM_INT);
        $stmt->bindParam(':is_liked', $values->is_liked, \PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    // NOTE: oopsie.. this is shit
    public function get_all_by_blog(int $comment_id)
    {
        $query = self::QueryFactory()
            ->select()
            ->from(self::TABLE)
            ->where(field('comment_id')->eq($comment_id))
            ->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());

        return $stmt->fetchAll();
    }
}
