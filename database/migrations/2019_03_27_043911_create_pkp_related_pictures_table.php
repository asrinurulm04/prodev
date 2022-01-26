<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpRelatedPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_file_project', function (Blueprint $table) {
            $table->increments('id_pictures');
            $table->text('filename');
            $table->integer('pkp_id')->nullable();
            $table->integer('pdf_id')->nullable();
            $table->integer('promo')->nullable();
            $table->string('lokasi');
            $table->integer('revisi')->default('0');
            $table->integer('turunan')->default('0');
            $table->text('informasi')->nullable();
            $table->string('status_picture')->default('active');
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
        Schema::dropIfExists('tr_file_project');
    }
}
