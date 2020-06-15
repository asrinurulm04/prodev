<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpChecklistKelengkapanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_checklist_kelengkapan', function (Blueprint $table) {
            $table->increments('id_kelengkapan');
            $table->integer('project_id')->nullable();
            $table->integer('step_id')->nullable();
            $table->string('jenis_kemasan')->nullable();
            $table->string('kelengkapan')->nullable();
            $table->string('progress')->nullable();
            $table->string('referensi')->nullable();
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
        Schema::dropIfExists('pkp_checklist_kelengkapan');
    }
}
