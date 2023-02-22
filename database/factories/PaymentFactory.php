<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'price' => fake()->numberBetween(1000, 100000),
            'discount' => fake()->numberBetween(0, 100),
            'date' => fake()->dateTimeBetween('-1 year', 'now'),
            'giro_number' => fake()->numberBetween(100000, 999999),
            'card_number' => fake()->numberBetween(100000, 999999),
        ];
    }
}
