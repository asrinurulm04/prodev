<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrOverageInngradient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_overage_inngradient', function (Blueprint $table) {
            $table->increments('id_overage');
            $table->integer('id_formula')->nullable();
            $table->enum('overage_energi_total',['yes','no'])->nullable();
            $table->enum('overage_energi_lemak',['yes','no'])->nullable();
            $table->enum('overage_energi_lemak_jenuh',['yes','no'])->nullable();
            $table->enum('overage_karbohidrat',['yes','no'])->nullable();
            $table->enum('overage_protein1',['yes','no'])->nullable();
            $table->enum('overage_lemak_total',['yes','no'])->nullable();
            $table->enum('overage_lemak_trans',['yes','no'])->nullable();
            $table->enum('overage_lemak_jenuh',['yes','no'])->nullable();
            $table->enum('overage_lemak_tidak_jenuh_tunggal',['yes','no'])->nullable();
            $table->enum('overage_lemak_tidak_jenuh_ganda',['yes','no'])->nullable();
            $table->enum('overage_kolestrol',['yes','no'])->nullable();
            $table->enum('overage_gula',['yes','no'])->nullable();
            $table->enum('overage_serat_pangan',['yes','no'])->nullable();
            $table->enum('overage_serat_pangan_larut',['yes','no'])->nullable();
            $table->enum('overage_serat_pangan_tidaklarut',['yes','no'])->nullable();
            $table->enum('overage_sukrosa',['yes','no'])->nullable();
            $table->enum('overage_laktosa',['yes','no'])->nullable();
            $table->enum('overage_gula_alkohol',['yes','no'])->nullable();
            $table->enum('overage_natrium',['yes','no'])->nullable();
            $table->enum('overage_kalium',['yes','no'])->nullable();
            $table->enum('overage_kalsium',['yes','no'])->nullable();
            $table->enum('overage_zat_besi',['yes','no'])->nullable();
            $table->enum('overage_fosfor',['yes','no'])->nullable();
            $table->enum('overage_magnesium',['yes','no'])->nullable();            
            $table->enum('overage_seng',['yes','no'])->nullable();
            $table->enum('overage_selenium',['yes','no'])->nullable();
            $table->enum('overage_lodium',['yes','no'])->nullable();
            $table->enum('overage_mangan',['yes','no'])->nullable();
            $table->enum('overage_flour',['yes','no'])->nullable();
            $table->enum('overage_tembaga',['yes','no'])->nullable();
            $table->enum('overage_vitA',['yes','no'])->nullable();
            $table->enum('overage_vitB1',['yes','no'])->nullable();
            $table->enum('overage_vitB2',['yes','no'])->nullable();
            $table->enum('overage_vitB3',['yes','no'])->nullable();
            $table->enum('overage_vitB5',['yes','no'])->nullable();
            $table->enum('overage_vitB6',['yes','no'])->nullable();
            $table->enum('overage_vitB12',['yes','no'])->nullable();
            $table->enum('overage_vitC',['yes','no'])->nullable();
            $table->enum('overage_vitD3',['yes','no'])->nullable();
            $table->enum('overage_vitE',['yes','no'])->nullable();
            $table->enum('overage_vitK',['yes','no'])->nullable();
            $table->enum('overage_asam_folat',['yes','no'])->nullable();
            $table->enum('overage_magnesium_aspartat',['yes','no'])->nullable();
            $table->enum('overage_kolin',['yes','no'])->nullable();
            $table->enum('overage_biotin',['yes','no'])->nullable();
            $table->enum('overage_Inositol',['yes','no'])->nullable();
            $table->enum('overage_Molibdenum',['yes','no'])->nullable();
            $table->enum('overage_Kromium',['yes','no'])->nullable();

            $table->enum('overage_EPA',['yes','no'])->nullable();
            $table->enum('overage_DHA',['yes','no'])->nullable();
            $table->enum('overage_Glukosamin',['yes','no'])->nullable();
            $table->enum('overage_Kondroitin',['yes','no'])->nullable();
            $table->enum('overage_Kolagen',['yes','no'])->nullable();
            $table->enum('overage_EGCG',['yes','no'])->nullable();
            $table->enum('overage_Kreatina',['yes','no'])->nullable();
            $table->enum('overage_MCT',['yes','no'])->nullable();
            $table->enum('overage_CLA',['yes','no'])->nullable();
            $table->enum('overage_omega3',['yes','no'])->nullable();
            $table->enum('overage_omega6',['yes','no'])->nullable();
            $table->enum('overage_omega9',['yes','no'])->nullable();
            $table->enum('overage_Klorida',['yes','no'])->nullable();
            $table->enum('overage_asam_linoleat',['yes','no'])->nullable();
            $table->enum('overage_energi_asam_linoleat',['yes','no'])->nullable();
            $table->enum('overage_energi_protein',['yes','no'])->nullable();
            $table->enum('overage_l_karnitin',['yes','no'])->nullable();
            $table->enum('overage_l_glutamin',['yes','no'])->nullable();
            $table->enum('overage_Thereonin',['yes','no'])->nullable();
            $table->enum('overage_Methionin',['yes','no'])->nullable();
            $table->enum('overage_Phenilalanin',['yes','no'])->nullable();
            $table->enum('overage_Histidin',['yes','no'])->nullable();
            $table->enum('overage_Lisin',['yes','no'])->nullable();
            $table->enum('overage_BCAA',['yes','no'])->nullable();
            $table->enum('overage_Valin',['yes','no'])->nullable();
            $table->enum('overage_Isoleusin',['yes','no'])->nullable();
            $table->enum('overage_Leusin',['yes','no'])->nullable();
            $table->enum('overage_Alanin',['yes','no'])->nullable();
            $table->enum('overage_asam_aspartat',['yes','no'])->nullable();
            $table->enum('overage_asam_glutamat',['yes','no'])->nullable();
            $table->enum('overage_sistein',['yes','no'])->nullable();
            $table->enum('overage_serin',['yes','no'])->nullable();
            $table->enum('overage_glisin',['yes','no'])->nullable();
            $table->enum('overage_tyrosin',['yes','no'])->nullable();
            $table->enum('overage_proline',['yes','no'])->nullable();
            $table->enum('overage_arginine',['yes','no'])->nullable();
            $table->enum('overage_gluten',['yes','no'])->nullable();
            $table->enum('overage_air',['yes','no'])->nullable();
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
        Schema::dropIfExists('tr_overage_inngradient');
    }
}
