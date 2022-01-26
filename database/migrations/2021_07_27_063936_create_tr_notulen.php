<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrNotulen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_notulen', function (Blueprint $table) {
            $table->increments('id_notulen');
            $table->integer('id')->nullable();
            $table->integer('id_pkp')->nullable();
            $table->integer('id_pdf')->nullable();
            $table->integer('id_promo')->nullable();
            $table->string('launch')->nullable();
            $table->integer('launch_years')->nullable();
            $table->integer('prioritas')->nullable();
            $table->string('Bulan')->nullable();
            $table->integer('tahun')->nullable();
            $table->text('note_rd_pv')->nullable();
            $table->text('note_pv_marketing')->nullable();
            $table->string('created')->nullable();
            $table->string('user')->nullable();
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
        Schema::dropIfExists('tr_notulen');
    }
}
