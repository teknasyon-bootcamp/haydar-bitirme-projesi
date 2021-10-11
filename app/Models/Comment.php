<?php

namespace App\Models;

use Core\Model;

class Comment extends Model
{
    public function userName()
    {
        if ($this->user_id != null) {
            return User::find($this->user_id)->name;
        }

        return 'Anonim';
    }
}
