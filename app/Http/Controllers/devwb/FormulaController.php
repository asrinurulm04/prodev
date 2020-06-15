<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dev\Workbook;
use App\dev\Formula;
use App\devnf\tb_vitmin;
use App\devnf\tb_nutrition;
use App\nutfact\tb_parameter;
use App\dev\Fortail;
use App\dev\Premix;
use App\dev\Pretail;
use App\dev\Bahan;
use App\master\Curren;
use App\Pesan;
use Auth;
use DB;
use Redirect;

class FormulaController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk' || 'rule:kemas');
    }
    
    public function new(Request $request)
    {
        // New Formula        
        $formulas = new Formula;
        $formulas->workbook_id = $request->workbook_id;
        $formulas->kode_formula = $request->kode_formula;
        $formulas->serving_size = $request->target_serving;
        $formulas->revisi = '0';
        $formulas->versi = 1;   
        $formulas->save();
        
        return redirect()->route('step2',$request->workbook_id)->with('status', 'Formula '.$formulas->nama_produk.' Telah Ditambahkan!');
    }

    // Hapus Formula-----------------------------------------------------------------------------------------------------    
    public function deleteformula($id){
        $formula = Formula::where('id',$id)->first();
    
        // Delete Pesan
        $pesan = Pesan::where('formula_id',$id)->delete();
        $fortails = Fortail::where('formula_id',$formula->id)->get();
        foreach($fortails as $fortail){
            $premixs = Premix::where('fortail_id',$fortail->id)->get();
            foreach($premixs as $premix){
                $pretails = Pretail::where('premix_id',$premix->id)->get();
                foreach($pretails as $pretail){
                    $pretail->delete();
                }
            $premix->delete();
            }
        $fortail->delete();
        }
        $formula->delete();
            
        return Redirect::back()->with('error', 'Formula Versi '.$formula->versi.'.'.$formula->turunan.' Telah Dihapus!');
    }

    // Detail Formula----------------------------------------------------------------------------------------------------
    public function detail($id){
        $data       = formula::with('Workbook')->where('workbook_id',$id)->get();
        $ing        = tb_nutrition::with('get_bahan','get_btp')->get();
        $tampilkan  = tb_parameter::with('get_akg')->offset(23)->limit(84)->get();
        
        //NUTFACT BAYANGAN
        $vit_a      = tb_vitmin::select('target')->where('parameter','12')->get();
        $thi        = tb_vitmin::select('target')->where('parameter','2')->get();
        $rib        = tb_vitmin::select('target')->where('parameter','10')->get();
        $nia        = tb_vitmin::select('target')->where('parameter','3')->get();
        $b5         = tb_vitmin::select('target')->where('parameter','20')->get();
        $pyr        = tb_vitmin::select('target')->where('parameter','21')->get();
        $b7         = tb_vitmin::select('target')->where('parameter','11')->get();
        $b12        = tb_vitmin::select('target')->where('parameter','60')->get();
        $asam       = tb_vitmin::select('target')->where('parameter','4')->get();
        $vit_c      = tb_vitmin::select('target')->where('parameter','61')->get();
        $vit_d      = tb_vitmin::select('target')->where('parameter','62')->get();
        $vit_e      = tb_vitmin::select('target')->where('parameter','14')->get();
        $mag        = tb_vitmin::select('target')->where('parameter','47')->get();
        $man        = tb_vitmin::select('target')->where('parameter','16')->get();
        $zin        = tb_vitmin::select('target')->where('parameter','48')->get();
        $lod        = tb_vitmin::select('target')->where('parameter','22')->get();
        $zat        = tb_vitmin::select('target')->where('parameter','45')->get();
        $sel        = tb_vitmin::select('target')->where('parameter','49')->get();
        $mol        = tb_vitmin::select('target')->where('parameter','69')->get();
        $ino        = tb_vitmin::select('target')->where('parameter','68')->get();
        
        $idf = $id;
		$formula = Formula::where('workbook_id',$id)->first();
        $fortails = Fortail::where('formula_id',$formula->workbook_id)->get();
        $ingredient = DB::table('fortails')
        ->join('tb_ingredients','tb_ingredients.id_ingredient','=','fortails.id_ingredient')
        ->where('fortails.formula_id',$id)
		->get();
	//dd($ingredient);
		$ada = Fortail::where('formula_id',$formula->workbook_id)->count();

        if($ada < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.' Masih Kosong');
        }elseif($formula->batch < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.'.'.$formula->turunan.' Belum Memliki Batch');
        }

        $detail_formula     = collect();  
        $granulasi          = 0;
        $jumlah_granulasi   = 0;
        $biasa              = 0;
        $one_persen         = $formula->batch / 100;

        foreach($fortails as $fortail){
            // Get Persen
            $persen = $fortail->per_batch / $one_persen; $persen = round($persen, 2);
            $detail_formula->push([

                'id' => $fortail->id,
                'kode_komputer' => $fortail->kode_komputer,
                'nama_sederhana' => $fortail->nama_sederhana,
                'nama_bahan' => $fortail->nama_bahan,
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
			$ingredients = DB::table('tb_ingredients')->first();
            $bahan  = Bahan::where('id',$fortail->bahan_id)->first();
			$curren = Curren::where('id',$bahan->curren_id)->first();

            //perhitungan nutfact bayangan
			//lemak
			if($fortail->id_ingredient != 'NULL'){
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

        return view('devwb/detailformula',  compact('ing','tampilkan','AMC','AMC2','AMC3','AMC4','AMC5','AMC6','AMC7',
        'data','vit_a','thi','rib','nia','b5','pyr','b7','b12','asam','vit_c',
        'vit_d','vit_e','mag','man','zin','lod','zat','sel','mol','ino' ,'id'  ))->with([
            'ada'     => $ada,
            'formula' => $formula,
            'detail_formula' =>  $detail_formula,
            'granulasi' => $granulasi,
            'gp' => $gp,
            'detail_harga' => $detail_harga,
            'total_harga' => $total_harga
        ]);
    }
}