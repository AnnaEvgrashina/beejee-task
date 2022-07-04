<?php

namespace App\Models;

use App\Database\Database;

class User
{
    private static string $table = 'users';

    public static function getPasswordByLogin($login): bool|array|null
    {
        $db = Database::getInstant();
        $sql = 'SELECT password FROM ' . self::$table . ' WHERE  login = \'' . $login . '\'';
        return $db->query($sql);
    }
}