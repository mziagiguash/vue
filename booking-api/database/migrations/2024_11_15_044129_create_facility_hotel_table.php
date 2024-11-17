<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityHotelTable extends Migration
{
    public function up()
    {
        Schema::create('facility_hotel', function (Blueprint $table) {
            $table->id(); // ID записи связи
            $table->foreignId('facility_id')->constrained()->onDelete('cascade'); // Связь с удобством
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade'); // Связь с отелем
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('facility_hotel');
    }
}
