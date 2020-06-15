<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_parameters', function (Blueprint $table) {
            $table->increments('id_p');
            $table->integer('akg')->index();
            $table->integer('kategori')->index();
            $table->string('parameter');    
            $table->string('satuan');
            $table->string('wajib');
            $table->string('keterangan');
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
        Schema::dropIfExists('tb_parameters');
    }
}