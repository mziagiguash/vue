<?php

namespace Database\Factories;

use App\Models\Facility;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacilityRoomFactory extends Factory
{
    public function definition()
    {
        return [
            'facility_id' => Facility::factory(),
            'room_id' => Room::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
