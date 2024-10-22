<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialGuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('special_guests_speakers')->insert([
                'name' => $faker->sentence(3),
                'title' => $faker->sentence(3),
                'category' => $faker->sentence(3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
