<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrBbAllergen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_bb_allergen', function (Blueprint $table) {
            $table->increments('id_bb_allergen');
            $table->integer('id_bb');
            $table->string('allergen_contain');
            $table->string('allertgen_maycontain');
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
        Schema::dropIfExists('tr_bb_allergen');
    }
}
