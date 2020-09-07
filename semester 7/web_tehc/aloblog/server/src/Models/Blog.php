<?php

namespace App\Models;

use App\Core\DBH;
use App\Core\Enums\BlogStateEnum;
use Latitude\QueryBuilder\Engine\MySqlEngine;
use Latitude\QueryBuilder\QueryFactory;

use function Latitude\QueryBuilder\field;

class Blog
{
    private const TABLE = 'blogs';

    public function get_all(int $cursor = null, $limit = 10)
    {
        // TODO: refactor.. -_-
        $_q_where_cursor = $cursor ? 'id < ' . $cursor . ' AND' : '';
        $query = "SELECT * from %s WHERE {$_q_where_cursor} state = :state
        ORDER BY id DESC
        LIMIT :limit";

        $stmt = DBH::connect()->prepare(sprintf($query, self::TABLE));
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':state', BlogStateEnum::LISTED()->getValue());

        $stmt->execute();

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

    public function create($values)
    {
        $factory = new QueryFactory(new MySqlEngine());
        $query = $factory->insert(self::TABLE, $values)->compile();

        DBH::connect()
            ->prepare($query->sql())
            ->execute($query->params());
    }

    public function delete($id)
    {
        $factory = new QueryFactory(new MySqlEngine());
        $query = $factory
            ->delete(self::TABLE)
            ->where(field("id")->eq($id))
            ->compile();

        DBH::connect()
            ->prepare($query->sql())
            ->execute($query->params());
    }
}
