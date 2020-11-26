<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\dev\Formula;
use App\dev\Fortail;
use App\nutfact\tb_ingredient;
use App\devnf\allergen_formula;
use App\devnf\tb_akg;
use App\devnf\tb_overage;
use App\dev\bb_allergen;
use App\master\Curren;
use App\dev\Bahan;
use Auth;
use DB;
use Redirect;

class SummaryFormulaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function summarry($formula,$id){
		$data       = formula::with('Workbook')->where('id',$id)->get();
		$akg = tb_akg::join('formulas','formulas.akg','tb_akg.id_tarkon')->join('tb_overage_inngradient','tb_overage_inngradient.id_formula','formulas.id')->where('id',$id)->get();
        $idf = $id;
		$formula = Formula::where('workbook_id',$formula)->join('tb_overage_inngradient','tb_overage_inngradient.id_formula','formulas.id')->where('id',$id)->first();
        $idfor = $formula->workbook_id;
        $fortails = Fortail::where('formula_id',$id)->get();
        $ingredient = DB::table('fortails')
        ->join('tb_nutfact','tb_nutfact.id_ingredient','=','fortails.id_ingredient')
        ->where('fortails.formula_id',$id)
		->get();
		$ada = Fortail::where('formula_id',$id)->count();
		$allergen_bb = allergen_formula::join('tb_bb_allergen','id_bb','tb_alergen_formula.id_bahan')->where('id_formula',$id)->where('allergen_countain','!=','')->select(['allergen_countain'])->distinct()->get();
		$bb_allergen = allergen_formula::join('tb_bb_allergen','id_bb','tb_alergen_formula.id_bahan')->where('id_formula',$id)->where('allergen_countain','!=','')->get();
        if($ada < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.' Masih Kosong');
        }elseif($formula->batch < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.'.'.$formula->turunan.' Belum Memliki Batch');
        }elseif($formula->serving_size != $formula->serving){
            return Redirect::back()->with('error','Data Serving Formula Versi '.$formula->versi.'.'.$formula->turunan.' Tidak Sesuai Target');
        }

        $detail_formula     = collect();  
        $granulasi          = 0;
        $jumlah_granulasi   = 0;
        $biasa              = 0;
        foreach($fortails as $fortail){
			// Get Persen
			$one_persen = $fortail->per_batch / $formula->batch  ;
			$persen = $one_persen * 100;
			$persen = round($persen, 2);
            $detail_formula->push([

                'id' => $fortail->id,
                'kode_komputer' => $fortail->kode_komputer,
                'nama_sederhana' => $fortail->nama_sederhana,
                'alternatif1' => $fortail->alternatif1,
                'alternatif2' => $fortail->alternatif2,
                'alternatif3' => $fortail->alternatif3,
                'alternatif4' => $fortail->alternatif4,
                'alternatif5' => $fortail->alternatif5,
                'alternatif6' => $fortail->alternatif6,
                'alternatif7' => $fortail->alternatif7,
                'nama_bahan' => $fortail->nama_bahan,
                'nama_bahan1' => $fortail->nama_bahan1,
                'nama_bahan2' => $fortail->nama_bahan2,
                'nama_bahan3' => $fortail->nama_bahan3,
                'nama_bahan4' => $fortail->nama_bahan4,
                'nama_bahan5' => $fortail->nama_bahan5,
                'nama_bahan6' => $fortail->nama_bahan6,
				'nama_bahan7' => $fortail->nama_bahan7,
				'principle' => $fortail->principle,
				'principle1' => $fortail->principle1,
				'principle2' => $fortail->principle2,
				'principle3' => $fortail->principle3,
				'principle4' => $fortail->principle4,
				'principle5' => $fortail->principle5,
				'principle6' => $fortail->principle6,
				'principle7' => $fortail->principle7,
                'per_batch' => $fortail->per_batch,
                'per_serving' => $fortail->per_serving,
                'granulasi' => $fortail->granulasi,
                'persen' => $persen,
			]);          
			
            if($fortail->granulasi == 'ya'){
                $granulasi = $granulasi + 1;
                $jumlah_granulasi = $jumlah_granulasi + $fortail->per_batch;
            }
        }

        $biasa = $ada - $granulasi;
        $gp    = $jumlah_granulasi / $one_persen; $gp = round($gp , 2);

        // Tampil Harga Bahan Baku
        $detail_harga = collect();
        $satu_persen = $formula->serving / 100;
		// Inisialisasi Total
		$total_harga_per_gram = 0;
		$total_lemak = 0;
		$total_sfa =0;
		$total_karbohidrat =0;
		$total_gula =0;
		$total_laktosa =0;
		$total_sukrosa =0;
		$total_serat =0;
		$total_seratL =0;
		$total_protein =0;
		$total_kalori =0;
		$total_na =0;
		$total_k =0;
		$total_ca =0;
		$total_mg =0;
		$total_p =0;
		$total_beta=0;
		$total_cr=0;
		$total_vitC=0;
		$total_vitE=0;
		$total_vitD=0;
		$total_carnitin=0;
		$total_cla=0;
		$total_sterol=0;
		$total_chondroitin=0;
		$total_omega3=0;
		$total_dha=0;
		$total_epa=0;
		$total_creatine=0;
		$total_lysine=0;
		$total_glucosamine=0;
		$total_kolin=0;
		$total_mufa=0;
		$total_linoleic6=0;
		$total_linolenic=0;
		$total_sorbitol=0;
		$total_maltitol=0;
        $total_berat_per_serving = 0;
        $total_harga_per_serving = 0;
        $total_berat_per_batch = 0;
        $total_harga_per_batch = 0;
        $total_berat_per_kg = 0;
        $total_harga_per_kg = 0; 

        foreach($fortails as $fortail){
			//Get Needed
			$ingredients = DB::table('tb_nutfact')->first();
            $bahan  = Bahan::where('id',$fortail->bahan_id)->first();
			$curren = Curren::where('id',$bahan->curren_id)->first();
			$btp = DB::table('tb_btp')->join('bahans','bahans.id','=','tb_btp.id_bahan')->first();

            //perhitungan nutfact bayangan
			//lemak
			if($fortail->nama_sederhana != 'NULL'){
				$lemak = ($ingredients->fat/100)*($fortail->per_serving);
				$sfa = ($ingredients->SFA/100)*($fortail->per_serving);
				$karbohidrat =($ingredients->karbohidrat/100)*($fortail->per_serving);
				$gula = ($ingredients->gula_total/100)*($fortail->per_serving);
				$laktosa = ($ingredients->laktosa/100)*($fortail->per_serving);
				$sukrosa = ($ingredients->sukrosa/100)*($fortail->per_serving);
				$serat = ($ingredients->serat/100)*($fortail->per_serving);
				$seratL = ($ingredients->serat_larut/100)*($fortail->per_serving);
				$protein = ($ingredients->protein/100)*($fortail->per_serving);
				$kalori = ($lemak*9)+($karbohidrat*4)+($protein*4);
				$na = ($ingredients->na/100)*($fortail->per_serving);
				$k = ($ingredients->k/100)*($fortail->per_serving);
				$ca = ($ingredients->ca/100)*($fortail->per_serving);
				$mg = ($ingredients->mg/100)*($fortail->per_serving);
				$p = ($ingredients->p/100)*($fortail->per_serving);
				$beta = ($ingredients->beta_glucan/100)*($fortail->per_serving);
				$cr = ($ingredients->cr/100)*($fortail->per_serving);
				$vitC = ($ingredients->vitC/100)*($fortail->per_serving);
				$vitE = ($ingredients->vitE/100)*($fortail->per_serving);
				$vitD = ($ingredients->vitD/100)*($fortail->per_serving);
				$carnitin = ($ingredients->carnitin/100)*($fortail->per_serving);
				$cla = ($ingredients->CLA/100)*($fortail->per_serving);
				$sterol = ($ingredients->sterol_ester/100)*($fortail->per_serving);
				$chondroitin = ($ingredients->chondroitin/100)*($fortail->per_serving);
				$omega3 = ($ingredients->Omega3/100)*($fortail->per_serving);
				$dha = ($ingredients->DHA/100)*($fortail->per_serving);
				$epa = ($ingredients->EPA/100)*($fortail->per_serving);
				$creatine = ($ingredients->creatine/100)*($fortail->per_serving);
				$lysine = ($ingredients->lysine/100)*($fortail->per_serving);
				$glucosamine = ($ingredients->glucosamine/100)*($fortail->per_serving);
				$kolin = ($ingredients->kolin/100)*($fortail->per_serving);
				$mufa = ($ingredients->MUFA/100)*($fortail->per_serving);
				$linoleic6 = ($ingredients->linoleic_acid6/100)*($fortail->per_serving);
				$linolenic = ($ingredients->linolenic_acid/100)*($fortail->per_serving);
				$sorbitol = ($ingredients->sorbitol/100)*($fortail->per_serving);
				$maltitol = ($ingredients->maltitol/100)*($fortail->per_serving);
			}elseif($fortail->id_ingredient == '0'){
				$lemak = 0;
				$sfa = 0;
				$karbohidrat = 0;
				$gula = 0;
				$laktosa = 0;
				$sukrosa = 0;
				$serat = 0;
				$seratL = 0;
				$protein = 0;
				$kalori = 0;
				$na = 0;
				$k = 0;
				$ca = 0;
				$mg = 0;
				$p = 0;
				$beta = 0;
				$cr = 0;
				$vitC = 0;
				$vitE = 0;
				$vitD = 0;
				$carnitin = 0;
				$cla = 0;
				$sterol = 0;
				$chondroitin = 0;
				$omega3 = 0;
				$dha = 0;
				$epa = 0;
				$creatine = 0;
				$lysine = 0;
				$glucosamine = 0;
				$kolin = 0;
				$mufa = 0;
				$linoleic6 = 0;
				$linolenic = 0;
				$sorbitol = 0;
				$maltitol = 0;
			}

            //Start Count
            // Harga Pergram
            $hpg = ($bahan->harga_satuan * $curren->harga) / ($bahan->berat * 1000); $hpg = round($hpg,2);
            // PerServing
            $berat_per_serving = $fortail->per_serving; $berat_per_serving = round($berat_per_serving,5);
            $persen = $fortail->per_serving / $satu_persen; $persen = round($persen,2);
            $harga_per_serving = $berat_per_serving * $hpg; $harga_per_serving = round($harga_per_serving,2);
            // Per Batch
            $berat_per_batch = $fortail->per_batch; $berat_per_batch = round($berat_per_batch,5);
            $harga_per_batch = $berat_per_batch * $hpg; $harga_per_batch = round($harga_per_batch,2);
            // Per Kg
            $berat_per_kg = (1000 * $berat_per_serving) / $formula->serving; $berat_per_kg = round($berat_per_kg,5);
            $harga_per_kg = $berat_per_kg * $hpg; $harga_per_kg = round($harga_per_kg,2);       
            // Tampilkan
            $detail_harga->push([
                'id' => $fortail->id,
                'kode_komputer' => $bahan->kode_komputer,
                'nama_sederhana' => $bahan->nama_sederhana,
				'id_ingeradient' => $bahan->id_ingeradient,
				'btp' =>$btp->btp_carryover,
				'list' =>$btp->inggredient_list,
				'hpg' => $hpg,
				'lemak' => $lemak,
				'sfa' => $sfa,
				'karbohidrat' => $karbohidrat,
				'gula' => $gula,
				'laktosa' => $laktosa,
				'sukrosa' => $sukrosa,
				'serat' => $serat,
				'seratL' => $seratL,
				'protein' => $protein,
				'kalori' => $kalori,
				'na' => $na,
				'k' => $k,
				'ca' => $ca,
				'mg' => $mg,
				'p' => $p,
				'beta' => $beta,
				'cr' => $cr,
				'vitC' => $vitC,
				'vitE' => $vitE,
				'vitD' => $vitD,
				'carnitin' => $carnitin,
				'cla' => $cla,
				'sterol' => $sterol,
				'chondroitin' => $chondroitin,
				'omega3' => $omega3,
				'dha' => $dha,
				'epa' => $epa,
				'creatine' => $creatine,
				'lysine' => $lysine,
				'glucosamine' => $glucosamine,
				'kolin' => $kolin,
				'mufa' => $mufa,
				'linoleic6' => $linoleic6,
				'linolenic' => $linolenic,
				'sorbitol' => $sorbitol,
				'maltitol' => $maltitol,
                'per_serving' =>  $berat_per_serving,
                'persen' => $persen,
                'harga_per_serving' => $harga_per_serving,
                'per_batch' => $berat_per_batch,
                'harga_per_batch' => $harga_per_batch,
                'per_kg' => $berat_per_kg,
                'harga_per_kg' => $harga_per_kg
			]);

			// Count Total
			$total_lemak = $total_lemak + $lemak;
			$total_sfa = $total_sfa + $sfa;
			$total_karbohidrat = $total_karbohidrat + $karbohidrat;
			$total_gula = $total_gula + $gula;
			$total_laktosa = $total_laktosa + $laktosa;
			$total_sukrosa = $total_sukrosa + $sukrosa;
			$total_serat = $total_serat + $serat;
			$total_seratL = $total_seratL + $seratL;
			$total_protein = $total_protein + $protein;
			$total_kalori = $total_kalori + $kalori;
			$total_na = $total_na + $na;
			$total_k = $total_k + $k;
			$total_ca = $total_ca + $ca;
			$total_mg = $total_mg + $mg;
			$total_p = $total_p + $p;
			$total_beta= $total_beta + $beta;
			$total_cr= $total_cr + $cr;
			$total_vitC= $total_vitC + $vitC;
			$total_vitE= $total_vitE + $vitE;
			$total_vitD= $total_vitD + $vitD;
			$total_carnitin= $total_carnitin + $carnitin;
			$total_cla= $total_cla + $cla;
			$total_sterol= $total_sterol + $sterol;
			$total_chondroitin= $total_chondroitin + $chondroitin;
			$total_omega3= $total_omega3 + $omega3;
			$total_dha= $total_dha + $dha;
			$total_epa= $total_epa + $epa;
			$total_creatine= $total_creatine + $creatine;
			$total_lysine= $total_lysine + $lysine;
			$total_glucosamine= $total_glucosamine + $glucosamine;
			$total_kolin= $total_kolin + $kolin;
			$total_mufa= $total_mufa + $mufa;
			$total_linoleic6= $total_linoleic6 + $linoleic6;
			$total_linolenic= $total_linolenic + $linolenic;
			$total_sorbitol= $total_sorbitol + $sorbitol;
			$total_maltitol= $total_maltitol + $maltitol;
            $total_harga_per_gram = $total_harga_per_gram + $hpg;
            $total_berat_per_serving = $total_berat_per_serving + $berat_per_serving;
            $total_harga_per_serving = $total_harga_per_serving + $harga_per_serving;
            $total_berat_per_batch = $total_berat_per_batch + $berat_per_batch;
            $total_harga_per_batch = $total_harga_per_batch + $harga_per_batch;
            $total_berat_per_kg = $total_berat_per_kg + $berat_per_kg;
            $total_harga_per_kg = $total_harga_per_kg + $harga_per_kg;
        }

        $total_harga = collect([
			'total_lemak' => $total_lemak,
			'total_sfa' => $total_sfa,
			'total_karbohidrat' => $total_karbohidrat,
			'total_gula' => $total_gula,
			'total_laktosa' => $total_laktosa,
			'total_sukrosa' => $total_sukrosa,
			'total_serat' => $total_serat,
			'total_seratL' => $total_seratL,
			'total_protein' => $total_protein,
			'total_kalori' => $total_kalori,
			'total_na' => $total_na,
			'total_k' => $total_k,
			'total_ca' => $total_ca,
			'total_mg' => $total_mg,
			'total_p' => $total_p,
			'total_beta' => $total_beta,
			'total_cr' => $total_cr,
			'total_vitC' => $total_vitC,
			'total_vitD' => $total_vitD,
			'total_vitE' => $total_vitE,
			'total_carnitin' => $total_carnitin,
			'total_cla' => $total_cla,
			'total_sterol' => $total_sterol,
			'total_chondroitin' => $total_chondroitin,
			'total_omega3' => $total_omega3,
			'total_dha' => $total_dha,
			'total_epa' => $total_epa,
			'total_creatine' => $total_creatine,
			'total_lysine' => $total_lysine,
			'total_glucosamine' => $total_glucosamine,
			'total_kolin' => $total_kolin,
			'total_mufa' => $total_mufa,
			'total_linoleic6' => $total_linoleic6,
			'total_linolenic' => $total_linolenic,
			'total_sarbitol' => $total_sorbitol,
			'total_maltitol' => $total_maltitol,
            'total_harga_per_gram' => $total_harga_per_gram,
            'total_berat_per_serving' => $total_berat_per_serving,
            'total_persen' => 100,
            'total_harga_per_serving' => $total_harga_per_serving,
            'total_berat_per_batch' => $total_berat_per_batch,
            'total_harga_per_batch' => $total_harga_per_batch,
            'total_berat_per_kg' => $total_berat_per_kg,
            'total_harga_per_kg' => $total_harga_per_kg,                       
		]);
        
        return view('formula/summarry', compact(
        'data','id'  ))->with([
            'idf' => $idf,
            'ada'     => $ada,
            'formula' => $formula,
            'detail_formula' =>  $detail_formula,
            'granulasi' => $granulasi,
			'gp' => $gp,
			'akg' => $akg,
			'idfor' => $idfor,
			'ingredient' => $ingredient,
			'allergen_bb' => $allergen_bb,
            'detail_harga' => $detail_harga,
            'total_harga' => $total_harga
        ]);
	}

	public function overage(Request $request,$id){
		$formula = formula::where('id',$id)->first();
		$formula->overage=$request->overage;
		$formula->save();

		$overage = tb_overage::where('id_formula',$id)->first();
		$overage->energi_total=$request->energi_total;
		$overage->energi_lemak=$request->energi_lemak;
		$overage->energi_lemak_jenuh=$request->energi_lemak_jenuh;$overage->karbohidrat=$request->karbohidrat;
		$overage->protein1=$request->protein1;$overage->lemak_total=$request->lemak_total;
		$overage->lemak_trans=$request->lemak_trans;$overage->lemak_jenuh=$request->lemak_jenuh;
		$overage->lemak_tidak_jenuh_tunggal=$request->lemak_tidak_jenuh_tunggal;$overage->gluten=$request->gluten;
		$overage->lemak_tidak_jenuh_ganda=$request->lemak_tidak_jenuh_ganda;$overage->kolestrol=$request->kolestrol;
		$overage->gula=$request->gula;$overage->serat_pangan=$request->serat_pangan;
		$overage->sukrosa=$request->sukrosa;$overage->laktosa=$request->laktosa;$overage->serat_pangan_larut=$request->serat_pangan_larut;
		$overage->gula_alkohol=$request->gula_alkohol;$overage->natrium=$request->natrium;$overage->kalium=$request->kalium;
		$overage->kalsium=$request->kalsium;$overage->zat_besi=$request->zat_besi;$overage->fosfor=$request->fosfor;
		$overage->magnesium=$request->magnesium;
		$overage->seng=$request->seng;
		$overage->selenium=$request->selenium;
		$overage->lodium=$request->lodium;$overage->mangan=$request->mangan;$overage->flour=$request->flour;
		$overage->tembaga=$request->tembaga;$overage->vitA=$request->vitA;$overage->vitB1=$request->vitB1;$overage->vitB2=$request->vitB2;
		$overage->vitB3=$request->vitB3;$overage->vitB5=$request->vitB5;$overage->vitB6=$request->vitB6;$overage->vitB12=$request->vitB12;
		$overage->vitC=$request->vitC;$overage->vitD3=$request->vitD3;$overage->vitE=$request->vitE;$overage->vitB3=$request->vitB3;
		$overage->asam_folat=$request->asam_folat;$overage->magnesium_aspartat=$request->magnesium_aspartat;
		$overage->kolin=$request->kolin;$overage->biotin=$request->biotin;$overage->Inositol=$request->Inositol;
		$overage->Molibdenum=$request->Molibdenum;$overage->Kromium=$request->Kromium;$overage->EPA=$request->EPA;
		$overage->DHA=$request->DHA;$overage->Glukosamin=$request->Glukosamin;$overage->Kondroitin=$request->Kondroitin;
		$overage->Kolagen=$request->Kolagen;$overage->EGCG=$request->EGCG;$overage->Kreatina=$request->Kreatina;
		$overage->MCT=$request->MCT;$overage->CLA=$request->CLA;$overage->omega3=$request->omega3;
		$overage->omega6=$request->omega6;$overage->omega9=$request->omega9;$overage->Klorida=$request->Klorida;
		$overage->asam_linoleat=$request->asam_linoleat;$overage->energi_asam_linoleat=$request->energi_asam_linoleat;
		$overage->energi_protein=$request->energi_protein;$overage->l_karnitin=$request->l_karnitin;$overage->l_glutamin=$request->l_glutamin;
		$overage->Thereonin=$request->Thereonin;$overage->Methionin=$request->Methionin;$overage->Phenilalanin=$request->Phenilalanin;
		$overage->Histidin=$request->Histidin;$overage->Lisin=$request->Lisin;$overage->BCAA=$request->BCAA;
		$overage->Valin=$request->Valin;$overage->Isoleusin=$request->Isoleusin;$overage->Leusin=$request->Leusin;
		$overage->Alanin=$request->Alanin;$overage->asam_aspartat=$request->asam_aspartat;$overage->asam_glutamat=$request->asam_glutamat;
		$overage->sistein=$request->sistein;$overage->serin=$request->serin;$overage->glisin=$request->glisin;
		$overage->tyrosin=$request->tyrosin;$overage->proline=$request->proline;$overage->arginine=$request->arginine;
		$overage->save();

		return redirect::back();
	}
}