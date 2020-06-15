<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpPromoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_promo', function (Blueprint $table) {
            $table->increments('id_pkp_promo');
            $table->string('project_name');
            $table->integer('brand');
            $table->string('Author');
            $table->date('last_update');
            $table->string('country');
            $table->string('promo_type');
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
        Schema::dropIfExists('pkp_promo');
    }
}
