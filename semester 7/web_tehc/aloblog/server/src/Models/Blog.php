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

    public function __construct()
    {
        $this->factory = new QueryFactory(new MySqlEngine());
    }

    public function get_all_listed($cursor, int $limit, $order = "desc")
    {
        $query = $this->factory
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

    public function create($values)
    {
        $query = $this->factory->insert(self::TABLE, $values)->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());
    }

    public function delete($id)
    {
        $query = $this->factory
            ->delete(self::TABLE)
            ->where(field("id")->eq($id))
            ->compile();

        $stmt = DBH::connect()->prepare($query->sql());
        $stmt->execute($query->params());
    }
}
