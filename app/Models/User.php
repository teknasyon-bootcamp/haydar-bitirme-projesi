<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    public function getRole()
    {
        $roleLevel = $this->role_level;

        if ($roleLevel == 1) {
            return "Kullanıcı";
        } elseif ($roleLevel == 2) {
            return "Editör";
        } elseif ($roleLevel == 3) {
            return "Moderatör";
        } elseif ($roleLevel == 4) {
            return "Yönetici";
        }
    }

    public function getEditorCategories()
    {
        $editorCategories = UsersCategories::where(['user_id' => $this->id]);

        $categoriesEditor = [];
        foreach ($editorCategories as $editorCategory) {

            $categoriesEditor[] = Category::find($editorCategory->category_id);
        }

        return $categoriesEditor;
    }

    public function isValidEditorCategory(int $category_id)
    {
        $validCategories = $this->getEditorCategories();

        foreach ($validCategories as $key => $category) {
            if ($category->id == $category_id) {
                return true;
            }
        }

        return false;
    }
}
