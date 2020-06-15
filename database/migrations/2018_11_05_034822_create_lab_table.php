<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fs_lab', function (Blueprint $table) {
            $table->increments('id_lab');
            $table->integer('id_feasibility')->unsigned();
            $table->string('jenis_mikroba', 225);
            $table->string('kode_analisa',25)->nullable();
            $table->enum('tahunan',['ya','tidak']);
            $table->integer('jlh_analisatahunan')->nullable();
            $table->enum('harian',['ya','tidak']);
            $table->integer('jlh_analisaharian')->nullable();
            $table->integer('rate')->nullable();
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
        Schema::dropIfExists('fs_biaya_lab');
    }
}
