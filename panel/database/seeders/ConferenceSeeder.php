<?php

namespace Database\Seeders;

use App\Models\Conference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class ConferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {

            DB::table('conferences')->insert([
                'title' => $faker->sentence(3),
                'theme' => $faker->word,
                'description' => $faker->paragraph,
                'objective' => $faker->sentence(6),
                'location' => $faker->city,
                'date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'),
                'status' => $faker->sentence(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
