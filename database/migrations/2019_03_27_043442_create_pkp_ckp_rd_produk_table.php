<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpCkpRdProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_ckp_rd_produk', function (Blueprint $table) {
            $table->increments('id_ckp_produk');
            $table->integer('project_id')->nullable();
            $table->string('evaluasi_sampel_bb_check')->nullable();
            $table->string('abb_bb_name')->nullable();
            $table->string('abb_bb_check')->nullable();
            $table->string('trial_num')->nullable();
            $table->string('trial_check')->nullable();
            $table->string('pft_num')->nullable();
            $table->string('pft_conclusion')->nullable();
            $table->text('pft_check')->nullable();
            $table->string('huk_num')->nullable();
            $table->string('huk_check')->nullable();
            $table->string('storage_test_num')->nullable();
            $table->string('storage_test_check')->nullable();
            $table->string('uji_sensori_num')->nullable();
            $table->string('uji_sensori_check')->nullable();
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
        Schema::dropIfExists('pkp_ckp_rd_produk');
    }
}
