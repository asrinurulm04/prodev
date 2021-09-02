<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpPromoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_project_promo', function (Blueprint $table) {
            $table->increments('id_pkp_promo');
            $table->string('promo_number')->nullable();
            $table->string('ket_no')->nullable();
            $table->string('project_name');
            $table->enum('status_project',['sent','draf','revisi','close','proses'])->nullable()->default('draf');
            $table->integer('brand');
            $table->string('Author');
            $table->string('created_date');
            $table->string('country');
            $table->string('promo_type');
            $table->string('type');
            $table->string('tujuankirim')->nullable();
            $table->string('tujuankirim2')->nullable()->default('0');
            $table->string('tgl_kirim')->nullable();
            $table->enum('status_terima',['terima','proses','tolak'])->nullable()->default('proses');
            $table->enum('status_terima2',['terima','proses','tolak'])->nullable()->default('proses');
            $table->integer('userpenerima')->nullable();
            $table->integer('userpenerima2')->nullable();
            $table->integer('prioritas')->nullable();
            $table->enum('status',['active','nonactive']);
            $table->enum('status_freeze',['active','inactive'])->nullable()->default('inactive');
            $table->date('jangka')->nullable();
            $table->date('waktu')->nullable();
            $table->date('waktu_freeze')->nullable();
            $table->date('freeze_diaktifkan')->nullable();
            $table->integer('freeze')->nullable();
            $table->text('note')->nullable();
            $table->enum('approval',['prosess','approve','reject'])->nullable()->default('prosess');
            $table->enum('pengajuan_sample',['proses','sent','approve','reject'])->nullable()->default('proses');
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
        Schema::dropIfExists('tr_project_promo');
    }
}
