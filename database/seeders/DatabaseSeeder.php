<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Item::factory(10)->create();

        \App\Models\Invoice::factory(10)->create();

        \App\Models\Customer::factory(10)->create();

        \App\Models\Employee::factory(10)->create();

        \App\Models\User::factory(10)->create();

        // \App\Models\Vehicle::factory(10)->create();

        // \App\Models\Part::factory(10)->create();

        \App\Models\Registration::factory(10)->create();

        \App\Models\Order::factory(10)->create();

        \App\Models\Payment::factory(10)->create();

        // \App\Models\Note::factory(10)->create();

        \App\Models\ReturnNote::factory(10)->create();

        \App\Models\Service::factory(10)->create();


    }
}
