<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrMikroBiologiBb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_mikro_biologi_bb', function (Blueprint $table) {
            $table->increments('id_mikro_bilogi');
            $table->integer('id')->nullable();
            $table->integer('id_bahan');
            $table->integer('id_bpom');
            $table->integer('id_jenis_mikro');
            $table->decimal('n',10,0)->nullable();
            $table->decimal('c',10,0)->nullable();
            $table->string('m',11)->nullable();
            $table->string('M2',11)->nullable();
            $table->string('satuan',11)->nullable();
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
        Schema::dropIfExists('tr_mikro_biologi_bb');
    }
}
