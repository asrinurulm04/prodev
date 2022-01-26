<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDepartement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_departements', function (Blueprint $table) {
          $table->increments('id');
          $table->string('dept');
          $table->string('nama_dept');
          $table->string('Divisi')->nullable();
          $table->integer('manager_id')->index()->nullable();
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
        Schema::dropIfExists('ms_departements');
    }
}
