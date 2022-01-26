<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrAllergenFormula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_allergen_formula', function (Blueprint $table) {
            $table->increments('id_allergen_formula');
            $table->integer('id_bahan');
            $table->integer('id_formula');
            $table->integer('id_fortails');
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
        Schema::dropIfExists('tr_allergen_formula');
    }
}
