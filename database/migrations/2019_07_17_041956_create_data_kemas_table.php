<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataKemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kemas', function (Blueprint $table) {
            $table->increments('id_kemas');
            $table->string('tersier')->nullable();
            $table->string('s_tersier')->nullable();
            $table->string('sekunder1')->nullable();
            $table->string('s_sekunder1')->nullable();
            $table->string('sekunder2')->nullable();
            $table->string('s_sekunder2')->nullable();
            $table->string('tersier')->nullable();
            $table->string('s_tersier')->nullable();
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
        Schema::dropIfExists('data_kemas');
    }
}
