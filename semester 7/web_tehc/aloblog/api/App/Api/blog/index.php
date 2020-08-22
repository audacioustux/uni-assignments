<?php
header('Content-Type: application/json');

require __DIR__ . '/../../../vendor/autoload.php';

use App\Models\Blog;

echo json_encode(
    array('message' => 'No Posts Found')
);
