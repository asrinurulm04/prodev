<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrProjectLaunching extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_project_launching', function (Blueprint $table) {
            $table->increments('id_launching');
            $table->integer('id_pkp')->nullable();
            $table->integer('id_pdf')->nullable();
            $table->integer('id_promo')->nullable();
            $table->string('tanggal');
            $table->text('nama_produk');
            $table->text('formula_baku');
            $table->text('formula_kemas');
            $table->string('price_list');
            $table->string('forecast');
            $table->string('rto');
            $table->text('note');
            $table->string('barcode');
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
        Schema::dropIfExists('tr_project_launching');
    }
}
