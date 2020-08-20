<?php

namespace App\Core;

class DBH
{
    private static $conn = null;

    protected function connect()
    {
        if (is_null(self::$conn)) {
            $user = getenv("DB_USER");
            $pass = getenv("DB_PASS");
            $name = getenv("DB_NAME");
            $host = getenv("DB_HOST");

            $dsn = 'mysql:host=' . $host . ';dbname=' . $name;

            try {
                self::$conn = new \PDO($dsn, $user, $pass);
                self::$conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                echo 'db connection err: ' . $e->getMessage();
            }
        }
        return self::$conn;
    }
}
