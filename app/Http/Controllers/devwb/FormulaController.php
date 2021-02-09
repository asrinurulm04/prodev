<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Modelfn\finance;
use App\model\devnf\hasilpanel;
use App\model\devnf\tb_overage;
use App\model\devnf\storage;
use App\model\devnf\allergen_formula;
use App\model\devnf\tb_akg;
use App\model\dev\tr_makro_bb;
use App\model\dev\tr_btp_bb;
use App\model\dev\tr_mineral_bb;
use App\model\dev\tr_vitamin_bb;
use App\model\dev\tr_asam_amino_bb;
use App\model\dev\tr_zataktif_bb;
use App\model\dev\tr_logamberat_bb;
use App\model\dev\tr_data_formula;
use App\model\dev\Fortail;
use App\model\dev\Bahan;
use App\model\dev\Formula;
use App\model\pkp\project_pdf;
use App\model\pkp\pkp_project;
use App\model\master\Curren;
use App\model\master\tr_header_formula;
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
        $formulas = new Formula;
        $formulas->workbook_id = $request->workbook_id;
        $formulas->workbook_pdf_id = $request->workbook_pdf_id;
        $formulas->formula = $request->formula;
		$formulas->serving_size = $request->target_serving;
		$formulas->satuan=$request->satuan;
		$formulas->tgl_create=$request->last;
		$formulas->akg=$request->akg;
		$formulas->overage='100';
		$formulas->berat_jenis=$request->berat_jenis;
		if($request->kategori_formula!=NULL){
		$formulas->kategori=$request->kategori_formula;
		}else{
			$formulas->kategori='fg';
		}
        $formulas->versi = 1;   
		$formulas->save();
		
        $overage = new tr_header_formula;
        $overage->id_formula=$formulas->id;
		$overage->save();
		
        $header = new tb_overage;
        $header->id_formula=$formulas->id;
		$header->save();
		
		if($request->workbook_id!=NULL){
			$pkp = pkp_project::where('id_project',$request->workbook_id)->first();
			$pkp->workbook='1';
			$pkp->save();
			return redirect()->route('step1',['id_workbook' => $request->workbook_id, 'id_formula' => $formulas->id])->with('status', 'Formula '.$formulas->nama_produk.' Telah Ditambahkan!');
		}else{
			$pdf = project_pdf::where('id_project_pdf',$request->workbook_pdf_id)->first();
			$pdf->workbook='1';
			$pdf->save();
			return redirect()->route('step1_pdf',['id_pdf_workbook' => $request->workbook_pdf_id, 'id_formula' => $formulas->id])->with('status', 'Formula '.$formulas->nama_produk.' Telah Ditambahkan!');
		}
        
    }

    public function deleteformula($id){
		$formula = Formula::where('id',$id)->first();
		$allergen = allergen_formula::where('id_formula',$id)->delete();
        $fortails = Fortail::where('formula_id',$id)->get();
        foreach($fortails as $fortail){
        	$fortail->delete();
        }
        $formula->delete();
		
		$panel = hasilpanel::where('id_formula',$id)->count();
		if($panel>='1'){
			$panel1 = hasilpanel::where('id_formula',$id)->first();
			$panel1->delete();
		}

		$storage = storage::where('id_formula',$id)->count();
		if($storage>='1'){
			$storage1 = storage::where('id_formula',$id)->delete();
		}
		
		if($formula->workbook_id!=NULL){
			$pkp_hitung = pkp_project::where('id_project',$formula->workbook_id)->max('workbook')-1;
			$pkp = pkp_project::where('id_project',$formula->workbook_id)->first();
			$pkp->workbook=$pkp_hitung;
			$pkp->save();
		}
		if($formula->workbook_pdf_id!=NULL){
			$pdf_hitung = project_pdf::where('id_project_pdf',$formula->workbook_pdf_id)->max('workbook')-1;
			$pdf = project_pdf::where('id_project_pdf',$formula->workbook_pdf_id)->first();
			$pdf->workbook=$pdf_hitung;
			$pdf->save();
		}

        return Redirect::back()->with('error', 'Formula Versi '.$formula->versi.'.'.$formula->turunan.' Telah Dihapus!');
    }

    public function detail($formula,$id){
		$file = tr_data_formula::where('id_formula',$id)->get();
		$hfile = tr_data_formula::where('id_formula',$id)->count();
		$data = Formula::with('Workbook')->where('id',$id)->get();
		$akg = tb_akg::join('formulas','formulas.akg','tb_akg.id_tarkon')->join('tb_overage_inngradient','tb_overage_inngradient.id_formula','formulas.id')->where('id',$id)->get();
		$idf = $id;
		$formula = Formula::where('id',$id)->join('tb_overage_inngradient','tb_overage_inngradient.id_formula','formulas.id')->first();
        $idfor = $formula->workbook_id;
		$panel = hasilpanel::where('id_formula',$id)->get();
		$storage = storage::where('id_formula',$id)->get();
        $idfor_pdf = $formula->workbook_pdf_id;
        $fortails = Fortail::where('formula_id',$id)->get();
        $ingredient = DB::table('fortails')->where('fortails.formula_id',$id)->get();
		$ada = Fortail::where('formula_id',$id)->count();
		$allergen_bb = allergen_formula::join('tb_bb_allergen','id_bb','tb_alergen_formula.id_bahan')->where('id_formula',$id)->where('allergen_countain','!=','')->select(['allergen_countain'])->distinct()->get();
		$bb_allergen = allergen_formula::join('tb_bb_allergen','id_bb','tb_alergen_formula.id_bahan')->where('id_formula',$id)->where('allergen_countain','!=','')->get();
        if($ada < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.' Masih Kosong');
        }elseif($formula->batch < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.'.'.$formula->turunan.' Belum Memliki Batch');
        }elseif($formula->note_formula == Null){
            return Redirect::back()->with('error','Note Formula untuk versi '.$formula->versi.'.'.$formula->turunan.' Masih Kosong');
        }elseif($formula->serving != $formula->serving_size){
			return Redirect::back()->with('error','Total Serving tidak sesuai target');
		}

        $detail_formula     = collect();  
        $granulasi= 0; $jumlah_granulasi= 0; $premix= 0;
        $jumlah_premix= 0; $biasa= 0;
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
                'premix' => $fortail->premix,
                'persen' => $persen,
			]);          
			
            if($fortail->granulasi == 'ya'){
                $granulasi = $granulasi + 1;
                $jumlah_granulasi = $jumlah_granulasi + $fortail->per_batch;
			}
			if($fortail->premix == 'ya'){
                $premix = $premix + 1;
                $jumlah_premix = $jumlah_premix + $fortail->per_batch;
            }
        }

        $biasa = $ada - $granulasi;
        $gp    = $jumlah_granulasi / $one_persen; $gp = round($gp , 2);
        $pr    = $jumlah_premix / $one_persen; $gp = round($gp , 2);

        // Tampil Harga Bahan Baku
        $detail_harga = collect();
        $satu_persen = $formula->serving / 100;
		// total makro
		$total_karbohidrat =0; $total_glukosa = 0; $total_serat = 0; $total_beta = 0;
		$total_sorbitol = 0; $total_maltitol = 0; $total_laktosa = 0; $total_sukrosa = 0;
		$total_gula = 0; $total_erythritol  = 0; $total_dha = 0; $total_epa = 0;
		$total_omega3 = 0; $total_mufa = 0; $total_lemak_trans = 0; $total_lemak_jenuh = 0;
		$total_sfa = 0; $total_omega6 = 0; $total_kolestrol = 0; $total_protein = 0;
		$total_air = 0;
		// total mineral
		$total_ca = 0; $total_mg = 0; $total_k = 0; $total_zink = 0;
		$total_p = 0; $total_na = 0; $total_naci = 0; $total_energi = 0;
		$total_fosfor = 0; $total_mn = 0; $total_cr = 0; $total_fe = 0;
		// total vitamin
		$total_vitA = 0; $total_vitB1 = 0; $total_vitB2 = 0; $total_vitB3 = 0;
		$total_vitB5 = 0; $total_vitB6 = 0; $total_vitB12 = 0; $total_vitC = 0;
		$total_vitD = 0; $total_vitE = 0; $total_vitK = 0; $total_folat = 0;
		$total_biotin = 0; $total_kolin = 0;
		// total asam amino
		$total_l_glutamine =0; $total_threonin =0;
		$total_methionin =0;  $total_phenilalanin =0;
		$total_histidin =0; $total_lisin =0;
		$total_BCAA =0; $total_valin =0;
		$total_leusin =0; $total_aspartat =0;
		$total_alanin =0; $total_sistein =0;
		$total_serin =0; $total_glisin =0;
		$total_glutamat =0; $total_tyrosin =0;
		$total_proline =0; $total_arginine =0;
		$total_Isoleusin =0;
		// berat
        $total_berat_per_serving = 0; $total_berat_per_batch = 0; $total_berat_per_kg = 0;
		// harga
        $total_harga_per_batch = 0; $total_harga_per_serving = 0; $total_harga_per_kg = 0; $total_harga_per_gram = 0;

        foreach($fortails as $fortail){
			//Get Needed
			$ingredients = DB::table('tb_nutfact')->first();
			$mineral =tr_mineral_bb::where('id_bahan',$fortail->bahan_id)->first();
			$makro = tr_makro_bb::where('id_bahan',$fortail->bahan_id)->first();
			$asam = tr_asam_amino_bb::where('id_bahan',$fortail->bahan_id)->first();
			$vitamin = tr_vitamin_bb::where('id_bahan',$fortail->bahan_id)->first();
            $bahan  = Bahan::where('id',$fortail->bahan_id)->first();
			$btp = tr_btp_bb::where('id_bahan',$fortail->bahan_id)->get();
			$hitung_btp = tr_btp_bb::where('id_bahan',$fortail->bahan_id)->count();
			$curren = Curren::where('id',$bahan->curren_id)->first();

            //perhitungan nutfact bayangan
			if($fortail->nama_sederhana != 'NULL'){
				// makro
				$karbohidrat =($makro->karbohidrat/100)*($fortail->per_serving);
				$glukosa = ($makro->glukosa/100)*($fortail->per_serving);
				$serat = ($makro->serat_pangan/100)*($fortail->per_serving);
				$beta = ($makro->beta_glucan/100)*($fortail->per_serving);
				$sorbitol = ($makro->sorbitol/100)*($fortail->per_serving);
				$maltitol = ($makro->maltitol/100)*($fortail->per_serving);
				$laktosa = ($makro->laktosa/100)*($fortail->per_serving);
				$sukrosa = ($makro->sukrosa/100)*($fortail->per_serving);
				$gula = ($makro->gula/100)*($fortail->per_serving);
				$erythritol  = ($makro->erythritol /100)*($fortail->per_serving);
				$dha = ($makro->DHA/100)*($fortail->per_serving);
				$epa = ($makro->EPA/100)*($fortail->per_serving);
				$omega3 = ($makro->Omega3/100)*($fortail->per_serving);
				$mufa = ($makro->MUFA/100)*($fortail->per_serving);
				$lemak_trans = ($makro->lemak_trans/100)*($fortail->per_serving);
				$lemak_jenuh = ($makro->lemak_jenuh/100)*($fortail->per_serving);
				$sfa = ($makro->SFA/100)*($fortail->per_serving);
				$omega6 = ($makro->omega6/100)*($fortail->per_serving);
				$kolestrol = ($makro->kolesterol/100)*($fortail->per_serving);
				$protein = ($makro->protein/100)*($fortail->per_serving);
				$air = ($makro->air/100)*($fortail->per_serving);
				// mineral
				$ca = ($mineral->ca/100)*($fortail->per_serving);
				$mg = ($mineral->mg/100)*($fortail->per_serving);
				$k = ($mineral->k/100)*($fortail->per_serving);
				$zink = ($mineral->zink/100)*($fortail->per_serving);
				$p = ($mineral->p/100)*($fortail->per_serving);
				$na = ($mineral->na/100)*($fortail->per_serving);
				$naci = ($mineral->naci/100)*($fortail->per_serving);
				$energi = ($mineral->energi/100)*($fortail->per_serving);
				$fosfor = ($mineral->fosfor/100)*($fortail->per_serving);
				$mn = ($mineral->mn/100)*($fortail->per_serving);
				$cr = ($mineral->cr/100)*($fortail->per_serving);
				$fe = ($mineral->fe/100)*($fortail->per_serving);
				// vitamin
				$vitA = ($vitamin->vitA/100)*($fortail->per_serving);
				$vitB1 = ($vitamin->vitB1/100)*($fortail->per_serving);
				$vitB2 = ($vitamin->vitB2/100)*($fortail->per_serving);
				$vitB3 = ($vitamin->vitB3/100)*($fortail->per_serving);
				$vitB5 = ($vitamin->vitB5/100)*($fortail->per_serving);
				$vitB6 = ($vitamin->vitB6/100)*($fortail->per_serving);
				$vitB12 = ($vitamin->vitB12/100)*($fortail->per_serving);
				$vitC = ($vitamin->vitC/100)*($fortail->per_serving);
				$vitD = ($vitamin->vitD/100)*($fortail->per_serving);
				$vitE = ($vitamin->vitE/100)*($fortail->per_serving);
				$vitK = ($vitamin->vitK/100)*($fortail->per_serving);
				$folat = ($vitamin->folat/100)*($fortail->per_serving);
				$biotin = ($vitamin->biotin/100)*($fortail->per_serving);
				$kolin = ($vitamin->kolin/100)*($fortail->per_serving);
				//asam amino
				$l_glutamine = ($asam->l_glutamin/100)*($fortail->per_serving);      $threonin = ($asam->Threonin/100)*($fortail->per_serving);
				$methionin = ($asam->Methionin/100)*($fortail->per_serving);         $phenilalanin = ($asam->Phenilalanin/100)*($fortail->per_serving);
				$histidin = ($asam->Histidin/100)*($fortail->per_serving);           $lisin = ($asam->lisin/100)*($fortail->per_serving);
				$BCAA = ($asam->BCAA/100)*($fortail->per_serving);                   $valin = ($asam->Valin/100)*($fortail->per_serving);
				$leusin = ($asam->Leusin/100)*($fortail->per_serving);               $aspartat = ($asam->Aspartat/100)*($fortail->per_serving);           
				$alanin = ($asam->Alanine/100)*($fortail->per_serving);              $sistein = ($asam->Sistein/100)*($fortail->per_serving);
				$serin = ($asam->Serin/100)*($fortail->per_serving);                 $glisin = ($asam->Glisin/100)*($fortail->per_serving);
				$glutamat = ($asam->Glutamat/100)*($fortail->per_serving);           $tyrosin = ($asam->Tyrosin/100)*($fortail->per_serving);
				$proline = ($asam->Proline/100)*($fortail->per_serving);             $arginine = ($asam->Arginine/100)*($fortail->per_serving);
				$Isoleusin = ($asam->Isoleusin/100)*($fortail->per_serving);
				       
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
				// data
                'id' => $fortail->id,
                'kode_komputer' => $bahan->kode_komputer,
                'nama_sederhana' => $bahan->nama_sederhana,
				'bahan' => $bahan->id,
				'hitung_btp' => $hitung_btp,
				'id_ingeradient' => $bahan->id_ingeradient,
				'hpg' => $hpg,
				//makro
				'karbohidrat' => $karbohidrat, 		'glukosa' => $glukosa ,
				'serat' => $serat ,            		'beta' => $beta,
				'sorbitol' => $sorbitol ,      		'maltitol' => $maltitol ,
				'laktosa' => $laktosa ,      		'sukrosa' => $sukrosa,
				'gula' => $gula ,              		'erythritol' => $erythritol  ,
				'dha' => $dha ,                		'epa' => $epa,
				'omega3' => $omega3 ,          		'mufa' => $mufa ,
				'lemak_trans' => $lemak_trans ,		'lemak_jenuh' => $lemak_jenuh,
				'sfa' => $sfa ,                		'omega6' => $omega6 ,
				'kolestrol' => $kolestrol ,    		'protein' => $protein,
				'air' => $air,
				//mineral
				'ca' => $ca ,        				'mg' => $mg ,
				'k' => $k ,          				'zink' => $zink,
				'p' => $p ,          				'na' => $na ,
				'naci' => $naci ,    				'energi' => $energi,
				'fosfor' => $fosfor, 				'mn' => $mn ,
				'cr' => $cr ,        				'fe' => $fe,
				//vitamin
				'vitA' => $vitA ,    				'vitB1' => $vitB1 ,
				'vitB2' => $vitB2 ,  				'vitB3' => $vitB3,
				'vitB5' => $vitB5 ,  				'vitB6' => $vitB6 ,
				'vitB12' => $vitB12, 				'vitC' => $vitC,
				'vitD' => $vitD ,    				'vitE' => $vitE ,
				'vitK' => $vitK ,    				'folat' => $folat,
				'biotin' => $biotin, 				'kolin' => $kolin,
				//asam amino
				'l_glutamine' => $l_glutamine ,    'threonin' => $threonin ,
				'methionin' => $methionin ,        'phenilalanin' => $phenilalanin,
				'histidin' => $histidin ,          'lisin' => $lisin ,
				'BCAA' => $BCAA ,                  'valin' => $valin,
				'leusin' => $leusin ,              'sistein' => $sistein ,
				'aspartat' => $aspartat ,          'alanin' => $alanin,
				'serin' => $serin ,                'glisin' => $glisin,
				'glutamat' => $glutamat ,          'tyrosin' => $tyrosin ,
				'arginine' => $arginine ,          'proline' => $proline,
				'Isoleusin' => $Isoleusin ,   

				// data
                'persen' => $persen,               'per_serving' =>  $berat_per_serving,
                'per_batch' => $berat_per_batch,   'harga_per_serving' => $harga_per_serving,
                'per_kg' => $berat_per_kg,         'harga_per_batch' => $harga_per_batch,
                'harga_per_kg' => $harga_per_kg
			]);

			// Count Total
			// total makro
			$total_karbohidrat = $total_karbohidrat+$karbohidrat; 
			$total_glukosa = $total_glukosa + $glukosa; 
			$total_serat = $total_serat + $serat; 
			$total_beta = $total_beta + $beta;
			$total_sorbitol = $total_sorbitol + $sorbitol; 
			$total_maltitol = $total_maltitol + $maltitol;
			$total_laktosa = $total_laktosa + $laktosa; 
			$total_sukrosa = $total_sukrosa + $sukrosa;
			$total_gula = $total_gula + $gula;
			$total_erythritol  = $total_erythritol + $erythritol;
			$total_dha = $total_dha + $dha; 
			$total_epa = $total_epa + $epa;
			$total_omega3 = $total_omega3 + $omega3; 
			$total_mufa = $total_mufa + $mufa; 
			$total_lemak_trans = $total_lemak_trans + $lemak_trans; 
			$total_lemak_jenuh = $total_lemak_jenuh + $lemak_jenuh;
			$total_sfa = $total_sfa + $sfa; 
			$total_omega6 = $total_omega6 + $omega6; 
			$total_kolestrol = $total_kolestrol + $kolestrol; 
			$total_protein = $total_protein + $protein;
			$total_air = $total_air + $air;
			// total mineral
			$total_ca = $total_ca + $ca; 
			$total_mg = $total_mg + $mg; 
			$total_k = $total_k + $k; 
			$total_zink = $total_zink + $zink;
			$total_p = $total_p + $p; 
			$total_na = $total_na + $na; 
			$total_naci = $total_naci + $naci; 
			$total_energi = $total_energi + $energi;
			$total_fosfor = $total_fosfor + $fosfor; 
			$total_mn = $total_mn + $mn; 
			$total_cr = $total_cr + $cr; 
			$total_fe = $total_fe + $fe;
			// total vitamin
			$total_vitA = $total_vitA + $vitA;
			$total_vitB1 = $total_vitB1 + $vitB1;
			$total_vitB2 = $total_vitB2 + $vitB2;
			$total_vitB3 = $total_vitB3 + $vitB3;
			$total_vitB5 = $total_vitB5 + $vitB5;
			$total_vitB6 = $total_vitB6 + $vitB6;
			$total_vitB12 = $total_vitB12 + $vitB12;
			$total_vitC = $total_vitC + $vitC;
			$total_vitD = $total_vitD + $vitD;
			$total_vitE = $total_vitE + $vitE;
			$total_vitK = $total_vitK + $vitK;
			$total_folat = $total_folat + $folat;
			$total_biotin = $total_biotin + $biotin;
			$total_kolin = $total_kolin + $kolin;
			// total asam amino
			$total_l_glutamine =$total_l_glutamine + $l_glutamine;
			$total_threonin = $total_threonin + $threonin;
			$total_methionin = $total_methionin + $methionin;
			$total_phenilalanin = $total_phenilalanin + $phenilalanin;
			$total_histidin = $total_histidin + $histidin;
			$total_lisin = $total_lisin + $lisin;
			$total_BCAA = $total_BCAA + $BCAA;
			$total_valin = $total_valin + $valin;
			$total_leusin = $total_leusin + $leusin;
			$total_aspartat = $total_aspartat + $aspartat;
			$total_alanin = $total_alanin + $alanin;
			$total_sistein = $total_sistein + $sistein;
			$total_serin = $total_serin + $serin;
			$total_glisin = $total_glisin + $glisin;
			$total_glutamat = $total_glutamat + $glutamat;
			$total_tyrosin = $total_tyrosin + $tyrosin;
			$total_proline = $total_proline + $proline;
			$total_arginine = $total_arginine + $arginine;
			$total_Isoleusin = $total_Isoleusin + $Isoleusin;

			// total harga
            $total_harga_per_gram = $total_harga_per_gram + $hpg;
            $total_harga_per_serving = $total_harga_per_serving + $harga_per_serving;
            $total_harga_per_batch = $total_harga_per_batch + $harga_per_batch;
            $total_harga_per_kg = $total_harga_per_kg + $harga_per_kg;
			// total berat
            $total_berat_per_serving = $total_berat_per_serving + $berat_per_serving;
            $total_berat_per_batch = $total_berat_per_batch + $berat_per_batch;
            $total_berat_per_kg = $total_berat_per_kg + $berat_per_kg;
        }

        $total_harga = collect([
			'total_karbohidrat' => $total_karbohidrat,
			'total_glukosa' => $total_glukosa, 
			'total_serat' => $total_serat,
			'total_beta' => $total_beta,
			'total_sorbitol' => $total_sorbitol, 
			'total_maltitol' => $total_maltitol,
			'total_laktosa' => $total_laktosa,
			'total_sukrosa' => $total_sukrosa,
			'total_gula' => $total_gula,
			'total_erythritol' => $total_erythritol,
			'total_dha' => $total_dha, 
			'total_epa' => $total_epa,
			'total_omega3' => $total_omega3, 
			'total_mufa' => $total_mufa, 
			'total_lemak_trans' => $total_lemak_trans,
			'total_lemak_jenuh' => $total_lemak_jenuh,
			'total_sfa' => $total_sfa, 
			'total_omega6' => $total_omega6,
			'total_kolestrol' => $total_kolestrol, 
			'total_protein' => $total_protein,
			'total_air' => $total_air,
			// total mineral
			'total_ca' => $total_ca, 
			'total_mg' => $total_mg, 
			'total_k' => $total_k, 
			'total_zink' => $total_zink,
			'total_p' => $total_p, 
			'total_na' => $total_na, 
			'total_naci' => $total_naci, 
			'total_energi' => $total_energi,
			'total_fosfor' => $total_fosfor, 
			'total_mn' => $total_mn, 
			'total_cr' => $total_cr, 
			'total_fe' => $total_fe,
			// total vitamin
			'total_vitA' => $total_vitA,
			'total_vitB1' => $total_vitB1,
			'total_vitB2' => $total_vitB2,
			'total_vitB3' => $total_vitB3,
			'total_vitB5' => $total_vitB5,
			'total_vitB6' => $total_vitB6,
			'total_vitB12' => $total_vitB12,
			'total_vitC' => $total_vitC,
			'total_vitD' => $total_vitD,
			'total_vitE' => $total_vitE,
			'total_vitK' => $total_vitK,
			'total_folat' => $total_folat,
			'total_biotin' => $total_biotin,
			'total_kolin' => $total_kolin,
			// total asam amino
			'total_l_glutamine' =>$total_l_glutamine,
			'total_threonin' => $total_threonin,
			'total_methionin' => $total_methionin,
			'total_phenilalanin' => $total_phenilalanin,
			'total_histidin' => $total_histidin,
			'total_lisin' => $total_lisin,
			'total_BCAA' => $total_BCAA,
			'total_valin' => $total_valin,
			'total_leusin' => $total_leusin,
			'total_aspartat' => $total_aspartat,
			'total_alanin' => $total_alanin,
			'total_sistein' => $total_sistein,
			'total_serin' => $total_serin,
			'total_glisin' => $total_glisin,
			'total_glutamat' => $total_glutamat,
			'total_tyrosin' => $total_tyrosin,
			'total_proline' => $total_proline,
			'total_arginine' => $total_arginine,
			'total_Isoleusin' => $total_Isoleusin,

            'total_harga_per_gram' => $total_harga_per_gram,
            'total_berat_per_serving' => $total_berat_per_serving,
            'total_persen' => 100,
            'total_harga_per_serving' => $total_harga_per_serving,
            'total_berat_per_batch' => $total_berat_per_batch,
            'total_harga_per_batch' => $total_harga_per_batch,
            'total_berat_per_kg' => $total_berat_per_kg,
            'total_harga_per_kg' => $total_harga_per_kg,                       
		]);
        
        return view('devwb/detailformula', compact(
        'data','id'  ))->with([
            'idf' => $idf,
			'ada'     => $ada,
			'file' => $file,
			'hfile' => $hfile,
            'formula' => $formula,
            'detail_formula' =>  $detail_formula,
            'granulasi' => $granulasi,
			'gp' => $gp,
			'panel' => $panel,
			'carryover' => $btp,
			'storage' => $storage,
			'akg' => $akg,
			'idfor' => $idfor,
			'ingredient' => $ingredient,
			'allergen_bb' => $allergen_bb,
            'detail_harga' => $detail_harga,
            'total_harga' => $total_harga
		]);
	}

	public function uploadfile(Request $request,$id){
		$data = $request->file('filename');
		$nama = $data->getClientOriginalName();
	
		$project = pkp_project::where('id_project',$id)->first();
		$project->file=$nama;
		$project->save();

		$tujuan_upload = 'data_file';
		$data->move($tujuan_upload,$data->getClientOriginalName());
		
		return redirect::back();
	}

	public function hapus_upload($id){
		$project = pkp_project::where('id_project',$id)->first();
		$project->file=NULL;
		$project->save();
		return redirect::back();
	}

	public function uploadfile_pdf(Request $request,$id){
		$data = $request->file('filename');
		$nama = $data->getClientOriginalName();
	
		$project = project_pdf::where('id_project_pdf',$id)->first();
		$project->file=$nama;
		$project->save();

		$tujuan_upload = 'data_file';
		$data->move($tujuan_upload,$data->getClientOriginalName());
		
		return redirect::back();
	}

	public function hapus_upload_pdf($id){
		$project = project_pdf::where('id_project_pdf',$id)->first();
		$project->file=NULL;
		$project->save();
		return redirect::back();
	}
}