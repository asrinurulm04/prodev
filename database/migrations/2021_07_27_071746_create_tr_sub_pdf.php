<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrSubPdf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_sub_pdf', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pdf_id')->nullable();
            $table->string('primer',11)->nullable();
            $table->string('primery')->nullable();
            $table->string('secondery')->nullable();
            $table->string('Tertiary')->nullable();
            $table->integer('kemas_eksis')->nullable();
            $table->integer('dariusia')->nullable();
            $table->string('sampaiusia',11)->nullable();
            $table->string('gender')->nullable();
            $table->string('other')->nullable();
            $table->double('wight')->nullable();
            $table->enum('serving',['gram','ml'])->nullable();
            $table->string('target_price',11)->nullable();
            $table->string('claim',110)->nullable();
            $table->string('ingredient')->nullable();
            $table->string('background')->nullable();
            $table->string('attractiveness')->nullable();
            $table->string('rto')->nullable();
            $table->string('name')->nullable();
            $table->string('retailer_price')->nullable();
            $table->integer('special')->nullable();
            $table->text('remarks_ses')->nullable();
            $table->text('remarks_forecash')->nullable();
            $table->integer('revisi')->nullable()->default('0');
            $table->integer('turunan')->nullable()->default('0');
            $table->enum('status_data',['draf','sent','revisi','close','proses'])->default('draf');
            $table->enum('status_pdf',['active','inactive'])->default('active');
            $table->integer('perevisi')->nullable();
            $table->string('last_update');
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
        Schema::dropIfExists('tr_sub_pdf');
    }
}
