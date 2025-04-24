<?php

namespace App\Models;

use Core\Model;

class Student extends Model
{
    protected static string $table = 'students';

    public static function user()
    {
        return User::where('id', '=', $_SESSION['user']['id'])->get();
    }
}