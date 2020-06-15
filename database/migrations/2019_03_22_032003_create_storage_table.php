<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_PST',50);
            $table->string('suhu',100);
            $table->date('estimasi_selesai');
            $table->string('keterangang',225);
            $table->string('no_HSA',50);
            $table->string('kesimpulan',225);
            $table->date('tgl_input');
            $table->text('progres1');
            $table->text('progres2');
            $table->text('progres3');
            $table->text('progres4');
            $table->text('progres5');
            $table->text('progres6');
            $table->text('progres7');
            $table->text('progres8');
            $table->text('progres9');
            $table->text('progres10');
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
        Schema::dropIfExists('storage');
    }
}
