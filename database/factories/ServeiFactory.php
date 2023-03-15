<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servei>
 */
class ServeiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'horariIni' => '14:00',
            'horariFin' => '16:00',
            'fecha' => fake()->date(),
            'places' => fake()->numberBetween(10,15),
            'overbooking' => fake()->numberBetween(1,5),
            'llistaEspera' => fake()->numberBetween(0,5),
        ];
    }
}
