<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrForecash extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_forecash', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_project')->nullable();
            $table->integer('id_pkp')->nullable();
            $table->integer('id_pdf')->nullable();
            $table->integer('revisi')->default('0');
            $table->integer('revisi_kemas')->nullable();
            $table->integer('turunan')->default('0');
            $table->string('forecast')->nullable();
            $table->string('satuan');
            $table->text('keterangan');
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
        Schema::dropIfExists('tr_forecash');
    }
}
