<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
//        Schema::table('car_db', function (Blueprint $table) {
//            $table->index('make');
//            $table->index('model');
//            $table->index('trim');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('car_db', function (Blueprint $table) {
//            $table->dropIndex('make');
//            $table->dropIndex('model');
//            $table->dropIndex('trim');
//        });
    }
};
