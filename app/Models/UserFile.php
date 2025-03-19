<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
    // ...

    // это настоящее название таблицы, но оно автоматически берется из названия модели, если правильно её назвать.
    // public $table = 'user_files';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}