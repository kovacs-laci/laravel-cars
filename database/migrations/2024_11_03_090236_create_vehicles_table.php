<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('maker_id')->index()->nullable();
            $table->foreign('maker_id')->references('id')->on('makers');
            $table->unsignedBigInteger('model_id')->index()->nullable();
            $table->foreign('model_id')->references('id')->on('models');
            $table->unsignedBigInteger('trim_id')->index()->nullable();
            $table->foreign('trim_id')->references('id')->on('trims');
            $table->unsignedBigInteger('fuel_id')->index()->nullable();
            $table->foreign('fuel_id')->references('id')->on('fuels');
            $table->unsignedBigInteger('body_id')->index()->nullable();
            $table->foreign('body_id')->references('id')->on('bodies');
            $table->unsignedBigInteger('transmission_id')->index()->nullable();
            $table->foreign('transmission_id')->references('id')->on('transmissions');
            $table->unsignedBigInteger('color_id')->index()->nullable();
            $table->foreign('color_id')->references('id')->on('colors');

            $table->string('registration_plate')->index();
            $table->string('vin')->index()->unique()->nullable();
            $table->integer('production_year')->nullable();
            $table->string('engine_id')->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('power')->nullable();
            $table->date('valid_until')->nullable();
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
