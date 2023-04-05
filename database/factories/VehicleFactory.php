<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'police_number' => fake()->numberBetween(1000, 100000),
            'engine_number' => fake()->numberBetween(1000, 100000),
            'type' => fake()->word(),
            'color' => fake()->word(),
            'merk' => fake()->word(),
            'year' => fake()->year(),
        ];
    }
}
