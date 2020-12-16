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
        Schema::create('hasil_panel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_formula');
            $table->enum('panel',['PFT Non Forced Choice','Uji 2 Rata-rata','DDT','PFT','TAT','AIT','HTT','DCT','Tetrad','HRT','Duo Trio'])->nullable();
            $table->date('tgl_formula')->nullable();
            $table->string('formula');
            $table->string('nilai');
            $table->string('hasil')->nullable();
            $tabel->string('rata-rata')->nullable();
            $table->string('panelis');
            $table->string('serving');
            $table->string('hus');
            $table->text('komentar');
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
        Schema::dropIfExists('hasil_panel');
    }
}
