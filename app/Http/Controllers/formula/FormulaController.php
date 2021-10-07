<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\PkpProject;
use App\model\pdf\ProjectPDF;
use App\model\nutfact\MakroBB;
use App\model\nutfact\BtpBB;
use App\model\nutfact\MineralBB;
use App\model\nutfact\VitaminBB;
use App\model\nutfact\AsamAminoBB;
use App\model\nutfact\LogamBB;
use App\model\nutfact\MikroBB;
use App\model\nutfact\CemaranCeklis;
use App\model\nutfact\AllergenFormula;
use App\model\nutfact\Akg;
use App\model\formula\hasilpanel;
use App\model\formula\Overage;
use App\model\formula\storage;
use App\model\formula\Formula;
use App\model\formula\DataFormula;
use App\model\formula\Fortail;
use App\model\formula\HeaderFormula;
use App\model\formula\Bahan;
use App\model\master\Curren;
use Auth;
use DB;
use Redirect;

class FormulaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk' || 'rule:kemas');
    }
    
    public function new(Request $request){     
        $formulas = new Formula;
        $formulas->workbook_id 	   = $request->workbook_id;
        $formulas->workbook_pdf_id = $request->workbook_pdf_id;
        $formulas->formula 		   = $request->formula;
		$formulas->serving_size    = $request->target_serving;
		$formulas->satuan		   = $request->satuan;
		$formulas->tgl_create	   = $request->last;
		$formulas->akg			   = $request->akg;
		$formulas->overage		   = '100';
		$formulas->berat_jenis	   = $request->berat_jenis;
		if($request->kategori_formula!=NULL){
			$formulas->kategori=$request->kategori_formula;
		}else{
			$formulas->kategori='fg';
		}
        $formulas->versi = 1;   
		$formulas->save();
		
        $overage = new HeaderFormula;
        $overage->id_formula=$formulas->id;
		$overage->save();
		
        $header = new Overage;
        $header->id_formula=$formulas->id;
		$header->save();
		
		if($request->workbook_id!=NULL){
			$pkp = PkpProject::where('id_pkp',$request->workbook_id)->get();
			foreach($pkp as $wb){
				$data ='1';
				$wb   = PkpProject::where('id_pkp',$wb->id_pkp)->update([
					'workbook' => $data,
				]);
			}
			return redirect()->route('step1',[$formulas->id,$request->pkp,$request->workbook_id])->with('status', 'Formula '.$formulas->nama_produk.' Telah Ditambahkan!');
		}else{
			$pdf = ProjectPDF::where('id_project_pdf',$request->workbook_pdf_id)->first();
			$pdf->workbook='1';
			$pdf->save();
			return redirect()->route('step1_pdf',[$formulas->id,$request->workbook_pdf_id])->with('status', 'Formula '.$formulas->nama_produk.' Telah Ditambahkan!');
		}
        
    }

    public function deleteformula($id){
		$formula  = Formula::where('id',$id)->first();
		$allergen = AllergenFormula::where('id_formula',$id)->delete();
        $fortails = Fortail::where('formula_id',$id)->delete();
        $formula->delete();
		
		$panel = hasilpanel::where('id_formula',$id)->count();
		if($panel>='1'){
			$panel1 = hasilpanel::where('id_formula',$id)->delete();
		}

		$storage = storage::where('id_formula',$id)->count();
		if($storage>='1'){
			$storage1 = storage::where('id_formula',$id)->delete();
		}
		
		if($formula->workbook_id!=NULL){
			$pkp_hitung = PkpProject::where('id_pkp',$formula->workbook_id)->max('workbook')-1;
			$pkp		= PkpProject::where('id_pkp',$formula->workbook_id)->get();
			foreach($pkp as $wb){
				$wb = PkpProject::where('id_pkp',$wb->id_pkp)->update([
					'workbook' => $pkp_hitung,
				]);
			}
		}
		if($formula->workbook_pdf_id!=NULL){
			$pdf_hitung = ProjectPDF::where('id_project_pdf',$formula->workbook_pdf_id)->max('workbook')-1;
			$pdf 		= ProjectPDF::where('id_project_pdf',$formula->workbook_pdf_id)->first();
			$pdf->workbook=$pdf_hitung;
			$pdf->save();
		}

        return Redirect::back()->with('error', 'Formula Versi '.$formula->versi.'.'.$formula->turunan.' Telah Dihapus!');
    }

	public function detail($for,$id,$pro){
		$file 		= DataFormula::where('id_formula',$for)->get();
		$form 		= HeaderFormula::where('id_formula',$for)->get();
		$data 		= Formula::with('Workbook')->where('id',$for)->get();
		$hfile 		= DataFormula::where('id_formula',$id)->count();
		$ceklis 	= CemaranCeklis::all();
		$akg 		= Akg::join('tr_formulas','tr_formulas.akg','ms_akg.id_tarkon')->join('tr_overage_inngradient','tr_overage_inngradient.id_formula','tr_formulas.id')->where('id',$for)->get();
        $idf 		= $for;
		$id			= $id;
		$pro		= $pro;
		$panel 		= hasilpanel::where('id_formula',$for)->get();
		$storage 	= storage::where('id_formula',$for)->get();
		$formula 	= Formula::where('id',$for)->join('tr_overage_inngradient','tr_overage_inngradient.id_formula','tr_formulas.id')->first();
		$pkp 		= PkpProject::where('id_pkp',$formula->workbook_id)->first();
        $idfor 		= $formula->workbook_id;
        $idfor_pdf  = $formula->workbook_pdf_id;
        $fortails 	= Fortail::where('formula_id',$for)->get();
        $ingredient = DB::table('tr_fortails')->where('tr_fortails.formula_id',$for)->orderBy('per_batch','desc')->get();
		$ada 		= Fortail::where('formula_id',$for)->count();
		
		$btp 		= BtpBB::all();
		$allergen_bb= AllergenFormula::join('tr_bb_allergen','id_bb','tr_allergen_formula.id_bahan')->where('id_formula',$for)->where('allergen_countain','!=','')->select(['allergen_countain'])->distinct()->get();
		$bb_allergen= AllergenFormula::join('tr_bb_allergen','id_bb','tr_allergen_formula.id_bahan')->where('id_formula',$for)->where('allergen_countain','!=','')->get();
        if($ada < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.' Masih Kosong');
        }elseif($formula->note_formula == Null){
            return Redirect::back()->with('error','Note Formula untuk versi '.$formula->versi.'.'.$formula->turunan.' Masih Kosong');
		}

        $detail_formula	= collect();  
        $granulasi		= 0; 		 $jumlah_granulasi= 0; 	$premix= 0;
        $jumlah_premix	= 0; 		 $biasa= 0;
        foreach($fortails as $fortail){
			// Get Persen
			$one_persen = $fortail->per_serving / $formula->serving ;
			$persen 	= $one_persen * 100;
			$persen 	= round($persen, 2);
            $detail_formula->push([
                'id' 			=> $fortail->id,
                'kode_oracle' 	=> $fortail->kode_oracle,
                'nama_sederhana'=> $fortail->nama_sederhana,
                'alternatif1' 	=> $fortail->alternatif1,
                'alternatif2' 	=> $fortail->alternatif2,
                'alternatif3' 	=> $fortail->alternatif3,
                'alternatif4' 	=> $fortail->alternatif4,
                'alternatif5' 	=> $fortail->alternatif5,
                'alternatif6' 	=> $fortail->alternatif6,
                'alternatif7' 	=> $fortail->alternatif7,
                'nama_bahan' 	=> $fortail->nama_bahan,
                'nama_bahan1'	=> $fortail->nama_bahan1,
                'nama_bahan2'	=> $fortail->nama_bahan2,
                'nama_bahan3'	=> $fortail->nama_bahan3,
                'nama_bahan4'	=> $fortail->nama_bahan4,
                'nama_bahan5'	=> $fortail->nama_bahan5,
                'nama_bahan6'	=> $fortail->nama_bahan6,
				'nama_bahan7'	=> $fortail->nama_bahan7,
				'principle' 	=> $fortail->principle,
				'principle1' 	=> $fortail->principle1,
				'principle2' 	=> $fortail->principle2,
				'principle3' 	=> $fortail->principle3,
				'principle4' 	=> $fortail->principle4,
				'principle5' 	=> $fortail->principle5,
				'principle6' 	=> $fortail->principle6,
				'principle7' 	=> $fortail->principle7,
                'per_batch' 	=> $fortail->per_batch,
                'per_serving' 	=> $fortail->per_serving,
                'granulasi' 	=> $fortail->granulasi,
                'premix' 		=> $fortail->premix,
                'persen' 		=> $persen,
			]);         
			
            if($fortail->granulasi == 'ya'){
                $granulasi 		  = $granulasi + 1;
                $jumlah_granulasi = $jumlah_granulasi + $fortail->per_batch;
			}
			if($fortail->premix == 'ya'){
                $premix 	= $premix + 1;
                $jumlah_premix = $jumlah_premix + $fortail->per_batch;
            }
        }

        $biasa = $ada - $granulasi;
        $gp    = $jumlah_granulasi / $one_persen; $gp = round($gp , 2);
        $pr    = $jumlah_premix / $one_persen; $gp = round($gp , 2);

        // Tampil Harga Bahan Baku
        $detail_harga = collect();
        $satu_persen  = $formula->serving / 100;
		// Inisialisasi Total
		// total makro

		$total_karbohidrat 	= 0; $total_glukosa 	= 0; $total_serat	 	= 0; $total_beta 		= 0;
		$total_sorbitol 	= 0; $total_maltitol 	= 0; $total_laktosa 	= 0; $total_sukrosa 	= 0;
		$total_gula 		= 0; $total_erythritol	= 0; $total_dha 		= 0; $total_epa			= 0;
		$total_omega3 		= 0; $total_mufa 		= 0; $total_lemak_total	= 0; $total_lemak_jenuh = 0;
		$total_sfa 			= 0; $total_omega6 		= 0; $total_kolestrol 	= 0; $total_protein		= 0;
		$total_omega9 		= 0; $total_linoleat	= 0; $total_fat 		= 0; $total_air 		= 0;

		// total mineral
		$total_ca		= 0; $total_mg = 0; $total_k 	= 0; $total_zink 	= 0;
		$total_p		= 0; $total_na = 0; $total_naci = 0; $total_energi 	= 0;
		$total_fosfor	= 0; $total_mn = 0; $total_cr 	= 0; $total_fe 		= 0;
		// total vitamin
		$total_vitA 	= 0; $total_vitB1 = 0; $total_vitB2  = 0; $total_vitB3 = 0;
		$total_vitB5	= 0; $total_vitB6 = 0; $total_vitB12 = 0; $total_vitC  = 0;
		$total_vitD 	= 0; $total_vitE  = 0; $total_vitK   = 0; $total_folat = 0;
		$total_biotin 	= 0; $total_kolin = 0;
		// total asam amino
		$total_l_glutamine 	= 0; $total_threonin = 0; $total_methionin	= 0; $total_phenilalanin = 0;
		$total_histidin 	= 0; $total_lisin 	 = 0; $total_BCAA 		= 0; $total_valin 		 = 0;
		$total_leusin 		= 0; $total_aspartat = 0; $total_alanin 	= 0; $total_sistein		 = 0;
		$total_serin 		= 0; $total_glisin 	 = 0; $total_glutamat 	= 0; $total_tyrosin		 = 0;
		$total_proline 		= 0; $total_arginine = 0; $total_Isoleusin	= 0;
		// total logam
		$total_as 	  = 0;	$total_hg 	  = 0; $total_pb 	 = 0;	$total_sn 	  = 0; $total_cd 	 = 0;
		$total_rpc_as = 0;	$total_rpc_hg = 0; $total_rpc_pb = 0;	$total_rpc_sn = 0; $total_rpc_cd = 0;
		// total mikto
		$total_Enterobacter = 0; $total_Yeast 		   = 0;
		$total_Salmonella 	= 0; $total_Coliform 	   = 0;
		$total_aureus 		= 0; $total_Coli 		   = 0;
		$total_TPC 			= 0; $total_Bacilluscereus = 0;
		// berat
        $total_berat_per_serving = 0; $total_berat_per_batch   = 0; $total_berat_per_kg = 0;
		// harga
        $total_harga_per_batch 	 = 0; $total_harga_per_serving = 0; $total_harga_per_kg = 0; $total_harga_per_gram = 0;

        $no = 0;
        foreach($fortails as $fortail){
			//Get Needed
			$mineral 	= MineralBB::where('id_bahan',$fortail->bahan_id)->first();
			$makro	 	= MakroBB::where('id_bahan',$fortail->bahan_id)->first();
			$asam 	 	= AsamAminoBB::where('id_bahan',$fortail->bahan_id)->first();
			$vitamin 	= VitaminBB::where('id_bahan',$fortail->bahan_id)->first();
			$mikro	 	= MikroBB::where('id_bahan',$fortail->bahan_id)->first();
			$logam 	 	= LogamBB::where('id_bahan',$fortail->bahan_id)->first();
            $bahan   	= Bahan::where('id',$fortail->bahan_id)->first();
			$hitung_btp = BtpBB::where('id_bahan',$fortail->bahan_id)->count();
			$curren 	= Curren::where('id',$bahan->curren_id)->first();
            $persen	 	= $fortail->per_serving / $satu_persen; $persen = round($persen,2);
            //perhitungan nutfact bayangan
			if($fortail->nama_sederhana != 'NULL'){
				// makro
				$karbohidrat =($makro->karbohidrat/100)*($fortail->per_serving);	$glukosa 	 = ($makro->glukosa/100)*($fortail->per_serving);
				$serat 		 = ($makro->serat_pangan/100)*($fortail->per_serving);	$beta 		 = ($makro->beta_glucan/100)*($fortail->per_serving);
				$sorbitol 	 = ($makro->sorbitol/100)*($fortail->per_serving);		$maltitol 	 = ($makro->maltitol/100)*($fortail->per_serving);
				$laktosa 	 = ($makro->laktosa/100)*($fortail->per_serving);		$sukrosa 	 = ($makro->sukrosa/100)*($fortail->per_serving);
				$gula 		 = ($makro->gula/100)*($fortail->per_serving);			$erythritol  = ($makro->erythritol /100)*($fortail->per_serving);
				$dha 		 = ($makro->DHA/100)*($fortail->per_serving);			$epa 	 	 = ($makro->EPA/100)*($fortail->per_serving);
				$omega3 	 = ($makro->Omega3/100)*($fortail->per_serving);		$mufa 	 	 = ($makro->MUFA/100)*($fortail->per_serving);
				$lemak_trans = ($makro->lemak_trans/100)*($fortail->per_serving);	$lemak_jenuh = ($makro->lemak_jenuh/100)*($fortail->per_serving);
				$sfa 		 = ($makro->SFA/100)*($fortail->per_serving);			$omega6 	 = ($makro->omega6/100)*($fortail->per_serving);
				$omega9 	 = ($makro->omega9/100)*($fortail->per_serving);		$linoleat 	 = ($makro->linoleat/100)*($fortail->per_serving);
				$kolestrol 	 = ($makro->kolesterol/100)*($fortail->per_serving);	$protein 	 = ($makro->protein/100)*($fortail->per_serving);
				$fat 		 = ($makro->fat)*($persen/100);							$air 		 = ($makro->air)*($persen/100);
				// mineral
				$ca 	= ($mineral->ca/100)*($fortail->per_serving);				$mg 	= ($mineral->mg/100)*($fortail->per_serving);
				$k 		= ($mineral->k/100)*($fortail->per_serving);				$zink	= ($mineral->zink/100)*($fortail->per_serving);
				$p 		= ($mineral->p/100)*($fortail->per_serving);				$na	 	= ($mineral->na/100)*($fortail->per_serving);
				$naci 	= ($mineral->naci/100)*($fortail->per_serving);				$energi = ($mineral->energi/100)*($fortail->per_serving);
				$fosfor = ($mineral->fosfor/100)*($fortail->per_serving);			$mn 	= ($mineral->mn/100)*($fortail->per_serving);
				$cr 	= ($mineral->cr/100)*($fortail->per_serving);				$fe 	= ($mineral->fe/100)*($fortail->per_serving);
				// vitamin
				$vitA 	= ($vitamin->vitA/100)*($fortail->per_serving);  			$vitB1 = ($vitamin->vitB1/100)*($fortail->per_serving);
				$vitB2	= ($vitamin->vitB2/100)*($fortail->per_serving); 			$vitB3 = ($vitamin->vitB3/100)*($fortail->per_serving);
				$vitB5  = ($vitamin->vitB5/100)*($fortail->per_serving); 			$vitB6 = ($vitamin->vitB6/100)*($fortail->per_serving);
				$vitB12 = ($vitamin->vitB12/100)*($fortail->per_serving); 			$vitC  = ($vitamin->vitC/100)*($fortail->per_serving);
				$vitD 	= ($vitamin->vitD/100)*($fortail->per_serving); 			$vitE  = ($vitamin->vitE/100)*($fortail->per_serving);
				$vitK 	= ($vitamin->vitK/100)*($fortail->per_serving); 			$folat = ($vitamin->folat/100)*($fortail->per_serving);
				$biotin = ($vitamin->biotin/100)*($fortail->per_serving); 			$kolin = ($vitamin->kolin/100)*($fortail->per_serving);
				//asam amino
				$l_glutamine = ($asam->l_glutamin/100)*($fortail->per_serving);     $threonin = ($asam->Threonin/100)*($fortail->per_serving);
				$methionin 	 = ($asam->Methionin/100)*($fortail->per_serving);      $phenilalanin = ($asam->Phenilalanin/100)*($fortail->per_serving);
				$histidin 	 = ($asam->Histidin/100)*($fortail->per_serving);      	$lisin = ($asam->lisin/100)*($fortail->per_serving);
				$BCAA 	 	 = ($asam->BCAA/100)*($fortail->per_serving);           $valin = ($asam->Valin/100)*($fortail->per_serving);
				$leusin 	 = ($asam->Leusin/100)*($fortail->per_serving);         $aspartat = ($asam->Aspartat/100)*($fortail->per_serving);           
				$alanin 	 = ($asam->Alanine/100)*($fortail->per_serving);        $sistein = ($asam->Sistein/100)*($fortail->per_serving);
				$serin 	 	 = ($asam->Serin/100)*($fortail->per_serving);          $glisin = ($asam->Glisin/100)*($fortail->per_serving);
				$glutamat 	 = ($asam->Glutamat/100)*($fortail->per_serving);       $tyrosin = ($asam->Tyrosin/100)*($fortail->per_serving);
				$proline 	 = ($asam->Proline/100)*($fortail->per_serving);        $arginine = ($asam->Arginine/100)*($fortail->per_serving);
				$Isoleusin 	 = ($asam->Isoleusin/100)*($fortail->per_serving);
				// Logam
				$as = ($logam->As)*($persen/100);			 						$pb = ($logam->pb)*($persen/100);
				$hg = ($logam->hg)*($persen/100);									$cd = ($logam->cd)*($persen/100);
				$sn = ($logam->sn)*($persen/100);			
				// mikro

				$Enterobacter = ($mikro->Enterobacter)*($persen/100); 				$Salmonella 	= ($mikro->Salmonella)*($persen/100); 
				$aureus 	  = ($mikro->aureus)*($persen/100);					 	$TPC 			= ($mikro->TPC)*($persen/100); 
				$Yeast 	  	  = ($mikro->Yeast)*($persen/100);					  	$Coliform 		= ($mikro->Coliform)*($persen/100); 
				$Coli 	  	  = ($mikro->Coli)*($persen/100);					  	$Bacilluscereus = ($mikro->Bacilluscereus)*($persen/100); 
			}

            // Harga Pergram
			if($bahan->satuan=='Kg'){
				$hpg = ($bahan->harga_satuan * $curren->harga)/1000; $hpg = round($hpg,2); 
			}elseif($bahan->satuan=='Mg'){
				$hpg = ($bahan->harga_satuan * $curren->harga)/0.001; $hpg = round($hpg,2); 
			}elseif($bahan->satuan=='G'){
				$hpg = ($bahan->harga_satuan * $curren->harga); $hpg = round($hpg,2); 
			}
            // PerServing
            $berat_per_serving = $fortail->per_serving; 
			$berat_per_serving = round($berat_per_serving,5);
            $persen 		   = $fortail->per_serving / $satu_persen; 
			$persen 		   = round($persen,2);
            $harga_per_serving = $berat_per_serving * $hpg; 
			$harga_per_serving = round($harga_per_serving,2);
            // Per Batch
            $berat_per_batch = $fortail->per_batch; 
			$berat_per_batch = round($berat_per_batch,5);
            $harga_per_batch = $berat_per_batch * $hpg; 
			$harga_per_batch = round($harga_per_batch,2);
            // Per Kg
            $berat_per_kg = (1000 * $berat_per_serving) / $formula->serving; 
			$berat_per_kg = round($berat_per_kg,5);
            $harga_per_kg = $bahan->harga_satuan; 
			$harga_per_kg = round($harga_per_kg,2);         
            $detail_harga->push([
				// data

				'no' 		  => ++$no,  			'kode_oracle' 	 	=> $bahan->kode_oracle,
                'id' 		  => $fortail->id,		'nama_sederhana' 	=> $bahan->nama_sederhana,
				'bahan' 	  => $bahan->id,		'hitung_btp' 	 	=> $hitung_btp,
				'hpg' 		  => $hpg,				'id_ingeradient' 	=> $bahan->id_ingeradient,
				//makro
				'karbohidrat' => $karbohidrat, 		'glukosa' 			 => $glukosa ,
				'serat' 	  => $serat ,           'beta' 	  			 => $beta,
				'sorbitol' 	  => $sorbitol ,      	'maltitol' 			 => $maltitol ,
				'laktosa' 	  => $laktosa ,      	'sukrosa' 			 => $sukrosa,
				'gula' 	  	  => $gula ,            'erythritol'		 => $erythritol  ,
				'dha' 	  	  => $dha ,             'epa' 				 => $epa,
				'omega3' 	  => $omega3 ,          'mufa' 				 => $mufa ,
				'lemak_trans' => $lemak_trans ,		'lemak_jenuh' 		 => $lemak_jenuh,
				'sfa' 		  => $sfa ,             'omega6' 			 => $omega6 ,
				'linoleat'    => $linoleat ,        'omega9' 			 => $omega9 ,
				'kolestrol'   => $kolestrol ,    	'protein' 			 => $protein,
				'fat' 		  => $fat,				'air' 				 => $air,

				//mineral
				'ca' 		  => $ca ,       		'mg' 				 => $mg ,
				'k' 		  => $k ,         		'zink' 				 => $zink,
				'p' 		  => $p ,         		'na'				 => $na ,
				'naci' 		  => $naci ,   			'energi'			 => $energi,
				'fosfor' 	  => $fosfor, 			'mn' 				 => $mn ,
				'cr'	 	  => $cr ,       		'fe' 				 => $fe,
				//vitamin
				'vitA' 		  => $vitA ,   			'vitB1' 			 => $vitB1 ,
				'vitB2' 	  => $vitB2 ,  			'vitB3' 			 => $vitB3,
				'vitB5' 	  => $vitB5 ,  			'vitB6' 			 => $vitB6 ,
				'vitB12' 	  => $vitB12, 			'vitC' 				 => $vitC,
				'vitD' 		  => $vitD ,   			'vitE' 				 => $vitE ,
				'vitK' 		  => $vitK ,   			'folat' 			 => $folat,
				'biotin' 	  => $biotin, 			'kolin' 			 => $kolin,
				//asam amino
				'l_glutamine' => $l_glutamine ,   	'threonin' 		 	=> $threonin ,
				'methionin'   => $methionin ,     	'phenilalanin' 	 	=> $phenilalanin,
				'histidin' 	  => $histidin ,      	'lisin' 		 	=> $lisin ,
				'BCAA' 		  => $BCAA ,          	'valin' 		 	=> $valin,
				'leusin' 	  => $leusin ,        	'sistein' 		 	=> $sistein ,
				'aspartat' 	  => $aspartat ,      	'alanin' 		 	=> $alanin,
				'serin' 	  => $serin ,         	'glisin' 		 	=> $glisin,
				'glutamat' 	  => $glutamat ,      	'tyrosin' 		 	=> $tyrosin ,
				'arginine' 	  => $arginine ,      	'proline' 		 	=> $proline,
				'Isoleusin'   => $Isoleusin ,   
				// Logam
				'as' 		  => $as, 				 'hg' 			 	=> $hg,
				'sn' 		  => $sn, 				 'pb' 			 	=> $pb,
				'cd' 		  => $cd, 
				// Mikro
				'Enterobacter'=> $Enterobacter, 	'Yeast' 		 	=> $Yeast,
				'Salmonella'  => $Salmonella,		'Coliform' 		 	=> $Coliform,
				'aureus' 	  => $aureus,			'Coli'	  		 	=> $Coli,
				'TPC'         => $TPC,				'Bacilluscereus' 	=> $Bacilluscereus,
				// data
                'persen' 	  => $persen,           'per_serving' 	 	=>  $berat_per_serving,
                'per_batch'	  => $berat_per_batch,  'harga_per_serving' => $harga_per_serving,
                'per_kg' 	  => $berat_per_kg,     'harga_per_batch'	=> $harga_per_batch,
                'harga_per_kg'=> $harga_per_kg
			]);

			// total makro
			$total_karbohidrat = $total_karbohidrat+$karbohidrat; 	$total_glukosa 		= $total_glukosa + $glukosa; 
			$total_serat	   = $total_serat + $serat; 			$total_beta 		= $total_beta + $beta;
			$total_sorbitol	   = $total_sorbitol + $sorbitol; 		$total_maltitol 	= $total_maltitol + $maltitol;
			$total_laktosa	   = $total_laktosa + $laktosa; 		$total_sukrosa 		= $total_sukrosa + $sukrosa;
			$total_gula 	   = $total_gula + $gula;				$total_erythritol 	= $total_erythritol + $erythritol;
			$total_dha 		   = $total_dha + $dha; 				$total_epa 			= $total_epa + $epa;
			$total_omega3 	   = $total_omega3 + $omega3; 			$total_mufa 		= $total_mufa + $mufa; 
			$total_lemak_total = $total_lemak_total + $lemak_trans; $total_lemak_jenuh	= $total_lemak_jenuh + $lemak_jenuh;
			$total_sfa 		   = $total_sfa + $sfa; 				$total_omega6 		= $total_omega6 + $omega6; 
			$total_omega9 	   = $total_omega9 + $omega9; 			$total_linoleat 	= $total_linoleat + $linoleat; 
			$total_kolestrol   = $total_kolestrol + $kolestrol; 	$total_protein 		= $total_protein + $protein;
			$total_fat 		   = $total_fat + $fat;					$total_air 			= $total_air + $air;
			// total mineral
			$total_ca 		   = $total_ca + $ca; 					$total_mg 			= $total_mg + $mg; 
			$total_k 		   = $total_k + $k; 					$total_zink 		= $total_zink + $zink;
			$total_p 		   = $total_p + $p; 					$total_na 			= $total_na + $na; 
			$total_naci 	   = $total_naci + $naci; 				$total_energi		= $total_energi + $energi;
			$total_fosfor 	   = $total_fosfor + $fosfor; 			$total_mn 			= $total_mn + $mn; 
			$total_cr 	   	   = $total_cr + $cr; 					$total_fe 			= $total_fe + $fe;
			// total vitamin
			$total_vitA 	   = $total_vitA + $vitA;				$total_vitB1 		= $total_vitB1 + $vitB1;
			$total_vitB2 	   = $total_vitB2 + $vitB2;				$total_vitB3 		= $total_vitB3 + $vitB3;
			$total_vitB5 	   = $total_vitB5 + $vitB5;				$total_vitB6 		= $total_vitB6 + $vitB6;
			$total_vitB12 	   = $total_vitB12 + $vitB12;			$total_vitC  		= $total_vitC + $vitC;
			$total_vitD 	   = $total_vitD + $vitD;				$total_vitE  		= $total_vitE + $vitE;
			$total_vitK 	   = $total_vitK + $vitK;				$total_folat 		= $total_folat + $folat;
			$total_biotin 	   = $total_biotin + $biotin;			$total_kolin 		= $total_kolin + $kolin;
			// total asam amino
			$total_l_glutamine =$total_l_glutamine + $l_glutamine;	$total_threonin 	= $total_threonin + $threonin;
			$total_methionin   = $total_methionin + $methionin;		$total_phenilalanin = $total_phenilalanin + $phenilalanin;
			$total_histidin    = $total_histidin + $histidin;		$total_lisin 		= $total_lisin + $lisin;
			$total_BCAA 	   = $total_BCAA + $BCAA;				$total_valin 		= $total_valin + $valin;
			$total_leusin 	   = $total_leusin + $leusin;			$total_aspartat 	= $total_aspartat + $aspartat;
			$total_alanin 	   = $total_alanin + $alanin;			$total_sistein 		= $total_sistein + $sistein;
			$total_serin 	   = $total_serin + $serin;				$total_glisin 		= $total_glisin + $glisin;
			$total_glutamat    = $total_glutamat + $glutamat;		$total_tyrosin 		= $total_tyrosin + $tyrosin;
			$total_proline     = $total_proline + $proline;			$total_arginine 	= $total_arginine + $arginine;
			$total_Isoleusin   = $total_Isoleusin + $Isoleusin;
			// total logam
			$total_as = $total_as + $as;							$total_hg 			= $total_hg + $hg;
			$total_pb = $total_pb + $pb;							$total_sn 			= $total_sn + $sn;
			$total_cd = $total_cd + $cd;
			// Mikro
			$total_Enterobacter = $total_Enterobacter + $Enterobacter;  $total_Yeast 		  = $total_Yeast + $Yeast;
			$total_Salmonella 	= $total_Salmonella + $Salmonella	;	$total_Coliform 	  = $total_Coliform + $Coliform;
			$total_aureus 		= $total_aureus + $aureus;				$total_Coli 		  = $total_Coli + $Coli;
			$total_TPC 			= $total_TPC + $TPC;					$total_Bacilluscereus = $total_Bacilluscereus + $Bacilluscereus;
			// RPC
			$total_rpc_as = $total_as * ($formula->serving_size/1000) / ($formula->serving_size + $formula->saran_saji / 1000);
			$total_rpc_hg = $total_hg * ($formula->serving_size/1000) / ($formula->serving_size + $formula->saran_saji / 1000);
			$total_rpc_pb = $total_pb * ($formula->serving_size/1000) / ($formula->serving_size + $formula->saran_saji / 1000);							
			$total_rpc_sn = $total_sn * ($formula->serving_size/1000) / ($formula->serving_size + $formula->saran_saji / 1000);
			$total_rpc_cd = $total_cd * ($formula->serving_size/1000) / ($formula->serving_size + $formula->saran_saji / 1000);
			// total harga
            $total_harga_per_gram 	 = $total_harga_per_gram + $hpg;
            $total_harga_per_serving = $total_harga_per_serving + $harga_per_serving;
            $total_harga_per_batch   = $total_harga_per_batch + $harga_per_batch;
            $total_harga_per_kg 	 = $total_harga_per_kg + $harga_per_kg;
			// total berat
            $total_berat_per_serving = $total_berat_per_serving + $berat_per_serving;
            $total_berat_per_batch   = $total_berat_per_batch + $berat_per_batch;
            $total_berat_per_kg 	 = $total_berat_per_kg + $berat_per_kg;
        }

        $total_harga = collect([
			'total_karbohidrat' => $total_karbohidrat,	'total_glukosa' 		=> $total_glukosa, 
			'total_serat'		=> $total_serat,		'total_beta' 			=> $total_beta,
			'total_sorbitol' 	=> $total_sorbitol, 	'total_maltitol' 		=> $total_maltitol,
			'total_laktosa' 	=> $total_laktosa,		'total_sukrosa' 		=> $total_sukrosa,
			'total_gula' 		=> $total_gula,			'total_erythritol' 		=> $total_erythritol,
			'total_dha' 		=> $total_dha, 			'total_epa' 			=> $total_epa,
			'total_omega3' 		=> $total_omega3, 		'total_mufa' 			=> $total_mufa, 
			'total_lemak_total' => $total_lemak_total,	'total_lemak_jenuh' 	=> $total_lemak_jenuh,
			'total_sfa' 		=> $total_sfa, 			'total_omega6' 			=> $total_omega6,
			'total_omega9' 		=> $total_omega9,		'total_linoleat' 		=> $total_linoleat,
			'total_kolestrol' 	=> $total_kolestrol, 	'total_protein' 		=> $total_protein,
			'total_air' 		=> $total_air,			'total_fat' 			=> $total_fat,
			// total mineral
			'total_ca' 			=> $total_ca, 			'total_mg' 				=> $total_mg, 
			'total_k' 			=> $total_k, 			'total_zink' 			=> $total_zink,
			'total_p' 			=> $total_p, 			'total_na' 				=> $total_na, 
			'total_naci' 		=> $total_naci, 		'total_energi' 			=> $total_energi,
			'total_fosfor' 		=> $total_fosfor, 		'total_mn' 				=> $total_mn, 
			'total_cr' 			=> $total_cr, 			'total_fe' 				=> $total_fe,
			// total vitamin	
			'total_vitA' 		=> $total_vitA,			'total_vitB1' 			=> $total_vitB1,
			'total_vitB2' 		=> $total_vitB2,		'total_vitB3' 			=> $total_vitB3,
			'total_vitB5' 		=> $total_vitB5,		'total_vitB6' 			=> $total_vitB6,
			'total_vitB12' 		=> $total_vitB12,		'total_vitC' 			=> $total_vitC,
			'total_vitD' 		=> $total_vitD,			'total_vitE' 			=> $total_vitE,
			'total_vitK' 		=> $total_vitK,			'total_folat' 			=> $total_folat,
			'total_biotin' 		=> $total_biotin,		'total_kolin' 			=> $total_kolin,
			// total asam amino	
			'total_l_glutamine' =>$total_l_glutamine,	'total_threonin' 		=> $total_threonin,
			'total_methionin'	=> $total_methionin,	'total_phenilalanin'	=> $total_phenilalanin,
			'total_histidin' 	=> $total_histidin,		'total_lisin' 			=> $total_lisin,
			'total_BCAA' 		=> $total_BCAA,			'total_valin' 			=> $total_valin,
			'total_leusin' 		=> $total_leusin,		'total_aspartat' 		=> $total_aspartat,
			'total_alanin' 		=> $total_alanin,		'total_sistein' 		=> $total_sistein,
			'total_serin' 		=> $total_serin,		'total_glisin' 			=> $total_glisin,
			'total_glutamat' 	=> $total_glutamat,		'total_tyrosin' 		=> $total_tyrosin,
			'total_proline' 	=> $total_proline,		'total_arginine' 		=> $total_arginine,
			'total_Isoleusin' 	=> $total_Isoleusin,
			// total logam
			'total_as' 			=> $total_as,			'total_hg' 				=> $total_hg,
			'total_pb' 			=> $total_pb,			'total_sn' 				=> $total_sn,
			'total_cd' 			=> $total_cd,
			// RPC
			'total_rpc_as' 		=> $total_rpc_as,		'total_rpc_hg' 			=> $total_rpc_hg,
			'total_rpc_pb' 		=> $total_rpc_pb,		'total_rpc_sn' 			=> $total_rpc_sn,
			'total_rpc_cd' 		=> $total_rpc_cd,
			// Mikro
			'total_Enterobacter'=> $total_Enterobacter,	'total_Yeast' 			=> $total_Yeast,
			'total_Salmonella' 	=> $total_Salmonella,	'total_Coliform' 		=> $total_Coliform,
			'total_aureus' 		=> $total_aureus,		'total_Coli' 			=> $total_Coli,
			'total_TPC' 		=> $total_TPC,		  	'total_Bacilluscereus' 	=> $total_Bacilluscereus,

            'total_harga_per_gram' 		=> $total_harga_per_gram,
            'total_berat_per_serving' 	=> $total_berat_per_serving,
            'total_persen' 				=> 100,
            'total_harga_per_serving' 	=> $total_harga_per_serving,
            'total_berat_per_batch' 	=> $total_berat_per_batch,
            'total_harga_per_batch' 	=> $total_harga_per_batch,
            'total_berat_per_kg' 		=> $total_berat_per_kg,
            'total_harga_per_kg' 		=> $total_harga_per_kg,                       
		]);
       
        return view('formula/detailformula', compact(
        'data','id'  ))->with([
            'idf' 			 => $idf,
            'ada'     		 => $ada,
            'formula'		 => $formula,
			'hfile' 		 => $hfile,
			'panel' 		 => $panel,
			'storage' 		 => $storage,
			'file' 			 => $file,
			'fortails' 		 => $fortails,
            'detail_formula' =>  $detail_formula,
            'granulasi' 	 => $granulasi,
			'premix' 		 => $premix,
			'pkp' 			 => $pkp,
			'ceklis' 		 => $ceklis,
			'gp' 			 => $gp,
			'form' 			 => $form,
			'akg' 			 => $akg,
			'idfor'			 => $idfor,
			'id'			 => $id,
			'pro' 			 => $pro,
			'idfor_pdf' 	 => $idfor_pdf,
			'ingredient' 	 => $ingredient,
			'allergen_bb' 	 => $allergen_bb,
			'carryover' 	 => $btp,
            'detail_harga'   => $detail_harga,
            'total_harga'    => $total_harga
		]);
	}

	public function uploadfile(Request $request,$id){
		$data = $request->file('filename');
		$nama = $data->getClientOriginalName();
	
		$project = PkpProject::where('id_project',$id)->first();
		$project->file=$nama;
		$project->save();

		$tujuan_upload = 'data_file';
		$data->move($tujuan_upload,$data->getClientOriginalName());
		
		return redirect::back();
	}

	public function hapus_upload($id){
		$project = PkpProject::where('id_project',$id)->first();
		$project->file=NULL;
		$project->save();
		return redirect::back();
	}

	public function uploadfile_pdf(Request $request,$id){
		$data = $request->file('filename');
		$nama = $data->getClientOriginalName();
	
		$project = ProjectPDF::where('id_project_pdf',$id)->first();
		$project->file=$nama;
		$project->save();

		$tujuan_upload = 'data_file';
		$data->move($tujuan_upload,$data->getClientOriginalName());
		
		return redirect::back();
	}

	public function hapus_upload_pdf($id){
		$project = ProjectPDF::where('id_project_pdf',$id)->first();
		$project->file=NULL;
		$project->save();
		return redirect::back();
	}
}
