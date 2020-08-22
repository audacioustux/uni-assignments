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
        $query = "SELECT 1 + 1";

        $stmt = DBH::connect()->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
