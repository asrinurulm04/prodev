<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_storage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_wb')->nullable();
            $table->integer('id_wb_pdf')->nullable();
            $table->string('no_PST');
            $table->integer('id_formula');
            $table->string('suhu');
            $table->date('estimasi_selesai');
            $table->string('selesai')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('no_HSA')->nullable();
            $table->string('kesimpulan')->nullable();
            $table->string('data_file')->nullable();
            $table->enum('status',['proses','done'])->nullable();
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
        Schema::dropIfExists('tr_storage');
    }
}
