<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Models\Blog;
use App\Core\DBH;

(new Blog(DBH::connect()))->get_blogs();

echo json_encode(
    array('message' => 'No Posts Found')
);
