<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatamesinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_mesin', function (Blueprint $table) {
            $table->increments('id_data_mesin');
            $table->enum('workcenter', ['ciawi', 'sentul', 'cibitung','maklon']);
            $table->enum('gedung', ['CIAWI_GD H','CIAWI_GD A','CIAWI_GD D','CIBITUNG_PROD NS','CIBITUNG_PROD DAIRY','SENTUL_PROD SENTUL']);
            $table->enum('kategori',['mixing', 'filling', 'packing','granulasi']);
            $table->enum('IO',['PRA', 'PRB', 'GRA','GRB']);
            $table->string('nama_mesin', 225);
            $table->string('nama_kategori', 225);
            $table->integer('jlh_line');
            $table->double('rate_mesin')->nullable();
            $table->integer('standar_sdm')->nullable();
            $table->double('harga_SDM')->nullable();
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
        Schema::dropIfExists('ms_mesin');
    }
}
