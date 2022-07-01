<?php

namespace App\Database;

use PDO;

class Database
{
    private static $instant;
    private PDO $pdo;

    private function __construct()
    {
        $this->pdo = new PDO(($_ENV['DB_DRIVER'] .
            ':host=' . $_ENV['DB_HOST'] .
            ((!empty($_ENV['DB_PORT'])) ? (';port=' . $_ENV['DB_PORT']) : '') .
            ';dbname=' . $_ENV['DB_NAME']),
            $_ENV['DB_USER'], $_ENV['DB_PASSWORD']
        );
    }

    public function query(string $sql): bool|array|null
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute();
        if ($result === false) {
            return null;
        }
        return $sth->fetchAll(PDO::FETCH_CLASS);
    }

    public static function getInstant(): self
    {
        if (self::$instant == null) {
            self::$instant = new self();
        }
        return self::$instant;
    }
}
