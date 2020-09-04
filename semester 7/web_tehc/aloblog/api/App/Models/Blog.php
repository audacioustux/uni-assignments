<?php

namespace App\Models;

use App\Core\DBH;
use App\Core\Enums\BlogStateEnum;

class Blog
{
    private const TABLE = 'blogs';

    public function get_all(int $cursor = null, $limit = 10){
        // TODO: refactor.. -_-
        $_q_where_cursor = $cursor ? 'id < ' . $cursor . ' AND' : '';
        $query = "SELECT * from %s WHERE {$_q_where_cursor} state = :state
        ORDER BY id DESC
        LIMIT :limit";

        $stmt = DBH::connect()->prepare(sprintf($query, self::TABLE));
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':state', BlogStateEnum::LISTED()->getValue());

        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function get(int $id){
        $query = "SELECT * from %s WHERE id = :id";
        
        $stmt = DBH::connect()->prepare(sprintf($query, self::TABLE));
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create(string $title, int $user_id, string $content, string $state) {
        
    }
}
