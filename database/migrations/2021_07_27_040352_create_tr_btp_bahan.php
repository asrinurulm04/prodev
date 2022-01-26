<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrBtpBahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_btp_bahan', function (Blueprint $table) {
            $table->increments('id_btp');
            $table->integer('id_bahan');
            $table->text('btp')->nullable();
            $table->double('nominal')->nullable();
            $table->integer('id_satuan')->nullable();
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
        Schema::dropIfExists('tr_btp_bahan');
    }
}
