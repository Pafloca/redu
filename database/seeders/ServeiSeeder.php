<?php

namespace Database\Seeders;

use App\Models\Servei;
use App\Models\User;
use Database\Factories\ServeiFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServeiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $users->each(function ($user){
           Servei::factory(2)->create([
               'user_id' => $user->id
           ]);
        });
    }
}
