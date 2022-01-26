<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrMineralBb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_mineral_bb', function (Blueprint $table) {
            $table->increments('id_mineral');
            $table->integer('id')->nullable();
            $table->integer('id_bahan');
            $table->double('ca')->nullable();
            $table->double('mg')->nullable();
            $table->double('k')->nullable();
            $table->double('zink')->nullable();
            $table->double('na')->nullable();
            $table->double('naci')->nullable();
            $table->double('energi')->nullable();
            $table->double('fosfor')->nullable();
            $table->double('mn')->nullable();
            $table->double('cr')->nullable();
            $table->double('fe')->nullable();
            $table->double('yodium')->nullable();
            $table->double('selenium')->nullable();
            $table->double('fluor')->nullable();
            $table->double('cu')->nullable();
            $table->string('satuan_ca',11)->nullable();
            $table->string('satuan_mg',11)->nullable();
            $table->string('satuan_k',11)->nullable();
            $table->string('satuan_zink',11)->nullable();
            $table->string('satuan_na',11)->nullable();
            $table->string('satuan_naci',11)->nullable();
            $table->string('satuan_energi',11)->nullable();
            $table->string('satuan_fosfor',11)->nullable();
            $table->string('satuan_mn',11)->nullable();
            $table->string('satuan_cr',11)->nullable();
            $table->string('satuan_fe',11)->nullable();
            $table->string('satuan_yodium',11)->nullable();
            $table->string('satuan_selenium',11)->nullable();
            $table->string('satuan_fluor',11)->nullable();
            $table->string('satuan_cu',11)->nullable();
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
        Schema::dropIfExists('tr_mineral_bb');
    }
}
