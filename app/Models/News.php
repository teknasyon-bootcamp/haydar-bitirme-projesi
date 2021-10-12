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

    public function isEditableByUser()
    {
        $user = user();

        if ($user->role_level >= 3) {
            return true;
        }

        $current = strtotime(date("Y-m-d"));
        $newsDate = strtotime($this->created_at);

        $datediff = $current - $newsDate;
        $difference = floor($datediff / (60 * 60 * 24));

        if ($difference < 1) {
           return false;
        }

        return true;
    }
}
