<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpGanttChartDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_gantt_chart_data', function (Blueprint $table) {
            $table->increments('id_chart_data');
            $table->integer('id_project')->nullable();
            $table->string('data')->nullable();
            $table->string('parent')->nullable();
            $table->string('text')->nullable();
            $table->float('progres',5,2)->nullable();
            $table->string('duration')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status',['old','new'])->nullable();
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
        Schema::dropIfExists('pkp_gantt_chart_data');
    }
}
