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
        Schema::create('ms_bahans', function (Blueprint $table) {
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
          $table->double('berat');
          $table->string('satuan')->index();
          $table->integer('subkategori_id')->index();
          $table->double('harga_satuan');
          $table->integer('curren_id')->index();
          $table->integer('user_id')->index();
          $table->string('created_date')->index();
          $table->string('last_update')->index();
          $table->string('updated_by')->index();
          $table->enum('status',['active','inactive',''])->default('active');
          $table->enum('status_bb',['eksis','baru',''])->default('baru');
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
        Schema::dropIfExists('ms_bahans');
    }
}
