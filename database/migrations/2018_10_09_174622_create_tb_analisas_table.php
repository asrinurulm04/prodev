<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbAnalisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_analisas', function (Blueprint $table) {
            $table->increments('id_analisa');
            $table->integer('formula')->index();
            $table->integer('parameter')->index();
            $table->double('per_serving')->nullable();
            $table->double('hasil_analisa')->nullable();
            $table->double('akg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('tb_analisas');
    // }
}
