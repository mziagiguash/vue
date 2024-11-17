<?php

// database/factories/RoomFactory.php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Hotel;
use App\Models\Facility;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'poster_url' => $this->faker->imageUrl,
            'floor_area' => $this->faker->randomFloat(2, 20, 100),
            'type' => $this->faker->randomElement(['Single', 'Double', 'Suite']),
            'price' => $this->faker->numberBetween(2000, 10000),
            'hotel_id' => Hotel::factory(), // Связь с отелем
        ];
    }

    public function withFacilities()
    {
        return $this->afterCreating(function (Room $room) {
            $facilities = Facility::inRandomOrder()->take(2)->pluck('id');
            $room->facilities()->attach($facilities);
        });
    }
}
