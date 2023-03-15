<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;
    protected $table = 'groups';

    public function alumnGroup(){
        return $this->belongsToMany(User::class, 'user_group')->where('rol', '=', 'alumn');
    }

    public function teacherGroup(){
        return $this->belongsToMany(User::class, 'user_group')->where('rol', '=', 'teacher');
    }
}
