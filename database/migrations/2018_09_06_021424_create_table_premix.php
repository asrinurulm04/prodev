<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePremix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premixs', function (Blueprint $table) {
          $table->integer('fortail_id')->index();
          $table->integer('utuh');
          $table->double('koma');
          $table->integer('utuh_cpb')->nullable();
          $table->double('koma_cpb')->nullable();
          $table->string('satuan');
          $table->double('berat');
          $table->increments('id');
          $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('premixs');
    }
}
