<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrLogamBeratBb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_logam_berat_bb', function (Blueprint $table) {
            $table->increments('id_logam_berat');
            $table->integer('id')->nullable();
            $table->integer('id_bahan');
            $table->double('As')->nullable()->default('0');
            $table->double('hg')->nullable()->default('0');
            $table->double('pb')->nullable()->default('0');
            $table->double('sn')->nullable()->default('0');
            $table->double('cd')->nullable()->default('0');
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
        Schema::dropIfExists('tr_logam_berat_bb');
    }
}
