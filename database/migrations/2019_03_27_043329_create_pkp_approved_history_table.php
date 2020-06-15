<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpApprovedHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_approved_history', function (Blueprint $table) {
            $table->increments('id_history_approve');
            $table->date('date')->nullable();
            $table->integer('data_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->string('jenis_formula')->nullable();
            $table->string('file')->nullable();
            $table->char('revisi')->nullable();
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
        Schema::dropIfExists('pkp_approved_history');
    }
}
