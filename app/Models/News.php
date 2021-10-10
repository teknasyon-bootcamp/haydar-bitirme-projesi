<?php

namespace App\Models;

use Core\Model;

class News extends Model
{
    public static $tableName = "news";

    public function user()
    {
        return User::find($this->user_id);
    }
}
