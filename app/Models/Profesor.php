<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;
    protected $table = 'profesores';
    public $timestamps = false;
    public function serveis(){
        return $this->belongsToMany(Servei::class);
    }
}
