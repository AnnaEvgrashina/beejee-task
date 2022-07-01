<?php

namespace App\Models;

use App\Database\Database;

class Task
{
    private static string $table = 'tasks';
    public static function all($sort = null, $direction = 'ASC', $page = 1)
    {
        $offset = $page > 1 ? ($page - 1) * 3 : 0;
        $db = Database::getInstant();
        $sql = 'SELECT * FROM ' . self::$table;
        if (!is_null($sort)) {
            $sql .= ' ORDER BY ' . $sort . ' ' . $direction;
        }
        $sql .= ' LIMIT 3 OFFSET ' . $offset;
        return $db->query($sql);
    }
}
