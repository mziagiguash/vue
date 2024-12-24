<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->numberBetween(1, 100),
            'description' => fake()->text(50),
            'floor_area' => fake()->numberBetween(10, 50),
            'type' => fake()->sentence(1),
            'price' => fake()->numberBetween(5000, 10000),
            'hotel_id' => fake()->randomElement(Hotel::pluck('id')->toArray()),
        ];
    }
}
