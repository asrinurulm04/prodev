<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrSes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_ses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_project')->nullable();
            $table->integer('id_pkp')->nullable();
            $table->integer('id_pdf')->nullable();
            $table->string('ses')->nullable();
            $table->integer('revisi_kemas');
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
        Schema::dropIfExists('tr_ses');
    }
}
