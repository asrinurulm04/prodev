<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsCemaranCeklisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_cemaran_ceklis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_katpang',45)->nullable();
            $table->integer('batas_air',45)->nullable();
            $table->string('mk_Enterobacter',45)->nullable();
            $table->string('mk_Salmonella',45)->nullable();
            $table->string('mk_aureus',45)->nullable();
            $table->string('mk_TPC',45)->nullable();
            $table->string('mk_Yeast',45)->nullable();
            $table->string('mk_Coliform',45)->nullable();
            $table->string('mk_Coli',45)->nullable();
            $table->string('mk_Bacilluscereus',45)->nullable();
            $table->string('mb_Enterobacter',45)->nullable();
            $table->string('mb_Salmonella',45)->nullable();
            $table->string('mb_aureus',45)->nullable();
            $table->string('mb_TPC',45)->nullable();
            $table->string('mb_Yeast',45)->nullable();
            $table->string('mb_Coliform',45)->nullable();
            $table->string('mb_Coli',45)->nullable();
            $table->string('mb_Bacilluscereus',45)->nullable();
            $table->string('as',45)->nullable();
            $table->string('hg',45)->nullable();
            $table->string('pb',45)->nullable();
            $table->string('sn',45)->nullable();
            $table->string('cd',45)->nullable();
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
        Schema::dropIfExists('ms_cemaran_ceklis');
    }
}
