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

        \App\Models\User::factory()->create([
            'name' => 'Harry Dan',
            'email' => 'user@example.com',
            'password' => bcrypt('user'),
            'role' => 'user'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Joseph Dan',
            'email' => 'rider@example.com',
            'password' => bcrypt('rider'),
            'role' => 'rider'
        ]);
    }
}
