<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            Users::create([
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'bio' => $faker->text(200),
                'title' => $faker->jobTitle,
                'phone' => $faker->phoneNumber,
                'city' => $faker->city,
                'country' => $faker->country,
                'cv_upload' => $faker->word . '.pdf',
                'photo_upload' => $faker->imageUrl(640, 480, 'people'),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);
        }
    }
}
