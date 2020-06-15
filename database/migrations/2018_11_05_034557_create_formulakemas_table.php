<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormulakemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fs_formula_kemas', function (Blueprint $table) {
            $table->increments('id_fk');
            $table->integer('id_feasibility')->default('0');
            $table->text('nama_sku')->nullable();
            $table->text('formula_item')->nullable();
            $table->string('kode_sku',25)->nullable();
            $table->double('jumlah_primer')->nullable();
            $table->double('jumlah_kemasan')->nullable();
            $table->double('gramasi')->nullable();
            $table->string('no_formula',12)->nullable();
            $table->enum('jenis',['Baru','Revisi'])->nullable();
            $table->enum('alokasi', ['Local', 'export'])->nullable();
            $table->double('kode')->nullable();
            $table->string('tgl_berlaku',13)->nullable();
            $table->double('jumlah_batch')->nullable();
            $table->double('jumlah_box_batch')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('user',255)->nullable();
            $table->string('item_code',25)->nullable();
            $table->string('kode_komputer',125)->nullable();
            $table->text('supplier')->nullable();
            $table->string('dimensi', 125)->nullable(); 
            $table->enum('unit_dimensi', ['MM', 'PCS', 'GR', 'KG', 'M'])->nullable();
            $table->integer('spek')->nullable();
            $table->double('line_mesin')->nullable();
            $table->double('dus_ppa')->nullable();
            $table->double('box_ppa')->nullable();
            $table->double('batch_ppa')->nullable();
            $table->string('unit_ppa',25)->nullable();
            $table->double('dus_net')->nullable();
            $table->double('box_net')->nullable();
            $table->double('batch_net')->nullable();
            $table->string('unit_net',25)->nullable();
            $table->double('waste')->nullable();
            $table->double('min_order')->nullable();
            $table->string('unit_order',11)->nullable();
            $table->double('harga_uom')->nullable();
            $table->double('cost')->nullable();
            $table->text('Description')->nullable();   
            $table->double('cost_box')->nullable();
            $table->double('cost_dus')->nullable();
            $table->double('cost_sachet')->nullable();    
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
        Schema::dropIfExists('fs_formula_kemas');
    }
}
