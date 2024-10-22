<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;


class EventSpeakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();

        for($i = 0 ; $i < 20; $i++) {
            DB::table('event_speakers')->insert([
                'name' => $faker->sentence(3),
                'title' => $faker->sentence(3),
                'social_media' => $faker->sentence(3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }

    }
}

