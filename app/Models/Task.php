<?php

namespace App\Models;

use App\Database\Database;

class Task
{
    private static string $table = 'tasks';

    public static function all(): bool|array|null
    {
        $db = Database::getInstant();
        $sql = 'SELECT * FROM ' . self::$table;
        return $db->query($sql);
    }

    public static function getById(int $id): bool|array|null
    {
        $db = Database::getInstant();
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE id = \'' . $id . '\'';
        return $db->query($sql);
    }

    public static function getTaskById(int $id): bool|array|null
    {
        $db = Database::getInstant();
        $sql = 'SELECT task FROM ' . self::$table . ' WHERE id = \'' . $id . '\'';
        return $db->query($sql);
    }

    public static function create(string $userName, string $email, string $task): bool|array|null
    {
        $db = Database::getInstant();
        $sql = 'INSERT INTO ' . self::$table . ' (user_name, email, task) VALUES (\'' . implode('\',\'', [$userName, $email, $task]) . '\')';
        return $db->query($sql);
    }

    public static function update(int $id, array $fields): bool|array|null
    {
        $db = Database::getInstant();
        $sql = 'UPDATE ' . self::$table . ' SET ';
        $data = '';
        foreach ($fields as $key => $value) {
            $data .= "$key = '$value', ";
        }
        $sql .= rtrim($data, ', ');
        $sql .= ' WHERE id = \'' . $id . '\'';
        return $db->query($sql);
    }

}
