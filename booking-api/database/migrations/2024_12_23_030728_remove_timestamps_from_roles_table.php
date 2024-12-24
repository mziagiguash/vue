<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTimestampsFromRolesTable extends Migration
{
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            if (Schema::hasColumn('roles', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('roles', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
        });
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->timestamps(); // Восстановление колонок, если потребуется
        });
    }
}
