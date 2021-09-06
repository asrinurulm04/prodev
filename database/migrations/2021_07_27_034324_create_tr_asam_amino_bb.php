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
        Schema::create('tr_asam_amino_bb', function (Blueprint $table) {
            $table->increments('id_asam_amino');
            $table->integer('id_bahan');
            $table->string('id');
            $table->double('l_glutamin',8,2)->nullable()->default('0');
            $table->double('Threonin',8,2)->nullable()->default('0');
            $table->double('Methionin',8,2)->nullable()->default('0');
            $table->double('Phenilalanin',8,2)->nullable()->default('0');
            $table->double('Histidin',8,2)->nullable()->default('0');
            $table->double('lisin',8,2)->nullable()->default('0');
            $table->double('BCAA',8,2)->nullable()->default('0');
            $table->double('Valin',8,2)->nullable()->default('0');
            $table->double('Leusin',8,2)->nullable()->default('0');
            $table->double('Aspartat',8,2)->nullable()->default('0');
            $table->double('Alanin',8,2)->nullable()->default('0');
            $table->double('Sistein',8,2)->nullable()->default('0');
            $table->double('Serin',8,2)->nullable()->default('0');
            $table->double('Glisin',8,2)->nullable()->default('0');
            $table->double('Glutamat',8,2)->nullable()->default('0');
            $table->double('Tyrosin',8,2)->nullable()->default('0');
            $table->double('Proline',8,2)->nullable()->default('0');
            $table->double('Arginine',8,2)->nullable()->default('0');
            $table->double('Isoleusin',8,2)->nullable()->default('0');
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
