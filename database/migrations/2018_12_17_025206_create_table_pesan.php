<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePesan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesans' ,function(Blueprint $table){
            $table->increments('id');
            $table->integer('workbook_id');
            $table->integer('formula_id')->index()->nullable();
            $table->string('pengirim')->nullable();
            $table->string('penerima')->nullable();
            $table->enum('jenis',['admin','dev','pv','finance']);
            $table->enum('jenis2',['admin','dev','pv','finance']);
            $table->text('pesan');
            $table->string('untuk')->nullable();                                  
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
        Schema::dropIfExists('pesans');
    }
}
