<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrKlaim extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_klaim', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_project')->nullable();
            $table->integer('id_pkp')->nullable();
            $table->integer('id_pdf')->nullable();
            $table->integer('revisi');
            $table->integer('revisi_kemas')->nullable();
            $table->integer('turunan');
            $table->integer('id_komponen');
            $table->string('komponen')->nullable();
            $table->integer('id_klaim');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('tr_klaim');
    }
}
