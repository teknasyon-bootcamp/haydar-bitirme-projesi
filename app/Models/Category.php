<?php

namespace App\Models;

use Core\Model;

class Category extends Model
{
    public static $tableName = "categories";

    public function editors()
    {
        $categoryUsers = UsersCategories::where(['category_id' => $this->id]);

        $editorsArray = [];
        foreach ($categoryUsers as $categoryUser) {

            $editorsArray[] = User::find($categoryUser->user_id);
        }

        return $editorsArray;
    }
}
