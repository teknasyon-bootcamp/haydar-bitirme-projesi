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
}
