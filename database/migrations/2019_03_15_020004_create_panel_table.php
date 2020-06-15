<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePanelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panel', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('panel',['PFT Non Forced Choice','Uji 2 Rata-rata','DDT','PFT','TAT','AIT','HTT','DCT','Tetrad','HRT','Duo Trio']);
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
        Schema::dropIfExists('panel');
    }
}
