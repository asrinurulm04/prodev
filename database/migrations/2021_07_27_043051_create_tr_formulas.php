<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrFormulas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_formulas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('workbook_id')->nullable();
            $table->integer('workbook_pdf_id')->nullable();
            $table->integer('akg')->nullable();
            $table->text('formula')->nullable();
            $table->integer('versi')->nullable();
            $table->integer('turunan')->nullable()->default('0');
            $table->integer('subbrand_id')->nullable();
            $table->integer('overage')->nullable();
            $table->enum('jenis',['baru','revisi'])->nullable();
            $table->string('serving_size',11)->nullable();
            $table->string('satuan')->nullable();
            $table->decimal('berat_jenis',9,3)->nullable();
            $table->enum('kategori',['fg','granulasi','premix'])->nullable()->default('fg');
            $table->decimal('batch',12,3)->nullable();
            $table->double('serving')->nullable();
            $table->double('liter')->nullable();
            $table->text('catatan_pv')->nullable();
            $table->text('catatan_rd')->nullable();
            $table->text('catatan_manager')->nullable();
            $table->text('note_formula')->nullable();
            $table->enum('status',['draf','proses','selesai'])->default('draf');
            $table->enum('vv',['proses','approve','ok','tidak','final','reject'])->nullable();
            $table->enum('status_fisibility',['proses','approve','not_approved','selesai'])->nullable();
            $table->enum('status_panel',['proses','approve','not_approved','sent','selesai'])->nullable()->default('proses');
            $table->enum('status_storage',['proses','approve','not_approved','sent','selesai'])->nullable()->default('proses');
            $table->string('tgl_create',110)->nullable();
            $table->string('tgl_kirim',110)->nullable();
            $table->string('file')->nullable()->nullable();
            $table->integer('pangan')->nullable();
            $table->decimal('batas_air',7,2)->nullable();
            $table->string('saran_saji',7,2)->nullable();
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
        Schema::dropIfExists('tr_formulas');
    }
}
