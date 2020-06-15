<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMikrobaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fs_jenismikroba', function (Blueprint $table) {
            $table->increments('id_mikroba');
            $table->string('no_kategori',11);
            $table->string('jenis_mikroba',225);
            $table->string('n',150);
            $table->string('c',150);
            $table->text('mk');
            $table->text('Mb');
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
        Schema::dropIfExists('fs_jenismikroba');
    }
}
