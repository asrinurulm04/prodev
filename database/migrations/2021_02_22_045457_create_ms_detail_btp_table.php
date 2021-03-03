<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsDetailBtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_detail_btp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_subkategori');
            $table->integer('id_bahan');
            $table->string('nama_bahan');
            $table->string('nama_sederhana');
            $table->string('nama_form_b');
            $table->string('btp_carryover');
            $table->text('inggredient_list')->nullable();
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
        Schema::dropIfExists('ms_detail_btp');
    }
}
