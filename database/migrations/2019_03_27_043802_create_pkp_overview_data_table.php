<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpOverviewDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_overview_data', function (Blueprint $table) {
            $table->increments('id_overview_data');
            $table->integer('id_project')->nullable();
            $table->string('production_location_1')->nullable();
            $table->string('production_location_2')->nullable();
            $table->string('production_location_3')->nullable();
            $table->string('production_location_4')->nullable();
            $table->string('production_location_5')->nullable();
            $table->double('batch_size_1',10,4)->nullable();
            $table->double('batch_size_2',10,4)->nullable();
            $table->double('batch_size_3',10,4)->nullable();
            $table->double('batch_size_4',10,4)->nullable();
            $table->double('batch_size_5',10,4)->nullable();
            $table->double('atch_size_granulation_1',10,4)->nullable();
            $table->double('atch_size_granulation_2',10,4)->nullable();
            $table->double('atch_size_granulation_3',10,4)->nullable();
            $table->double('atch_size_granulation_4',10,4)->nullable();
            $table->double('atch_size_granulation_5',10,4)->nullable();
            $table->double('gramasi_peruom_1',10,4)->nullable();
            $table->double('gramasi_peruom_2',10,4)->nullable();
            $table->double('gramasi_peruom_3',10,4)->nullable();
            $table->double('gramasi_peruom_4',10,4)->nullable();
            $table->double('gramasi_peruom_5',10,4)->nullable();
            $table->double('serving_size_1',10,4)->nullable();
            $table->double('serving_size_2',10,4)->nullable();
            $table->double('serving_size_3',10,4)->nullable();
            $table->double('serving_size_4',10,4)->nullable();
            $table->double('serving_size_5',10,4)->nullable();
            $table->double('batch_permonth_1',10,4)->nullable();
            $table->double('batch_permonth_2',10,4)->nullable();
            $table->double('batch_permonth_3',10,4)->nullable();
            $table->double('batch_permonth_4',10,4)->nullable();
            $table->double('batch_permonth_5',10,4)->nullable();
            $table->string('packaging_configuration_1')->nullable();
            $table->string('packaging_configuration_2')->nullable();
            $table->string('packaging_configuration_3')->nullable();
            $table->string('packaging_configuration_4')->nullable();
            $table->string('packaging_configuration_5')->nullable();
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
        Schema::dropIfExists('pkp_overview_data');
    }
}
