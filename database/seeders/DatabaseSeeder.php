<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 6; $i++) {
            \App\Models\User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123456')
            ]);
        }
    }
}
