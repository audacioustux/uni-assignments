#!/usr/bin/env php
<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Core\DBH;

$conn = null;
while(is_null($conn)){
    try {
        $conn = DBH::connect();
    } catch (PDOException $e) {
        echo ".";
        sleep(2);
    }
}

exit;