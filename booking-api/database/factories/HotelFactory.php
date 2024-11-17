<?php

// database/factories/HotelFactory.php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\Facility;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    public function definition()
    {
        return [
            'title' => $this->faker->company,
            'description' => $this->faker->paragraph,
            'poster_url' => $this->faker->imageUrl,
            'address' => $this->faker->address,
        ];
    }

    public function withFacilities()
    {
        return $this->afterCreating(function (Hotel $hotel) {
            $facilities = Facility::inRandomOrder()->take(3)->pluck('id');
            $hotel->facilities()->attach($facilities);
        });
    }
}
