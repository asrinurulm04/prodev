<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrPromoIdea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_promo_idea', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_promo');
            $table->text('promo_idea')->nullable();
            $table->text('dimension')->nullable();
            $table->integer('revisi')->default('0');
            $table->integer('turunan')->nullable()->default('0');
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
        Schema::dropIfExists('tr_promo_idea');
    }
}
