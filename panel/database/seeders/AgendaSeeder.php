<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            DB::table('agendas')->insert([
                'description' => $faker->sentence(6),
                'date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
