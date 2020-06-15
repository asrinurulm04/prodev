<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbParameterCemaranWbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_parameter_cemaran_wbs', function (Blueprint $table) {
            $table->increments('id_pcwb');
            $table->integer('id_workbook')->index();
            $table->integer('id_transaksi_cemaran')->index();
            $table->string('input_user');
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
        Schema::dropIfExists('tb_parameter_cemaran_wbs');
    }
}
