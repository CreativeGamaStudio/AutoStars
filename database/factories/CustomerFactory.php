<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),

            // fake phone number with max 13 characters, starts with 08
            // 'phone_number' => fake()->phoneNumber()->max(13)->starts('08'),

            'phone_number' => str_replace('+', '08', fake()->unique()->e164PhoneNumber()),
            'address' => fake()->address(),
            'city' => fake()->city(),
        ];
    }
}