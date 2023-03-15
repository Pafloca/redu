<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servei extends Model
{
    use HasFactory;
    protected $table = 'serveis';

    public function profesoresSala(){
        return $this->belongsToMany(Profesor::class, 'servei_profesor')->where('tipo', '=', 'sala');
    }
    public function profesoresCoc(){
        return $this->belongsToMany(Profesor::class, 'servei_profesor')->where('tipo', '=', 'cocina');
    }
    public function profesores(){
        return $this->belongsToMany(Profesor::class, 'servei_profesor');
    }
}
