<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ingredients', function (Blueprint $table) {
            $table->increments('id_ingredient');
            $table->string('ingredient');
            $table->double('fat');
            $table->double('SFA');
            $table->double('karbohidrat');
            $table->double('gula_total');
            $table->double('laktosa');
            $table->double('sukrosa');
            $table->double('serat');
            $table->double('serat_larut');
            $table->double('protein');
            $table->double('na(mg)');
            $table->double('k(mg)');
            $table->double('ca(mg)');
            $table->double('p(mg)');
            $table->double('beta_glucan');
            $table->double('cr(mcg)');
            $table->double('vitC(mg)');
            $table->double('vitE(mg)');
            $table->double('vitD(iu)');
            $table->double('cartining(mg)');
            $table->double('CLA(mg)');
            $table->double('sterol_ester(mg)');
            $table->double('chondroitin(mg)');
            $table->double('Omega3');
            $table->double('DHA');
            $table->double('EPA');
            $table->double('creatine');
            $table->double('lysine');
            $table->double('glucosamine(mg)');
            $table->double('kolin');
            $table->double('MUFA');
            $table->double('linoleic_acid(omega6)');
            $table->double('linolein_acid');
            $table->double('linolein_acid(omega9');
            $table->double('sorbitol');
            $table->double('martitol');
            $table->double('kafein');
            $table->double('kolestrol(mg/g)');
            $table->double('glukosa1(mg)');
            $table->double('glukosa2/(mg');
            $table->double('L-Glutamin');
            $table->double('Threoin');
            $table->double('methioin');
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
        Schema::dropIfExists('tb_ingredients');
    }
}
