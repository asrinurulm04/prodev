<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrProductAllocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_product_allocation', function (Blueprint $table) {
            $table->increments('id_product_allocation');
            $table->integer('id_pkp_promo');
            $table->string('product_sku');
            $table->string('allocation');
            $table->text('remarks')->nullable();
            $table->date('start');
            $table->date('rto');
            $table->date('end')->nullable();
            $table->integer('revisi')->default('0');
            $table->integer('turunan')->nullable()->default('0');
            $table->string('opsi',11)->nullable();
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
        Schema::dropIfExists('tr_product_allocation');
    }
}
