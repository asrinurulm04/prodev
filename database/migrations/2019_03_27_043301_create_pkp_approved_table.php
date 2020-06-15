<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpApprovedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_approved', function (Blueprint $table) {
            $table->increments('id_approve');
            $table->date('date')->nullable();
            $table->integer('project_id')->nullable();
            $table->string('jenis_formula')->nullable();
            $table->string('kode_formula')->nullable();
            $table->string('file')->nullable();
            $table->enum('status',['done','on progress','revisi'])->nullable();
            $table->date('last_update')->nullable();
            $table->string('approved_by')->nullable();
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
        Schema::dropIfExists('pkp_approved');
    }
}
