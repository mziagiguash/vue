<?php

namespace Database\Factories;

use PharIo\Manifest\Url;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->company(),
            'description' => fake()->sentence(6),
            'address' => fake()->address(),
            'poster_url' => Storage::fake('public')->put('/hotels/', 'image.jpeg')
        ];
    }
}
