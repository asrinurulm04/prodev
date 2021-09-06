<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPromo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_promo', function (Blueprint $table) {
            $table->increments('id_promo');
            $table->integer('id_pkp_promoo');
            $table->string('application')->nullable();
            $table->string('promo_readiness')->nullable();
            $table->string('promo_readiness2')->nullable();
            $table->string('rto')->nullable();
            $table->string('gambaran_proses')->nullable();
            $table->integer('revisi')->default('0');
            $table->integer('turunan')->nullable()->default('0');
            $table->enum('status_data',['active','inactive']);
            $table->integer('perevisi')->nullable();
            $table->string('last_update')->nullable();
            $table->enum('status_promo',['draf','sent','revisi','close','proses']);
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
        Schema::dropIfExists('tr_promo');
    }
}
