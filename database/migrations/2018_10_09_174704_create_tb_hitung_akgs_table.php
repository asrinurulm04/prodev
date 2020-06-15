<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbHitungAkgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_hitung_akgs', function (Blueprint $table) {
            $table->increments('id_akg');
            $table->integer('id_hitung_hak')->index();
            $table->double('pembulatan');
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
        Schema::dropIfExists('tb_hitung_akgs');
    }
}
