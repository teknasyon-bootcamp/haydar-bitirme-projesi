<?php

namespace App\Models;

use Core\Model;

class UserFollowedCategories extends Model
{
    public static $tableName = "user_followed_categories";

    public function user()
    {
        return User::find($this->user_id);
    }

    public function category()
    {
        return Category::find($this->category_id);
    }
}
