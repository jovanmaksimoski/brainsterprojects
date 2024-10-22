<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            DB::table('blogs')->insert([
                'title' => $faker->sentence(6),
                'body' => $faker->paragraph(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
