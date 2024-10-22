<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('events')->insert([
                'title' => $faker->sentence(3),
                'theme' => $faker->word,
                'description' => $faker->paragraph,
                'objective' => $faker->sentence(6),
                'location' => $faker->city,
                'date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d H:i:s'),
                'ticket_price' => $faker->randomFloat(2, 10, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
