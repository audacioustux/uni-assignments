<?php

namespace App\Models;

use App\Core\DBH;

class Blog
{
    private $table = 'blogs';

    public $id;
    public $title;
    public $user_id;
    public $slug;
    public $content;
    public $thumbnail;
    public $state;
    public $created_at;
    public $updated_at;

    // Get Blogs
    public function read_by_id()
    {
        // Create query
        $query = "SELECT b.id, b.category_id, b.title, b.body, b.author, b.created_at
                                  FROM { $this->table } b
                                  ORDER BY
                                    b.created_at DESC";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
