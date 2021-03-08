<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrAsamAminoBb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_allergen_formula', function (Blueprint $table) {
            $table->increments('id_asam_amino');
            $table->integer('id_bahan');
            $table->integer('id');
            $table->integer('l_glutamin');
            $table->integer('Threonin');
            $table->integer('Methionin');
            $table->integer('Phenilalanin');
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
        Schema::dropIfExists('tr_asam_amino_bb');
    }
}
