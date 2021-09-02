<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPengajuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_pengajuan', function (Blueprint $table) {
            $table->increments('id_pengajuan');
            $table->integer('prioritas_pengajuan');
            $table->integer('penerima');
            $table->integer('pkp_id')->nullable();
            $table->integer('id_pdf')->nullable();
            $table->integer('id_promo')->nullable();
            $table->text('alasan_pengajuan')->nullable();
            $table->integer('jangka')->nullable();
            $table->string('waktu',11)->nullable();
            $table->integer('revisi')->default('0');
            $table->integer('turunan')->default('0');
            $table->integer('revisi_kemas')->nullabele();
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
        Schema::dropIfExists('tr_pengajuan');
    }
}
