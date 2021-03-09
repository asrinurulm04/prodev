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
        Schema::create('ms_formulas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workbook_id')->index()->nullable();
            $table->integer('workbook_pdf_id')->index()->nullable();
            $table->integer('akg')->index()->nullable();
            $table->text('formula');
            $table->integer('versi');
            $table->integer('turunan')->default('0');
            $table->integer('subbrand_id')->index()->nullable();
            $table->integer('overage')->nullable();
            $table->enum('jenis',['baru','revisi'])->nullable();
            $table->integer('serving_size')->nullable();
            $table->string('satuan')->nullable();
            $table->string('berat_jenis')->nullable();
            $table->enum('kategori',['fg','granulasi','premix'])->nullable()->default('fg');
            $table->double('batch')->nullable();
            $table->double('serving')->nullable();
            $table->double('liter')->nullable();
            $table->text('catatan_pv')->nullable();
            $table->text('catatan_rd')->nullable();
            $table->text('catatan_manager')->nullable();
            $table->text('note_formula')->nullable();
            $table->enum('status',['draft','proses','selesai'])->default('draft');
            $table->enum('vv',['proses','ok','tidak','approve','final','reject'])->nullable();
            $table->enum('status_fisibility',['not_approved','proses', 'approved','selesai'])->nullable();
            $table->enum('status_panel',['not_approved','proses', 'approved','selesai','sent'])->nullable()->default('proses');
            $table->enum('status_storage',['not_approved','proses', 'approved','selesai','sent'])->nullable()->default('proses');
            $table->string('tgl_create')->nullable();
            $table->string('tgl_kirim')->nullable();
            $table->string('file')->nullable();
            $table->integer('pangan')->nullable();
            $table->integer('batas_air')->nullable();
            $table->integer('batas_saji')->nullable();
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
        Schema::dropIfExists('ms_formulas');
    }
}
