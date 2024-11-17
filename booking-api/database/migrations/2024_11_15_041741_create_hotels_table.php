<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->string('poster_url', 100)->nullable();
            $table->string('address', 500);
            $table->timestamps(); // автоматически добавит created_at и updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
