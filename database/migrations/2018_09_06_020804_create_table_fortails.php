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
        Schema::create('tr_fortails', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('formula_id')->index();
          $table->text('kode_komputer')->nullable();
          $table->text('nama_sederhana')->nullable();
          $table->text('kode_oracle')->nullable();
          $table->integer('bahan_id')->index();
          $table->text('nama_bahan');
          $table->text('nama_bahan1')->nullable();
          $table->text('nama_bahan2')->nullable();
          $table->text('nama_bahan3')->nullable();
          $table->text('nama_bahan4')->nullable();
          $table->text('nama_bahan5')->nullable();
          $table->text('nama_bahan6')->nullable();
          $table->text('nama_bahan7')->nullable();
          $table->double('per_batch')->nullable();
          $table->double('per_serving')->nullable();
          $table->integer('bahan_baku')->nullable();
          $table->text('alternatif1')->nullable();
          $table->text('alternatif2')->nullable();
          $table->text('alternatif3')->nullable();
          $table->text('alternatif4')->nullable();
          $table->text('alternatif5')->nullable();
          $table->text('alternatif6')->nullable();
          $table->text('alternatif7')->nullable();
          $table->text('allergen')->nullable();
          $table->text('principle')->nullable();
          $table->text('principle1')->nullable();
          $table->text('principle2')->nullable();
          $table->text('principle3')->nullable();
          $table->text('principle4')->nullable();
          $table->text('principle5')->nullable();
          $table->text('principle6')->nullable();
          $table->text('principle7')->nullable();
          $table->integer('kode_komputer2')->nullable();
          $table->integer('kode_komputer3')->nullable();
          $table->integer('kode_komputer4')->nullable();
          $table->integer('kode_komputer5')->nullable();
          $table->integer('kode_komputer6')->nullable();
          $table->integer('kode_komputer7')->nullable();
          $table->enum('granulasi',['ya','tidak'])->nullable();
          $table->enum('premix',['ya','tidak'])->nullable();
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
        Schema::dropIfExists('tr_fortails');
    }
}
