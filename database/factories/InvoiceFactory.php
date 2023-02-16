<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'invoice_date' => fake()->date(),
            'total' => fake()->numberBetween(1000, 100000),
            'paid' => fake()->numberBetween(1000, 100000),
            //
        ];
    }
}
