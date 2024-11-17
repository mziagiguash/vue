<?php

namespace Database\Factories;

use App\Models\Facility;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacilityFactory extends Factory
{
    protected $model = Facility::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word, // Генерируем случайное название удобства
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
