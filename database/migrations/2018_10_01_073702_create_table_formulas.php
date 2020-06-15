<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFormulas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formulas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workbook_id')->index();
            $table->string('revisi')->nullable();
            $table->integer('versi');
            $table->integer('turunan')->default('0');
            $table->string('kode_formula');
            $table->integer('subbrand_id')->index()->nullable();
            $table->string('nama_produk');
            $table->integer('produksi_id')->index()->nullable();
            $table->integer('maklon_id')->index()->nullable();
            $table->integer('gudang_id')->index()->nullable();
            $table->enum('jenis',['baru','revisi'])->nullable();
            $table->string('main_item')->nullable();
            $table->string('main_item_eks')->nullable();
            $table->double('bj')->nullable();
            $table->double('batch')->nullable();
            $table->double('serving')->nullable();
            $table->double('liter')->nullable();
            $table->enum('kfp_premix',['ya','tidak'])->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status',['draft','proses','selesai'])->default('draft');
            $table->enum('vv',['proses','ok','tidak'])->nullable();
            $table->enum('status_fisibility',['not_approved','proses', 'approved'])->nullable();
            $table->enum('status_nutfact',['not_approved','proses', 'approved'])->nullable();
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
        Schema::dropIfExists('formulas');
    }
}
