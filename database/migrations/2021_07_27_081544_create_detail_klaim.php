<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailKlaim extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_detail_klaim', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_detail');
            $table->integer('id_pkp')->nullable();
            $table->integer('id_pdf')->nullable();
            $table->integer('id_klaim')->nullable();
            $table->integer('revisi')->default('0');
            $table->integer('turunan')->default('0');
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
        Schema::dropIfExists('tr_detail_klaim');
    }
}
