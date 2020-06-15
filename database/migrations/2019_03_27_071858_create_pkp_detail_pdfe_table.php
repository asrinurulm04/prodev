<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePkpDetailPdfeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pkp_detail_pdfe', function (Blueprint $table) {
            $table->increments('id_detail_pdfe');
            $table->integer('id_project')->nullable();
            $table->date('modify_date')->nullable();
            $table->string('idea')->nullable();
            $table->string('target_mareket')->nullable();
            $table->string('uniqueness_of_idea')->nullable();
            $table->string('estimated_potential_market')->nullable();
            $table->string('reason')->nullable();
            $table->date('launch_deadline')->nullable();
            $table->string('aisle_placement')->nullable();
            $table->string('sales_forecast')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('main_competitor')->nullable();
            $table->string('analysis_competitive')->nullable();
            $table->string('product_form')->nullable();
            $table->string('product_packaging')->nullable();
            $table->integer('revision')->nullable();
            $table->enum('project_status',['ON PROGRESS', 'PENDING', 'REJECT', 'DONE'])->nullable();
            $table->enum('project_type',['DRAFT', 'NEW', 'REVISI'])->nullable();
            $table->enum('status',['active','nonactive'])->nullable();
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
        Schema::dropIfExists('pkp_detail_pdfe');
    }
}
