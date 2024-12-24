<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Hotel;
use App\Models\Facility;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::factory(5)
                ->has(Hotel::factory()->count(10))
                ->has(Room::factory()->count(20))
                ->create();
    }
}
