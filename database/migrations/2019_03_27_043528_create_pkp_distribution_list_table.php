<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpDistributionListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_distribution_list', function (Blueprint $table) {
            $table->increments('id_distribution');
            $table->enum('modul',['request pkp','approve pkp'])->nullable();
            $table->enum('group',['RD kemas','RD produk','pv','marketing','admin'])->nullable();
            $table->string('email')->nullable();
            $table->enum('mail_type',['to','cc','bcc'])->nullable();
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
        Schema::dropIfExists('pkp_distribution_list');
    }
}
