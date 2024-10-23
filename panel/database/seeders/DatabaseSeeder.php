<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Conference;
use App\Models\EventSpeaker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersSeeder::class);
//        $this->call(EventSeeder::class);
        $this->call(AgendaSeeder::class);
        $this->call(BlogsSeeder::class);
        $this->call(ConferenceSeeder::class);
//        $this->call(EventSpeakerSeeder::class);
        $this->call(SpecialGuestSeeder::class);
    }
}
