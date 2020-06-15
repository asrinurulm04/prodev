<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBahanbaku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahans', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nama_sederhana')->default('-');
          $table->string('nama_bahan');
          $table->string('kode_oracle')->nullable()->default('-');
          $table->string('kode_komputer')->nullable()->default('-');
          $table->string('supplier')->nullable();
          $table->string('principle')->nullable();
          $table->string('nama_formB')->nullable();
          $table->string('no_HEIPBR')->nullable()->default('-');
          $table->string('PIC')->nullable()->default('-');
          $table->string('cek_halal')->nullable()->default('-');
          $table->double('berat');
          $table->integer('satuan_id')->index();
          $table->integer('subkategori_id')->index();
          $table->double('harga_satuan');
          $table->integer('curren_id')->index();
          $table->integer('user_id')->index();
          $table->integer('kelompok_id')->index();
          $table->enum('status',['active','proses',''])->default('active');
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
        Schema::dropIfExists('bahans');
    }
}
