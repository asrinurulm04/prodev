<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHasilPanelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_hasil_panel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_formula');
            $table->integer('id_wb')->nullable();
            $table->integer('id_wb_pdf')->nullable();
            $table->enum('panel',['PFT Non Forced Choice','Uji 2 Rata-rata','DDT','PFT','TAT','AIT','HTT','DCT','Tetrad','HRT','Duo Trio'])->nullable();
            $table->date('tgl_panel')->nullable();
            $table->string('hus');
            $table->enum('status',['proses','done'])->default('proses');
            $table->text('kesimpulan');
            $tabel->string('');
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
        Schema::dropIfExists('tr_hasil_panel');
    }
}
