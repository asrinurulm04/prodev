<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrMikroBb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_mikro_bb', function (Blueprint $table) {
            $table->increments('id_mikro');
            $table->integer('id')->nullable();
            $table->integer('id_bahan');
            $table->double('Enterobacter')->nullable()->default('0');
            $table->double('Salmonella')->nullable()->default('0');
            $table->double('aureus')->nullable()->default('0');
            $table->double('TPC')->nullable()->default('0');
            $table->double('Yeast')->nullable()->default('0');
            $table->double('Coliform')->nullable()->default('0');
            $table->double('Coli')->nullable()->default('0');
            $table->double('Bacilluscereus')->nullable()->default('0');
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
        Schema::dropIfExists('tr_mikro_bb');
    }
}
