<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id(); // bigint unsigned
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade'); // FK к таблице rooms
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // FK к таблице users
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('finished_at')->useCurrent();
            $table->integer('days');
            $table->integer('price');
            $table->timestamps(); // created_at и updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}


