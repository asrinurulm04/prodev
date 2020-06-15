<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbBtpcosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_btpcos', function (Blueprint $table) {
            $table->increments('id_btp');
            $table->integer('kategori_btp')->index();
            $table->string('nama_bahan');
            $table->integer('bahan')->index();
            $table->string('nama_bahan_diformb');
            $table->integer('btp')->index();
            $table->string('wajib_dicantum');
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
        Schema::dropIfExists('tb_btpcos');
    }
}
