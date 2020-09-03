<?php

namespace App\Models;

use App\Core\DBH;
use Cake\Database\Query;
use Ramsey\Uuid\Type\Integer;

class Blog
{
    private $table = 'blogs';
    private $conn;

    public $id;
    public $title;
    public $user_id;
    public $slug;
    public $content;
    public $thumbnail;
    public $state;
    public $created_at;
    public $updated_at;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function get_blogs($cursor = null, $limit = 5){
        $query = "SELECT * from {$this->table} 
        WHERE id < :cursor
        ORDER BY created_at, id DESC
        LIMIT :limit";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':cursor', $cursor, \PDO::PARAM_INT);
        
        $stmt->execute();
        
        echo '<pre>';
        var_dump($stmt->fetchAll(\PDO::FETCH_ASSOC));
        echo '</pre>';
    }
}
