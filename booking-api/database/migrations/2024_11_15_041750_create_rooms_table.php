<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->string('poster_url', 100)->nullable();
            $table->decimal('floor_area', 8, 2);
            $table->string('type', 100);
            $table->integer('price');
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade'); // FK с автоматической привязкой к таблице hotels
            $table->timestamps(); // created_at и updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
