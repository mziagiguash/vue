<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\FacilityHotel;
use App\Models\FacilityRoom;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run()
    {
        // Создаем несколько удобств
        $facilities = Facility::factory(10)->create();

        // Создаем отели
        $hotels = Hotel::factory(5)->create();

        // Создаем номера
        $rooms = Room::factory(20)->create();

        // Создаем связи между отелями и удобствами
        foreach ($hotels as $hotel) {
            $hotel->facilities()->attach($facilities->random(3)); // связываем 3 случайных удобства с каждым отелем
        }

        // Создаем связи между номерами и удобствами
        foreach ($rooms as $room) {
            $room->facilities()->attach($facilities->random(2)); // связываем 2 случайных удобства с каждым номером
        }
    }
}
