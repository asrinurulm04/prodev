<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKonsepkemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fs_konsep_kemas', function (Blueprint $table) {
            $table->increments('id_konsep_kemas');
            $table->integer('id_feasibility');
            $table->enum('konsep',['Modern','tradisional']);
            $table->integer('primer');
            $table->string('s_primer',6);
            $table->integer('tersier');
            $table->string('s_tersier',6);
            $table->integer('sekunder');
            $table->string('s_sekunder',6);
            $table->integer('tersier2')->nullable();
            $table->string('s_tersier2',6)->nullable();
            $table->integer('palet_batch');
            $table->integer('box_palet');
            $table->integer('box_layer');
            $table->string('kubikasi',6);
            $table->integer('batch');
            $table->double('renceng')->nullable();
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
        Schema::dropIfExists('fskonsep_kemas');
    }
}
