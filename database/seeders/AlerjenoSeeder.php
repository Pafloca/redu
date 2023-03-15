<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlerjenoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nombreAlerjenos = ['Gluten','Crustáceos','Huevos','Pescado','Cacahuetes','Soja',
            'Lácteos','Frt. cáscara','Apio','Mostaza','Sésamo','Sulfitos',
            'Moluscos','Altamuzes'];
        for ($i = 0; $i < 14; $i++){
            Db::table('alergenos')->insert([
                'nombre' => $nombreAlerjenos[$i],
                'icono' => $i.'.png'
            ]);
        }
    }
}
