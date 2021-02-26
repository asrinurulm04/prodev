<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsSupplierPrincipalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_supplier_principal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_supplier_principal');
            $table->string('kode_oracle_supplier_principal');
            $table->string('alamat_supplier_principal');
            $table->string('telepon_supplier_principal');
            $table->string('no_fax_supplier_principal');
            $table->string('website_supplier_principal');
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
        Schema::dropIfExists('ms_supplier_principal');
    }
}
