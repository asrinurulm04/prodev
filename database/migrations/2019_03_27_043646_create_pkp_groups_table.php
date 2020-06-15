<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_groups', function (Blueprint $table) {
            $table->increments('id_group');
            $table->string('name');
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->string('description');
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
        Schema::dropIfExists('pkp_groups');
    }
}
