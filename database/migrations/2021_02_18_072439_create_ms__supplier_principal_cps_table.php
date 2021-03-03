<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsSupplierPrincipalCpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_supplier_principal_cps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ms_supplier_principal_id');
            $table->string('nama_cp');
            $table->string('email_cp');
            $table->string('telepon_cp');
            $table->string('jabatan_cp');
            $table->enum('is_active',['actve','inactive']);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('ms_supplier_principal_cps');
    }
}
