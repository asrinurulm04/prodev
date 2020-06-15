<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJenisMakanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenismakanans', function (Blueprint $table){
            $table->increments('id');
            $table->string('no');
            $table->string('kategori_pangan');
            $table->string('jenis_makanan')->nullable();
            $table->string('jenismikroba_id')->index();
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
        Schema::dropIfExists('jenismakanans');
    }
}
