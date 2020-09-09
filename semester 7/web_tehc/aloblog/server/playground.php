<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Enums\BlogStateEnum;

var_dump(array_map('strtolower', BlogStateEnum::keys()));
