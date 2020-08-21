<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Models\Blog;

var_dump((new Blog())->read_by_id());
