<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Blog;
use App\Core\Enums\BlogStateEnum;

$blog = new Blog();
var_dump(
    $blog->changeset()
        ->required("id", "content")
        ->add_definition(BlogStateEnum::get_json_def())
        ->get_json_schema()
);
