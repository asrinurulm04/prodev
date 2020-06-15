<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fs_dataoh', function (Blueprint $table) {
            $table->increments('id_oh');
            $table->integer('id_feasibility')->unsigned();
            $table->integer('SDM')->default('10');
            $table->integer('runtime')->nullable();
			$table->integer('rate_aktifitas')->nullable();
			$table->integer('hasil')->nullable();
            $table->integer('standar_sdm')->default('10');
            $table->integer('id_aktifitasOH')->nullable();
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
        Schema::dropIfExists('fs_OH');
    }
}
