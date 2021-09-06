<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrVitaminBb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_vitamin_bb', function (Blueprint $table) {
            $table->increments('id_vitamin');
            $table->integer('id')->nullable();
            $table->integer('id_bahan')->nullable();
            $table->integer('id_satuan_vitA')->nullable();
            $table->integer('id_satuan_vitB1')->nullable();
            $table->integer('id_satuan_vitB2')->nullable();
            $table->integer('id_satuan_vitB3')->nullable();
            $table->integer('id_satuan_vitB5')->nullable();
            $table->integer('id_satuan_vitB6')->nullable();
            $table->integer('id_satuan_vitB12')->nullable();
            $table->integer('id_satuan_vitC')->nullable();
            $table->integer('id_satuan_vitD')->nullable();
            $table->integer('id_satuan_vitE')->nullable();
            $table->integer('id_satuan_vitK')->nullable();
            $table->integer('id_satuan_folat')->nullable();
            $table->integer('id_satuan_biotin')->nullable();
            $table->integer('id_satuan_kolin')->nullable();
            $table->double('vitA')->nullable();
            $table->double('vitB1')->nullable();
            $table->double('vitB2')->nullable();
            $table->double('vitB3')->nullable();
            $table->double('vitB5')->nullable();
            $table->double('vitB6')->nullable();
            $table->double('vitB12')->nullable();
            $table->double('vitC')->nullable();
            $table->double('vitD')->nullable();
            $table->double('vitE')->nullable();
            $table->double('vitK')->nullable();
            $table->double('folat')->nullable();
            $table->double('biotin')->nullable();
            $table->double('kolin')->nullable();
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
        Schema::dropIfExists('tr_vitamin_bb');
    }
}
