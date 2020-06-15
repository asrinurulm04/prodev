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
        Schema::create('pkp_database_sku', function (Blueprint $table) {
            $table->increments('id_sku');
            $table->string('item_code')->nullable();
            $table->string('item_name')->nullable();
            $table->string('description')->nullable();
            $table->enum('status',['active','nonactive'])->nullable();
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
        Schema::dropIfExists('pkp_database_sku');
    }
}
