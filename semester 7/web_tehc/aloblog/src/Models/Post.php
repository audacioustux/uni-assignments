<?php

namespace App\Models;

use App\Core\DBH;

class Post extends DBH
{
    public function __construct()
    {
        // Create query
        $query = 'SELECT 1 + 1 FROM DUAL';

        // Prepare statement
        $stmt = $this->connect()->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }
}
