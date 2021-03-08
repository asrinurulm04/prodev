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
            $table->string('no_katpang');
            $table->integer('batas_air');
            $table->string('mk_Enterobacter');
            $table->string('mk_Salmonella');
            $table->string('mk_aureus');
            $table->string('mk_TPC');
            $table->string('mk_Yeast');
            $table->string('mk_Coliform');
            $table->string('mk_Coli');
            $table->string('mk_Bacilluscereus');
            $table->string('mb_Enterobacter');
            $table->string('mb_Salmonella');
            $table->string('mb_aureus');
            $table->string('mb_TPC');
            $table->string('mb_Yeast');
            $table->string('mb_Coliform');
            $table->string('mb_Coli');
            $table->string('mb_Bacilluscereus');
            $table->string('as');
            $table->string('hg');
            $table->string('pb');
            $table->string('sn');
            $table->string('cd');
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
