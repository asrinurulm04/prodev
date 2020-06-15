<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbNutritionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_nutritions', function (Blueprint $table) {
            $table->increments('id_nut');
            $table->integer('id_formula');
            $table->integer('bahan')->index();
            $table->integer('btp')->index();
            $table->double('Lemak');
            $table->double('SFA');
            $table->double('karbohidrat');
            $table->double('gula_total');
            $table->double('laktosa');
            $table->double('sukrosa');
            $table->double('serat');
            $table->double('serat_larut');
            $table->double('protein');
            $table->double('kalori');
            $table->double('na');
            $table->double('k');
            $table->double('ca');
            $table->double('mg');
            $table->double('p');
            $table->double('beta_glucan');
            $table->double('cr');
            $table->double('vit_c');
            $table->double('vit_e');
            $table->double('vit_d');
            $table->double('carnitin');
            $table->double('cla');
            $table->double('sterol_ester');
            $table->double('chondroitin');
            $table->double('omega_3');
            $table->double('dha');
            $table->double('epa');
            $table->double('creatine');
            $table->double('lysine');
            $table->double('glucosamine');
            $table->double('kolin');
            $table->double('mufa');
            $table->double('linoleic_acido6');
            $table->double('linoleic_acid');
            $table->double('oleic_acid');
            $table->double('sorbitol');
            $table->double('maltitol');
            $table->double('kafein');
            $table->double('kolestrol');
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
        Schema::dropIfExists('tb_nutrition');
    }
}