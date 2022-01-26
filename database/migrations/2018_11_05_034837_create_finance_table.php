<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_feasibility', function (Blueprint $table) {
            $table->increments('id_feasibility');
            $table->integer('id_formula')->unsigned();
            $table->integer('kemungkinan')->default('1');
            $table->enum('status_mesin',['selesai','belum selesai','sending'])->default('belum selesai');
            $table->enum('status_sdm',['selesai','belum selesai','sending'])->default('belum selesai');
            $table->enum('status_kemas',['selesai','belum selesai','sending'])->default('belum selesai');
            $table->enum('status_lab',['selesai','belum selesai'])->default('belum selesai');
            $table->enum('status_finance',['selesai','belum selesai'])->default('belum selesai');
            $table->enum('status_feasibility',['selesai','belum selesai'])->default('belum selesai');
            $table->text('message')->nullable();
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
        Schema::dropIfExists('tr_feasibility');
    }
}
