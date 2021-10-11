<?php

namespace App\Models;

use Core\Model;

class UserSeenNews extends Model
{
    public static $tableName = "user_seen_news";

    public function user()
    {
        return User::find($this->user_id);
    }

    public function news()
    {
        return News::find($this->news_id);
    }
}
