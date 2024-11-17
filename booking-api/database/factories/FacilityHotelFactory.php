<?php

namespace Database\Factories;

use App\Models\Facility;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacilityHotelFactory extends Factory
{
    public function definition()
    {
        return [
            'facility_id' => Facility::factory(),
            'hotel_id' => Hotel::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
