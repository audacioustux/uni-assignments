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

    public function get_count_by_blog(int $blog_id, ?int $cursor, int $limit, $order = "desc")
    {
        $query = self::QueryFactory()
            ->select(func('COUNT', 'users.id'))
            ->from(self::TABLE)
            ->where(field('blog_id')->eq($blog_id))
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
}
