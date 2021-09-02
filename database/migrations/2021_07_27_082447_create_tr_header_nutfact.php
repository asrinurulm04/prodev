<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrHeaderNutfact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_header_nutfact', function (Blueprint $table) {
            $table->increments('id_header');
            $table->integer('id_formula');
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
            $table->enum('form23',['ya','tidak'])->nullable();
            $table->enum('form24',['ya','tidak'])->nullable();
            $table->enum('form25',['ya','tidak'])->nullable();
            $table->enum('form26',['ya','tidak'])->nullable();
            $table->enum('form27',['ya','tidak'])->nullable();
            $table->enum('form28',['ya','tidak'])->nullable();
            $table->enum('form29',['ya','tidak'])->nullable();
            $table->enum('form30',['ya','tidak'])->nullable();
            $table->enum('form31',['ya','tidak'])->nullable();
            $table->enum('form32',['ya','tidak'])->nullable();
            $table->enum('form33',['ya','tidak'])->nullable();
            $table->enum('form34',['ya','tidak'])->nullable();
            $table->enum('form35',['ya','tidak'])->nullable();
            $table->enum('form36',['ya','tidak'])->nullable();
            $table->enum('form37',['ya','tidak'])->nullable();
            $table->enum('form38',['ya','tidak'])->nullable();
            $table->enum('form39',['ya','tidak'])->nullable();
            $table->enum('form40',['ya','tidak'])->nullable();
            $table->enum('form41',['ya','tidak'])->nullable();
            $table->enum('form42',['ya','tidak'])->nullable();
            $table->enum('form43',['ya','tidak'])->nullable();
            $table->enum('form44',['ya','tidak'])->nullable();
            $table->enum('form45',['ya','tidak'])->nullable();
            $table->enum('form46',['ya','tidak'])->nullable();
            $table->enum('form47',['ya','tidak'])->nullable();
            $table->enum('form48',['ya','tidak'])->nullable();
            $table->enum('form49',['ya','tidak'])->nullable();
            $table->enum('form50',['ya','tidak'])->nullable();
            $table->enum('form51',['ya','tidak'])->nullable();
            $table->enum('form52',['ya','tidak'])->nullable();
            $table->enum('form53',['ya','tidak'])->nullable();
            $table->enum('form54',['ya','tidak'])->nullable();
            $table->enum('form55',['ya','tidak'])->nullable();
            $table->enum('form56',['ya','tidak'])->nullable();
            $table->enum('form57',['ya','tidak'])->nullable();
            $table->enum('form58',['ya','tidak'])->nullable();
            $table->enum('form59',['ya','tidak'])->nullable();
            $table->enum('form60',['ya','tidak'])->nullable();
            $table->enum('form61',['ya','tidak'])->nullable();
            $table->enum('form62',['ya','tidak'])->nullable();
            $table->enum('form63',['ya','tidak'])->nullable();
            $table->enum('form64',['ya','tidak'])->nullable();
            $table->enum('form65',['ya','tidak'])->nullable();
            $table->enum('form66',['ya','tidak'])->nullable();
            $table->enum('form67',['ya','tidak'])->nullable();
            $table->enum('form68',['ya','tidak'])->nullable();
            $table->enum('form69',['ya','tidak'])->nullable();
            $table->enum('form70',['ya','tidak'])->nullable();
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
        Schema::dropIfExists('tr_header_nutfact');
    }
}
