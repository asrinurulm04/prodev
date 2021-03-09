<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsBpomMikrobiologiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_bpom_mikrobiologi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kategori');
            $table->string('no_kategori');
            $table->text('kategori');
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
        Schema::dropIfExists('ms_bpom_mikrobiologi');
    }
}
