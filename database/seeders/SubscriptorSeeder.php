<?php

namespace Database\Seeders;

use App\Models\Reserva;
use App\Models\Servei;
use App\Models\Subscriptor;
use App\Models\User;
use Database\Factories\SubscriptorFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subs = Reserva::where('subscripcio',1);

        $subs->each(function ($sub){
           Db::table('subscriptores')->insert([
              'nombre' => $sub->nombre,
               'email' => $sub->email
           ]);
        });
    }
}
