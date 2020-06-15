<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbHitungHaksTable extends Migration
{
    /**
     * Run the migrations.
     *x
     * @return void
     */
    public function up()
    {
        Schema::create('tb_hitung_haks', function (Blueprint $table) {
            $table->increments('id_hak');
            $table->integer('id_analisa')->index();
            $table->double('jumlah');
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
        Schema::dropIfExists('tb_hitung_haks');
    }
}
