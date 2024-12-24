<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Factories\FacilityFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(HotelSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FacilitySeeder::class);
        $this->call(BookingSeeder::class);
    }
}
