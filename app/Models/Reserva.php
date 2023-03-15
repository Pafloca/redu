<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table = 'reservas';
    public function fecha(){
        return $this->belongsTo(Servei::class);
    }
    public function alergenos(){
        return $this->belongsToMany(Alergeno::class, 'alergeno_reserva');
    }
    public function profesors(){
        return $this->belongsToMany(Profesor::class);
    }
}
