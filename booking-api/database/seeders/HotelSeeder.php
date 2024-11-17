<?php

// database/seeders/HotelSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    public function run()
    {
        Hotel::factory(10)
            ->withFacilities() // Добавляем удобства к отелям
            ->create(); // Создаем 10 отелей
    }
}
