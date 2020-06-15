<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSTDTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fs_STD_yield_produksi', function (Blueprint $table) {
            $table->increments('id_SYP');
            $table->integer('id_feasibility')->unsigned();
            $table->string('nama_item', 150);
            $table->integer('kode_item');
            $table->double('yield');
            $table->text('catatan', 25);
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
        Schema::dropIfExists('fs_STD_yield_produksi');
    }
}
