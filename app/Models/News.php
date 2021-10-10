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

    public function category()
    {
        return Category::find($this->category_id);
    }

    public function getDate()
    {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function destroyAsset()
    {
        $location = AppRootDirectory . "/uploads/" . $this->image;

        if (file_exists($location)) {
            unlink($location);
        }
    }

    public function getSummary()
    {
        $end = strlen($this->content) > 200 ? "..." : "";
        return substr($this->content, 0, 200) . $end;
    }
}
