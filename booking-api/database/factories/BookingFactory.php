<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('next Monday', 'next Monday +7 days');

        return [
            'room_id' => fake()->randomElement(Room::pluck('id')->toArray()),
            'user_id' => fake()->randomElement(User::pluck('id')->toArray()),
            'status_id' => fake()->numberBetween(1, 4),
            'started_at' => fake()->dateTimeBetween('next Monday', 'next Monday +7 days'),
            'finished_at' => fake()->dateTimeBetween($start, $start->format('Y-m-d H:i:s').' +2 days'),
            'days' => fake()->numberBetween(2, 10),
            'price' => fake()->numberBetween(5000, 10000),
        ];
    }
}
