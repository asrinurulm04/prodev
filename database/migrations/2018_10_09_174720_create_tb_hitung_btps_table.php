<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbHitungBtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_hitung_btps', function (Blueprint $table) {
            $table->increments('id_btp');
            $table->integer('premix')->index();
            $table->double('jumlah');
            $table->double('limit');
            $table->double('limit2');
            $table->double('keterangan');
            $table->enum('status',['Belum Selesai','Selesai']);
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
        Schema::dropIfExists('tb_hitung_btps');
    }
}
