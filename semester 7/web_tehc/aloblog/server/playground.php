<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\User;

echo json_encode((new user)->get_user_by_field("id", 1));
