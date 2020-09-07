<?php
namespace App\Core\Helpers;

class QueryHelpers {
    static function get_ids($conn, string $table) {
        $rows = $conn->fetchAll("select id from {$table}");
        return array_reduce(
            $rows,
            function ($acc, $item) {
                $acc[] = $item["id"];
                return $acc;
            },
            [],
        );
    }
}
