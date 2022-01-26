<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsAkgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_akg', function (Blueprint $table) {
            $table->increments('id');
            $table->string('satuan',11);
            $table->integer('id_tarkon');
            $table->decimal('energi', 10, 2);
            $table->decimal('protein', 10, 2);
            $table->decimal('lemak_total', 10, 2);
            $table->decimal('lemak_jenuh', 10, 2);
            $table->decimal('kolesterol', 10, 2);
            $table->decimal('asam_linoleat', 10, 2);
            $table->decimal('asam_a_linoleat', 10, 2);
            $table->decimal('karbohidrat_total', 10, 2);
            $table->decimal('serat_pangan', 10, 2);
            $table->decimal('vitamin_a', 10, 2);
            $table->decimal('vitamin_c', 10, 2);
            $table->decimal('vitamin_d', 10, 2);
            $table->decimal('vitamin_e', 10, 2);
            $table->decimal('vitamin_k', 10, 2);
            $table->decimal('vitamin_b1', 10, 2);
            $table->decimal('vitamin_b2', 10, 2);
            $table->decimal('vitamin_b3', 10, 2);
            $table->decimal('vitamin_b5', 10, 2);
            $table->decimal('vitamin_b6', 10, 2);
            $table->decimal('vitamin_b12', 10, 2);
            $table->decimal('folat', 10, 2);
            $table->decimal('biotin', 10, 2);
            $table->decimal('kolin', 10, 2);
            $table->decimal('kalium', 10, 2);
            $table->decimal('fosfor', 10, 2);
            $table->decimal('magnesium', 10, 2);
            $table->decimal('natrium', 10, 2);
            $table->decimal('mangan', 10, 2);
            $table->decimal('tembaga', 10, 2);
            $table->decimal('kromium', 10, 2);
            $table->decimal('besi', 10, 2);
            $table->decimal('lodium', 10, 2);
            $table->decimal('seng', 10, 2);
            $table->decimal('selenium', 10, 2);
            $table->decimal('fluor', 10, 2);
            $table->decimal('l_karnitin', 10, 2);
            $table->decimal('myo_inositol', 10, 2);
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
        Schema::dropIfExists('ms_akg');
    }
}
