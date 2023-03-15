<?php

namespace Database\Seeders;

use App\Models\Profesor;
use App\Models\Reserva;
use App\Models\Servei;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serveis = Servei::all();
        $serveis->each(function ($servei){
            Reserva::factory(2)->create([
                'servei_id' => $servei->id
            ]);
        });
    }
}
