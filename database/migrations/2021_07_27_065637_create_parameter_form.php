<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParameterForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_parameter_form', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pkp')->nullable();
            $table->integer('id_pdf')->nullable();
            $table->integer('id_promo')->nullable();
            $table->integer('user')->nullable();
            $table->enum('form1',['ya','tidak'])->nullable();
            $table->enum('form2',['ya','tidak'])->nullable();
            $table->enum('form3',['ya','tidak'])->nullable();
            $table->enum('form4',['ya','tidak'])->nullable();
            $table->enum('form5',['ya','tidak'])->nullable();
            $table->enum('form6',['ya','tidak'])->nullable();
            $table->enum('form7',['ya','tidak'])->nullable();
            $table->enum('form8',['ya','tidak'])->nullable();
            $table->enum('form9',['ya','tidak'])->nullable();
            $table->enum('form10',['ya','tidak'])->nullable();
            $table->enum('form11',['ya','tidak'])->nullable();
            $table->enum('form12',['ya','tidak'])->nullable();
            $table->enum('form13',['ya','tidak'])->nullable();
            $table->enum('form14',['ya','tidak'])->nullable();
            $table->enum('form15',['ya','tidak'])->nullable();
            $table->enum('form16',['ya','tidak'])->nullable();
            $table->enum('form17',['ya','tidak'])->nullable();
            $table->enum('form18',['ya','tidak'])->nullable();
            $table->enum('form19',['ya','tidak'])->nullable();
            $table->enum('form20',['ya','tidak'])->nullable();
            $table->enum('form21',['ya','tidak'])->nullable();
            $table->enum('form22',['ya','tidak'])->nullable();
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
        Schema::dropIfExists('tr_parameter_form');
    }
}
