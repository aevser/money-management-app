<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Заполнение тестовыми данными
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 20; $i++) {
            $user = \App\Models\User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('123456')
            ]);

            \App\Models\Transaction::create([
                'user_id' => $user->id,
                'type' => $faker->randomElement(['Доходы', 'Расходы']),
                'amount' => $faker->randomFloat(2, 10, 1000),
                'date' => $faker->date(),
                'description' => $faker->text()
            ]);
        }
    }
}
