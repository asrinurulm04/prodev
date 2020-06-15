<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePretails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pretails', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('premix_id')->index();
          $table->string('premix_ke');
          $table->integer('awalan')->nullable;
          $table->integer('turunan')->nullable;
          $table->double('jumlah');
          $table->string('kode_kantong');
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
        Schema::dropIfExists('pretails');
    }
}
