<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrEdit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_edit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pkp')->nullable();
            $table->integer('id_pdf')->nullable();
            $table->integer('id_promo')->nullable();
            $table->integer('id_bahan')->nullable();
            $table->integer('id_user');
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
        Schema::dropIfExists('tr_edit');
    }
}
