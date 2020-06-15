<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAktifitasOHTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fs_aktifitas_OH', function (Blueprint $table) {
            $table->increments('id_aktifitasOH');
            $table->enum('workcenter', ['maklon', 'gabungan', 'ciawi', 'sentul', 'cibitung']);
            $table->string('gedung', 50);
            $table->string('direct_activity', 225);
            $table->string('kategori', 65);
            $table->string('driver', 150);
            $table->double('harga_OH')->nullable();
            $table->integer('defaultSDM')->nullable();
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
        Schema::dropIfExists('fs_aktifitas_OH');
    }
}
