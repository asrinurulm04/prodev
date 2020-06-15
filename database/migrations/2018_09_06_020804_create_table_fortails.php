<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFortails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortails', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('formula_id')->index();
          $table->text('kode_komputer');
          $table->text('nama_sederhana');
          $table->text('kode_oracle');
          $table->integer('bahan_id')->index();
          $table->text('nama_bahan');
          $table->double('per_batch')->nullable();
          $table->double('per_serving');
          $table->enum('jenis_timbangan',['A','B']);
          $table->text('alternatif')->nullable();
          $table->integer('kode_komputer2')->nullable();
          $table->integer('kode_komputer3')->nullable();
          $table->integer('kode_komputer4')->nullable();
          $table->integer('kode_komputer5')->nullable();
          $table->enum('granulasi',['ya','tidak'])->nullable();
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
        Schema::dropIfExists('fortails');
    }
}
