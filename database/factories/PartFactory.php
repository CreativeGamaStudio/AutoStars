<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\part>
 */
class PartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'barcode'=> fake()->numberBetween(10000, 100000),
            'partcode' => fake() -> numberBetween(10000, 100000),
            'name' => fake()->text(),
            'qty' =>fake() -> numberBetween(1, 100),
            'selling_price' =>fake() -> numberBetween(10000, 100000),
            'purchase_price' =>fake() -> numberBetween(10000, 100000),
        ];
    }
}
