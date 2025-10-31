<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //INSERT INTO users () VALUES ();
        $faker = \Faker\Factory::create("id_ID");
        for ($i=1; $i <= 10; $i++) {
            User::create([
                "name" => $faker->name(),
                "email" => $faker->email(),
                "password" => \Illuminate\Support\Facades\Hash::make("12345678")
            ]);
        }
    }
}
