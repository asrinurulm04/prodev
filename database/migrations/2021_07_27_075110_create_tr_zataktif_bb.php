<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrZataktifBb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_zataktif_bb', function (Blueprint $table) {
            $table->increments('id_zataktif');
            $table->integer('id')->nullable();
            $table->integer('id_bahan');
            $table->string('zat_aktif')->nullable();
            $table->double('nominal')->nullable();
            $table->integer('id_satuan')->nullable();
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
        Schema::dropIfExists('tr_zataktif_bb');
    }
}
