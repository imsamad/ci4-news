<?php

namespace App\Libraries;

class Hash
{
    public static function hash($pwd)
    {
        return password_hash($pwd, PASSWORD_BCRYPT);
    }

    public static function verify($pwd, $db_pwd)
    {
        return password_verify($pwd, $db_pwd);
    }
}
