<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpProjectPdfeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_pdf_project', function (Blueprint $table) {
            $table->increments('id_projet_pdf');
            $table->string('reference')->nullable();
            $table->string('pdf_number')->nullable();
            $table->string('ket_no')->nullable();
            $table->integer('prioritas')->nullable();
            $table->string('project_name');
            $table->string('id_brand');
            $table->integer('id_type')->nullable();
            $table->string('jenis')->nullable();
            $table->enum('product_type',['PDF','PDFe','PDFp']);
            $table->string('country');
            $table->string('created_date')->nullable();
            $table->enum('status',['active','nonactive']);
            $table->enum('status_project',['sent','draf','revisi','close','proses'])->nullable()->default('draf');
            $table->enum('status_freeze',['active','inactive'])->nullable()->default('inactive');
            $table->string('author')->nullable();
            $table->string('tujuankirim')->nullable();
            $table->string('tujuankirim2')->nullable()->default('0');
            $table->string('tgl_kirim')->nullable();
            $table->enum('status_terima',['terima','proses','tolak'])->nullable()->default('proses');
            $table->enum('status_terima2',['terima','proses','tolak'])->nullable()->default('proses');
            $table->integer('userpenerima')->nullable();
            $table->integer('userpenerima2')->nullable();
            $table->date('jangka')->nullable();
            $table->date('waktu')->nullable();
            $table->date('waktu_freeze')->nullable();
            $table->date('freeze_diaktifkan')->nullable();
            $table->integer('freeze')->nullable();
            $table->text('note_freeze')->nullable();
            $table->text('note')->nullable();
            $table->enum('approval',['prosess','approve','reject'])->nullable()->default('prosess');
            $table->integer('workbook')->nullable()->default('0');
            $table->enum('pengajuan_sample',['proses','sent','approve','reject'])->nullable()->default('proses');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('ms_pdf_project');
    }
}
