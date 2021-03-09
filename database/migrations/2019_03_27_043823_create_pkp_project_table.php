<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_project_pkp', function (Blueprint $table) {
            $table->increments('id_project');
            $table->string('pkp_number')->nullable();
            $table->string('ket_no')->nullable();
            $table->string('project_name');
            $table->string('id_brand')->nullable();
            $table->string('type')->nullable();
            $table->string('jenis')->nullable();
            $table->string('created_date')->nullable();
            $table->string('author')->nullable();
            $table->string('tujuankirim')->nullable();
            $table->enum('status_terima',['terima','proses','tolak'])->nullable()->default('proses');
            $table->enum('status_terima2',['terima','proses','tolak'])->nullable()->default('proses');
            $table->string('tujuankirim2')->nullable()->default('0');
            $table->string('tgl_kirim')->nullable();
            $table->integer('userpenerima')->nullable();
            $table->integer('userpenerima2')->nullable();
            $table->integer('prioritas')->nullable();
            $table->enum('status',['active','nonactive']);
            $table->enum('status_freeze',['active','inactive'])->nullable()->default('inactive');
            $table->enum('status_project',['sent','draf','revisi','close','proses'])->nullable()->default('draf');
            $table->date('jangka')->nullable();
            $table->date('waktu')->nullable();
            $table->string('catatan')->nullable();
            $table->date('waktu_freeze')->nullable();
            $table->date('freeze_diaktifkan')->nullable();
            $table->integer('freeze')->nullable();
            $table->text('note')->nullable();
            $table->text('note_freeze')->nullable();
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
        Schema::dropIfExists('tr_project_pkp');
    }
}
