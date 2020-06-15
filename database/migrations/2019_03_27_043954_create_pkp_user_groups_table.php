<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_user_groups', function (Blueprint $table) {
            $table->increments('id_user_group');
            $table->integer('id_user');
            $table->integer('id_group');
            $table->enum('created',['true','false'])->nullable();
            $table->enum('read',['true','false'])->nullable();
            $table->enum('updated',['true','false'])->nullable();
            $table->enum('delete',['true','false'])->nullable();
            $table->enum('is_active',['active','nonactive'])->nullable();
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
        Schema::dropIfExists('pkp_user_groups');
    }
}
