<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbTransaksiCemaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi_cemarans', function (Blueprint $table) {
            $table->increments('id_tc');
            $table->integer('jenis_cemaran')->index();
            $table->integer('parameter_cemaran')->index();
            $table->integer('jenis_makanan')->index();
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
        Schema::dropIfExists('tb_transaksi_cemarans');
    }
}
