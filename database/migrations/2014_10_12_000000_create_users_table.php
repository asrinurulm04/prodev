<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('username')->unique();
          $table->string('email')->unique();
          $table->string('password');
          $table->integer('departement_id')->index();
          $table->integer('role_id')->index();
          $table->enum('status',['sending','active','nonactive'])->default('sending');
          $table->rememberToken();
          $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('namaRule',['marketing','user_produk','user_rd_proses','admin','pv_global','pv_lokal','development','produksi','kemas','evaluator','finance','superadmin','lab','manager','CS','maklon']);
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
}
