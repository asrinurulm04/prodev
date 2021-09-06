<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrForecashNotulen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_forecash_notulen', function (Blueprint $table) {
            $table->increments('id_fn');
            $table->integer('id_pkp');
            $table->integer('forecast');
            $table->string('satuan');
            $table->string('Bulan');
            $table->integer('tahun');
            $table->string('date');
            $table->integer('info')->nullable();
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
        Schema::dropIfExists('tr_forecash_notulen');
    }
}
