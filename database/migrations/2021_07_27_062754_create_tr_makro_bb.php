<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrMakroBb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_makro_bb', function (Blueprint $table) {
            $table->increments('id_makro');
            $table->integer('id')->nullable();
            $table->integer('id_bahan');
            $table->double('karbohidrat')->nullable()->default('0');
            $table->double('glukosa')->nullable()->default('0');
            $table->double('serat_pangan')->nullable()->default('0');
            $table->double('beta_glucan')->nullable()->default('0');
            $table->double('sorbitol')->nullable()->default('0');
            $table->double('maltitol')->nullable()->default('0');
            $table->double('laktosa')->nullable()->default('0');
            $table->double('sukrosa')->nullable()->default('0');
            $table->double('gula')->nullable()->default('0');
            $table->double('erythritol')->nullable()->default('0');
            $table->double('DHA')->nullable()->default('0');
            $table->double('EPA')->nullable()->default('0');
            $table->double('Omega3')->nullable()->default('0');
            $table->double('mufa')->nullable()->default('0');
            $table->double('fat')->nullable()->default('0');
            $table->double('lemak_trans')->nullable()->default('0');
            $table->double('lemak_jenuh')->nullable()->default('0');
            $table->double('omega6')->nullable()->default('0');
            $table->double('kolesterol')->nullable()->default('0');
            $table->double('protein')->nullable()->default('0');
            $table->double('kadar_air')->nullable()->default('0');
            $table->double('lemak')->nullable()->default('0');
            $table->double('omega9')->nullable()->default('0');
            $table->double('linoleat')->nullable()->default('0');
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
        Schema::dropIfExists('tr_makro_bb');
    }
}
