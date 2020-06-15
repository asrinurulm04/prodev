<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWorkbook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workbooks', function (Blueprint $table) {
          $table->increments('id');
          $table->string('id_projectpkp');
          $table->string('id_tablepdfe');
          $table->string('mnrq');
          $table->integer('user_id')->index();
          $table->enum('jenis',['baru','revisi'])->nullable();
          $table->string('revisi')->nullable()->default('-');
          $table->enum('status',['proses','selesai','batal'])->nullable();
          $table->text('keterangan')->nullable();
          $table->string('deskripsi')->nullablle();
          $table->integer('jenismakanan_id');
          $table->double('target_serving')->nullable();
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
        Schema::dropIfExists('workbooks');
    }
}
