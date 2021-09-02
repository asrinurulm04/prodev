<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpDatabaseSkuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_sku', function (Blueprint $table) {
            $table->increments('id_sku');
            $table->string('no_formula')->nullable();
            $table->string('nama_produk')->nullable();
            $table->integer('no')->nullable();
            $table->string('nama_sku')->nullable();
            $table->string('kode_items')->nullable();
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
        Schema::dropIfExists('ms_sku');
    }
}
