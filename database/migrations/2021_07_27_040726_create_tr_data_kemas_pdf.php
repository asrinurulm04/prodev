<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrDataKemasPdf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_data_kemas_pdf', function (Blueprint $table) {
            $table->increments('id_data');
            $table->integer('id_pdf');
            $table->string('oracle')->nullable();
            $table->string('kk')->nullable();
            $table->text('information')->nullable();
            $table->integer('revisi')->nullable();
            $table->integer('turunan')->nullable();
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
        Schema::dropIfExists('tr_data_kemas_pdf');
    }
}
