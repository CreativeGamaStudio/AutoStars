<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'barcode' => fake()->numberBetween(1000, 100000),
            'police_number' => fake()->numberBetween(1000, 100000),
            'date' => fake()->date(),
            'odometer' => fake()->numberBetween(10, 100000),
            'pkb_flag' => fake()->randomElement(['1', '2']),
            'status' => fake()->randomElement(['Service', 'Repair'])
        ];
    }
}
