<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpGanttChartLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_gantt_chart_link', function (Blueprint $table) {
            $table->increments('id_chart_link');
            $table->integer('id_project')->nullable();
            $table->string('link')->nullable();
            $table->string('source')->nullable();
            $table->string('target')->nullable();
            $table->char('type')->nullable();
            $table->enum('status',['new','old'])->nullable();
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
        Schema::dropIfExists('pkp_gantt_chart_link');
    }
}
