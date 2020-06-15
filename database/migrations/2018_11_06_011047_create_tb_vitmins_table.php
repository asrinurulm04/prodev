<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbVitminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_vitmins', function (Blueprint $table) {
            $table->increments('id_vitmin');
            $table->char('VP');
            $table->integer('parameter')->index();
            $table->double('target');
            $table->double('min');
            $table->double('max');
            $table->string('unit');
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
        Schema::dropIfExists('tb_vitmins');
    }
}
