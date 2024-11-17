<?php

// database/seeders/RoomSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        Room::factory(30)
            ->withFacilities() // Добавляем удобства к номерам
            ->create(); // Создаем 30 номеров
    }
}

