<?php

namespace Database\Factories;

use App\Models\Profesor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $profesor = Profesor::inRandomOrder()->first();
        return [

            'nombre' => $profesor->nombre,
            'email' => $profesor->nombre.'@gmail.com',
            'telefono' => '123456789',
            'comensales' => fake()->numberBetween(1,10),
            'comentario' => 'Un celiaco',
            'localizador' => Str::random(5),
            'confirmada' => false,
            'subscripcio' => (bool)rand(0, 1),

        ];
    }
}
