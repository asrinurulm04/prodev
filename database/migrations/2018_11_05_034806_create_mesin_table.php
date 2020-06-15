<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMesinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fs_mesin', function (Blueprint $table) {
            $table->increments('id_mesin');
            $table->integer('id_feasibility')->unsigned();
            $table->integer('id_data_mesin')->nullable();
            $table->integer('runtime')->nullable();
            $table->integer('standar_sdm')->default('10');
            $table->integer('SDM')->default('10');
            $table->integer('rate_mesin')->nullable();
            $table->integer('hasil')->nullable();
            $table->integer('line')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fs_mesin');
    }
}
