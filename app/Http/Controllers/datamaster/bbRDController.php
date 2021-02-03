<?php

namespace App\Http\Controllers\datamaster;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\master\Satuan;
use App\model\master\tb_satuan_vit;
use App\model\master\Kategori;
use App\model\master\Curren;
use App\model\dev\Bahan;
use App\model\dev\ms_btp;
use App\model\dev\ms_zat_aktif;
use App\model\dev\ms_allergen;
use App\model\dev\tr_makro_bb;
use App\model\dev\tr_mikro_biologi_bb;
use App\model\dev\tr_mikro_bb;
use App\model\dev\tr_btp_bb;
use App\model\dev\tr_mineral_bb;
use App\model\dev\tr_vitamin_bb;
use App\model\dev\tr_asam_amino_bb;
use App\model\dev\tr_zataktif_bb;
use App\model\dev\tr_logamberat_bb;
use App\model\dev\bb_allergen;
use App\model\dev\ms_supplier_principals;
use App\model\dev\ms_supplier_principal_cps;
use App\model\pkp\pkp_datapangan;
use App\model\nutfact\tb_jenis_mikroba;
use App\model\nutfact\satuan_bpom;
use Redirect;
use DB;
use Auth;

class bbRDController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:admin' || 'rule:user_produk');
    }

    public function bahan(){
        $bahans = Bahan::where('status_bb','baru')->get();
        $satuans = Satuan::all();
        $currens = Curren::all();
        return view('datamaster.bahan_rd')->with([
            'bahans' => $bahans,
            'satuans' =>$satuans,
            'currens' => $currens
        ]);
    }

    public function addbahanrd(Request $request){
        $bahan = new Bahan;
        $bahan->nama_sederhana = $request->sederhana;
        $bahan->nama_bahan = $request->nama;
        $bahan->kode_oracle = $request->oracle;
        $bahan->kode_komputer = $request->komputer;
        $bahan->supplier = $request->supplier;
        $bahan->principle = $request->principle;
        $bahan->no_HEIPBR = $request->heipbr;
        $bahan->PIC = $request->pic;
        $bahan->id_kategori=$request->kategori;
        $bahan->subkategori_id = $request->subkategori;
        $bahan->berat = $request->berat;
        $bahan->satuan = $request->satuan;
        $bahan->harga_satuan = $request->harga;
        $bahan->curren_id = $request->currency;
        $bahan->user_id = Auth::user()->id;
        $bahan->updated_by = Auth::user()->id;
        $bahan->created_date = $request->last;
        $bahan->last_update = $request->last;
        $bahan->status = 'active';
        $bahan->status_bb = 'baru';
        $bahan->save();
        // registrasi makro bb
        $makro = new tr_makro_bb;
        $makro->id_bahan=$bahan->id;
        $makro->karbohidrat=$request->karbohidrat;
        $makro->glukosa=$request->glukosa;
        $makro->serat_pangan=$request->serat_pangan;
        $makro->beta_glucan=$request->beta_glucan;
        $makro->sorbitol=$request->sorbitol;
        $makro->maltitol=$request->maltitol;
        $makro->laktosa=$request->laktosa;
        $makro->sukrosa=$request->sukrosa;
        $makro->gula=$request->gula;
        $makro->erythritol=$request->erythritol;
        $makro->DHA=$request->dha;
        $makro->EPA=$request->epa;
        $makro->Omega3=$request->omega3;
        $makro->mufa=$request->mufa;
        $makro->lemak_trans=$request->lemak_trans;
        $makro->lemak_jenuh=$request->lemak_jenuh;
        $makro->sfa=$request->sfa;
        $makro->omega6=$request->omega6;
        $makro->omega9=$request->omega9;
        $makro->linoleat=$request->linoleat;
        $makro->kolesterol=$request->kolesterol;
        $makro->protein=$request->protein;
        $makro->kadar_air=$request->kadar_air;
        $makro->lemak=$request->lemak;
        $makro->save();
        // registrasi vitamin bb
        $vitamin = new tr_vitamin_bb;
        $vitamin->id_bahan=$bahan->id;
        $vitamin->id_satuan_vitA=$request->id_satuan_vitA;
        $vitamin->id_satuan_vitB1=$request->id_satuan_vitB1;
        $vitamin->id_satuan_vitB2=$request->id_satuan_vitB2;
        $vitamin->id_satuan_vitB3=$request->id_satuan_vitB3;
        $vitamin->id_satuan_vitB5=$request->id_satuan_vitB5;
        $vitamin->id_satuan_vitB6=$request->id_satuan_vitB6;
        $vitamin->id_satuan_vitB12=$request->id_satuan_vitB12;
        $vitamin->id_satuan_vitC=$request->id_satuan_vitC;
        $vitamin->id_satuan_vitD=$request->id_satuan_vitD;
        $vitamin->id_satuan_vitE=$request->id_satuan_vitE;
        $vitamin->id_satuan_vitK=$request->id_satuan_vitK;
        $vitamin->id_satuan_folat=$request->id_satuan_folat;
        $vitamin->id_satuan_biotin=$request->id_satuan_biotin;
        $vitamin->id_satuan_kolin=$request->id_satuan_kolin;
        $vitamin->vitA=$request->vitA;
        $vitamin->vitB1=$request->vitB1;
        $vitamin->vitB2=$request->vitB2;
        $vitamin->vitB3=$request->vitB3;
        $vitamin->vitB5=$request->vitB5;
        $vitamin->vitB6=$request->vitB6;
        $vitamin->vitB12=$request->vitB12;
        $vitamin->vitC=$request->vitC;
        $vitamin->vitD=$request->vitD;
        $vitamin->vitE=$request->vitE;
        $vitamin->vitK=$request->vitK;
        $vitamin->folat=$request->folat;
        $vitamin->biotin=$request->biotin;
        $vitamin->kolin=$request->kolin;
        $vitamin->save();
        // registrasi mineral bb
        $mineral = new tr_mineral_bb;
        $mineral->id_bahan=$bahan->id;
        $mineral->ca=$request->ca;
        $mineral->mg=$request->mg;
        $mineral->k=$request->k;
        $mineral->zink=$request->zink;
        $mineral->cu=$request->cu;
        $mineral->na=$request->na;
        $mineral->naci=$request->naci;
        $mineral->energi=$request->energi;
        $mineral->fosfor=$request->fosfor;
        $mineral->mn=$request->mn;
        $mineral->cr=$request->cr;
        $mineral->fe=$request->fe;
        $mineral->yodium=$request->yodium;
        $mineral->selenium=$request->selenium;
        $mineral->fluor=$request->fluor;
        $mineral->satuan_ca=$request->satuan_ca;
        $mineral->satuan_mg=$request->satuan_mg;
        $mineral->satuan_k=$request->satuan_k;
        $mineral->satuan_zink=$request->satuan_zink;
        $mineral->satuan_fosfor=$request->satuan_fosfor;
        $mineral->satuan_cu=$request->satuan_cu;
        $mineral->satuan_na=$request->satuan_na;
        $mineral->satuan_naci=$request->satuan_naci;
        $mineral->satuan_energi=$request->satuan_energi;
        $mineral->satuan_mn=$request->satuan_mn;
        $mineral->satuan_cr=$request->satuan_cr;
        $mineral->satuan_fe=$request->satuan_fe;
        $mineral->satuan_yodium=$request->satuan_yodium;
        $mineral->satuan_selenium=$request->satuan_selenium;
        $mineral->satuan_fluor=$request->satuan_fluor;
        $mineral->save();
        // registrasi BTP carry over bb
        if($request->satuan_btp!='' && $request->btp_carry_over!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
				$idz = implode(',', $request->input('btp_carry_over'));
				$ids = explode(',', $idz);
				$btp = implode(',', $request->input('btp'));
				$nominal_btp = explode(',', $btp);
				$idb = implode(',', $request->input('satuan_btp'));
				$idc = explode(',', $idb);
				for ($i = 0; $i < count($ids); $i++)
				{
					$btp_carryOver = new tr_btp_bb;
                    $btp_carryOver->id_bahan=$bahan->id;
                    $btp_carryOver->btp = $ids[$i];
                    $btp_carryOver->nominal = $nominal_btp[$i];
					$btp_carryOver->id_satuan = $idc[$i];
					$btp_carryOver->save();
					$i = $i++;
				}
			}
        }
        // registrasi zat aktif bb
        if($request->satuan_zat!='' && $request->zat_aktif!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
				$idz = implode(',', $request->input('zat_aktif'));
				$ids = explode(',', $idz);
				$nominal = implode(',', $request->input('zat'));
				$nominal_zat = explode(',', $nominal);
				$idb = implode(',', $request->input('satuan_zat'));
				$idc = explode(',', $idb);
				for ($i = 0; $i < count($ids); $i++)
				{
					$zat = new tr_zataktif_bb;
                    $zat->id_bahan=$bahan->id;
                    $zat->zat_aktif = $ids[$i];
                    $zat->nominal = $nominal_zat[$i];
					$zat->id_satuan = $idc[$i];
					$zat->save();
					$i = $i++;
				}
			}
        }
        // registrasi logam berat bb
        $logam = new tr_logamberat_bb;
        $logam->id_bahan=$bahan->id;
        $logam->As=$request->as;
        $logam->pb=$request->pb;
        $logam->hg=$request->hg;
        $logam->cd=$request->cd;
        $logam->sn=$request->sn;
        $logam->save();
        // registrasi asam amino bb
        $asam = new tr_asam_amino_bb;
        $asam->id_bahan=$bahan->id;
        $asam->l_glutamin=$request->l_glutamin;
        $asam->Threonin=$request->l_glutamin;
        $asam->Methionin=$request->threonin;
        $asam->Phenilalanin=$request->phenilalanin;
        $asam->Histidin=$request->histidin;
        $asam->lisin=$request->lisinin;
        $asam->BCAA=$request->bcaa;
        $asam->Valin=$request->valin;
        $asam->Leusin=$request->leusin;
        $asam->Aspartat=$request->aspartat;
        $asam->Alanin=$request->alanin;
        $asam->Sistein=$request->sistein;
        $asam->Serin=$request->serin;
        $asam->Glisin=$request->glisin;
        $asam->Glutamat=$request->glutamat;
        $asam->Tyrosin=$request->tyrosin;
        $asam->Proline=$request->proline;
        $asam->Arginine=$request->arginine;
        $asam->Isoleusin=$request->Isoleusin;
        $asam->save();
        // registrasi allergen contain bb
        if($request->contain!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
				$idz = implode(',', $request->input('contain'));
				$ids = explode(',', $idz);
				for ($i = 0; $i < count($ids); $i++)
				{
					$contain = new bb_allergen;
                    $contain->id_bb=$bahan->id;
                    $contain->allergen_countain = $ids[$i];
					$contain->save();
					$i = $i++;
				}
			}
        }
        // registrasi allergen may contain bb
        if($request->may_contain!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
				$idz = implode(',', $request->input('may_contain'));
				$ids = explode(',', $idz);
				for ($i = 0; $i < count($ids); $i++)
				{
					$mayContain = new bb_allergen;
                    $mayContain->id_bb=$bahan->id;
                    $mayContain->allergen_may_contain = $ids[$i];
					$mayContain->save();
					$i = $i++;
				}
			}
        }
        // Registrasi Mikro
        $m = new tr_mikro_bb;
        $m->id_bahan=$bahan->id;
        $m->Enterobacter=$request->Enterobacter;
        $m->Salmonella=$request->Salmonella;
        $m->aureus=$request->aureus;
        $m->TPC=$request->TPC;
        $m->Yeast=$request->Yeast;
        $m->Coliform=$request->Coliform;
        $m->Coli=$request->Coli;
        $m->Bacilluscereus=$request->Bacilluscereus;
        $m->save();

        // registrasi mikro biologi bb
        if($request->bpom!=''){
            $mikro = new tr_mikro_biologi_bb;
            $mikro->id_bahan=$bahan->id;
            $mikro->id_bpom=$request->bpom;
            $mikro->save();
        }if($request->mikro!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
				$mikro = implode(',', $request->input('mikro'));
				$data_mikro = explode(',', $mikro);
				$n = implode(',', $request->input('n'));
				$data_n = explode(',', $n);
				$c = implode(',', $request->input('c'));
				$data_c = explode(',', $c);
				$m = implode(',', $request->input('m'));
				$data_m = explode(',', $m);
				$M2 = implode(',', $request->input('M2'));
				$data_M2 = explode(',', $M2);
				$satuan_mikro = implode(',', $request->input('satuan_mikro'));
				$data_satuan_mikro = explode(',', $satuan_mikro);
				for ($i = 0; $i < count($data_mikro); $i++)
				{
					$mikro = new tr_mikro_biologi_bb;
                    $mikro->id_bahan=$bahan->id;
                    $mikro->id_jenis_mikro = $data_mikro[$i];
                    $mikro->n = $data_n[$i];
                    $mikro->c = $data_c[$i];
                    $mikro->m = $data_m[$i];
                    $mikro->M2 = $data_M2[$i];
                    $mikro->satuan = $data_satuan_mikro[$i];
					$mikro->save();
					$i = $i++;
				}
			}
        }

        return Redirect::route('bahan_rd')->with('status', $bahan->nama.' Telah Ditambahkan!');
    }

    public function registrasi(){
        $currens = Curren::all();
        $allergen = ms_allergen::all();
        $allergen2 = ms_allergen::all();
        $satuans = Satuan::all();
        $pangan = pkp_datapangan::all();
        $satuan_bpom = satuan_bpom::all();
        $zat = ms_zat_aktif::all();
        $btp = ms_btp::all();
        $supplier = ms_supplier_principals::all();
        $principal = ms_supplier_principal_cps::all();
        $btp2 = ms_btp::all();
        $kategori = Kategori::all();
        $jenis = tb_jenis_mikroba::all();
        $satuan_vit = tb_satuan_vit::all();
        return view('datamaster.registrasiBB')->with([
            'satuans' =>$satuans,
            'allergen' =>$allergen,
            'pangan' => $pangan,
            'jenis' => $jenis,
            'satuan_bpom' => $satuan_bpom,
            'btp' => $btp,
            'zat' => $zat,
            'zat1' => $zat,
            'supplier' => $supplier,
            'principal' => $principal,
            'btp2' => $btp2,
            'kategori' => $kategori,
            'allergen2' =>$allergen,
            'satuan_vit' =>$satuan_vit,
            'curren' => $currens
        ]);
    }

    public function edit_bahan($id){
        $bahan = Bahan::where('id',$id)->first();
        $makro = tr_makro_bb::where('id_bahan',$id)->get();
        $air = tr_makro_bb::where('id_bahan',$id)->get();
        $vit = tr_vitamin_bb::where('id_bahan',$id)->get();
        $mineral = tr_mineral_bb::where('id_bahan',$id)->get();
        $asam = tr_asam_amino_bb::where('id_bahan',$id)->get();
        $m = tr_mikro_bb::where('id_bahan',$id)->get();
        $currens = Curren::all();
        $satuan_bpom = satuan_bpom::all();
        $zat_aktif = ms_zat_aktif::all();
        $zat = tr_zataktif_bb::where('id_bahan',$id)->get();
        $hitung_zat = tr_zataktif_bb::where('id_bahan',$id)->count();
        $hasil_btp = tr_btp_bb::where('id_bahan',$id)->get();
        $hitung_hasil_btp = tr_btp_bb::where('id_bahan',$id)->count();
        $contain = bb_allergen::where('id_bb',$id)->where('allergen_countain','!=','NULL')->get();
        $mayContain = bb_allergen::where('id_bb',$id)->where('allergen_may_contain','!=','NULL')->get();
        $hitungmikro = tr_mikro_biologi_bb::where('id_bahan',$id)->count();
        $cekmikro = tr_mikro_biologi_bb::where('id_bahan',$id)->first();
        $mikro = tr_mikro_biologi_bb::where('id_bahan',$id)->get();
        $logam = tr_logamberat_bb::where('id_bahan',$id)->get();
        $allergen2 = ms_allergen::all();
        $satuans = Satuan::all();
        $data_pangan = pkp_datapangan::all();
        $pangan = pkp_datapangan::all();
        $btp = ms_btp::all();
        $btp2 = ms_btp::all();
        $kategori = Kategori::all();
        $jenis = tb_jenis_mikroba::all();
        $satuan_vit = tb_satuan_vit::all();
        return view('datamaster.editbb')->with([
            'satuans' =>$satuans,
            'makro' => $makro,'m' => $m,
            'hitung_zat' => $hitung_zat,
            'mayContain' => $mayContain,
            'satuan_bpom' => $satuan_bpom,
            'zat_aktif'=> $zat_aktif,
            'zat_aktif1'=> $zat_aktif,
            'hitungmikro' => $hitungmikro,
            'contain' => $contain,
            'vit' => $vit,
            'cekmikro' => $cekmikro,
            'logam' => $logam,
            'mikro' => $mikro,
            'hitung_hasil_btp' => $hitung_hasil_btp,
            'air' => $air,
            'asam' => $asam,
            'mineral' => $mineral,
            'bahan' => $bahan,
            'data_pangan' => $data_pangan,
            'pangan' => $pangan,
            'zat' => $zat,
            'hasil_btp' => $hasil_btp,
            'jenis' => $jenis,
            'btp' => $btp,
            'btp2' => $btp2,
            'kategori' => $kategori,
            'allergen2' =>$allergen2,
            'satuan_vit' =>$satuan_vit,
            'curren' => $currens
        ]);
    }

    public function saveupdateBahan(Request $request,$id_bahan){
        $bahan = Bahan::where('id',$id_bahan)->first();
        $bahan->nama_sederhana = $request->sederhana;
        $bahan->nama_bahan = $request->nama;
        $bahan->kode_oracle = $request->oracle;
        $bahan->kode_komputer = $request->komputer;
        $bahan->supplier = $request->supplier;
        $bahan->principle = $request->principle;
        $bahan->no_HEIPBR = $request->heipbr;
        $bahan->PIC = $request->pic;
        $bahan->id_kategori=$request->kategori;
        $bahan->subkategori_id = $request->subkategori;
        $bahan->berat = $request->berat;
        $bahan->satuan = $request->satuan;
        $bahan->harga_satuan = $request->harga;
        $bahan->curren_id = $request->currency;
        $bahan->updated_by = Auth::user()->id;
        $bahan->created_date = $request->last;
        $bahan->last_update = $request->last;
        $bahan->save();

        // Edit makro bb
        $hitung_mikro = tr_makro_bb::where('id_bahan',$id_bahan)->count();
        if($hitung_mikro>=1){
            $makro = tr_makro_bb::where('id_bahan',$id_bahan)->first();
        }if($hitung_mikro==0){
            $makro = new tr_makro_bb;
        }
        $makro->id_bahan=$id_bahan;
        $makro->karbohidrat=$request->karbohidrat;
        $makro->glukosa=$request->glukosa;
        $makro->serat_pangan=$request->serat_pangan;
        $makro->beta_glucan=$request->beta_glucan;
        $makro->sorbitol=$request->sorbitol;
        $makro->maltitol=$request->maltitol;
        $makro->laktosa=$request->laktosa;
        $makro->sukrosa=$request->sukrosa;
        $makro->gula=$request->gula;
        $makro->erythritol=$request->erythritol;
        $makro->DHA=$request->dha;
        $makro->EPA=$request->epa;
        $makro->Omega3=$request->omega3;
        $makro->mufa=$request->mufa;
        $makro->lemak_trans=$request->lemak_trans;
        $makro->lemak_jenuh=$request->lemak_jenuh;
        $makro->sfa=$request->sfa;
        $makro->omega6=$request->omega6;
        $makro->omega9=$request->omega9;
        $makro->linoleat=$request->linoleat;
        $makro->kolesterol=$request->kolesterol;
        $makro->protein=$request->protein;
        $makro->kadar_air=$request->kadar_air;
        $makro->lemak=$request->lemak;
        $makro->save();
        // registrasi vitamin bb
        $hitung_vitamin = tr_vitamin_bb::where('id_bahan',$id_bahan)->count();
        if($hitung_vitamin>=1){
            $vitamin = tr_vitamin_bb::where('id_bahan',$id_bahan)->first();
        }if($hitung_vitamin==0){
            $vitamin = new tr_vitamin_bb;
        }
        $vitamin->id_bahan=$id_bahan;
        $vitamin->id_satuan_vitA=$request->id_satuan_vitA;
        $vitamin->id_satuan_vitB1=$request->id_satuan_vitB1;
        $vitamin->id_satuan_vitB2=$request->id_satuan_vitB2;
        $vitamin->id_satuan_vitB3=$request->id_satuan_vitB3;
        $vitamin->id_satuan_vitB5=$request->id_satuan_vitB5;
        $vitamin->id_satuan_vitB6=$request->id_satuan_vitB6;
        $vitamin->id_satuan_vitB12=$request->id_satuan_vitB12;
        $vitamin->id_satuan_vitC=$request->id_satuan_vitC;
        $vitamin->id_satuan_vitD=$request->id_satuan_vitD;
        $vitamin->id_satuan_vitE=$request->id_satuan_vitE;
        $vitamin->id_satuan_vitK=$request->id_satuan_vitK;
        $vitamin->id_satuan_folat=$request->id_satuan_folat;
        $vitamin->id_satuan_biotin=$request->id_satuan_biotin;
        $vitamin->id_satuan_kolin=$request->id_satuan_kolin;
        $vitamin->vitA=$request->vitA;
        $vitamin->vitB1=$request->vitB1;
        $vitamin->vitB2=$request->vitB2;
        $vitamin->vitB3=$request->vitB3;
        $vitamin->vitB5=$request->vitB5;
        $vitamin->vitB6=$request->vitB6;
        $vitamin->vitB12=$request->vitB12;
        $vitamin->vitC=$request->vitC;
        $vitamin->vitD=$request->vitD;
        $vitamin->vitE=$request->vitE;
        $vitamin->vitK=$request->vitK;
        $vitamin->folat=$request->folat;
        $vitamin->biotin=$request->biotin;
        $vitamin->kolin=$request->kolin;
        $vitamin->save();
        // Edit mineral bb
        $hitung_mineral = tr_mineral_bb::where('id_bahan',$id_bahan)->count();
        if($hitung_mineral>=1){
            $mineral = tr_mineral_bb::where('id_bahan',$id_bahan)->first();
        }if($hitung_mineral==0){
            $mineral = new tr_mineral_bb;
        }
        $mineral->id_bahan=$id_bahan;
        $mineral->ca=$request->ca;
        $mineral->mg=$request->mg;
        $mineral->k=$request->k;
        $mineral->zink=$request->zink;
        $mineral->na=$request->na;
        $mineral->naci=$request->naci;
        $mineral->energi=$request->energi;
        $mineral->fosfor=$request->fosfor;
        $mineral->mn=$request->mn;
        $mineral->cu=$request->cu;
        $mineral->cr=$request->cr;
        $mineral->fe=$request->fe;
        $mineral->yodium=$request->yodium;
        $mineral->selenium=$request->selenium;
        $mineral->fluor=$request->fluor;
        $mineral->satuan_ca=$request->satuan_ca;
        $mineral->satuan_mg=$request->satuan_mg;
        $mineral->satuan_k=$request->satuan_k;
        $mineral->satuan_zink=$request->satuan_zink;
        $mineral->satuan_fosfor=$request->satuan_fosfor;
        $mineral->satuan_cu=$request->satuan_cu;
        $mineral->satuan_na=$request->satuan_na;
        $mineral->satuan_naci=$request->satuan_naci;
        $mineral->satuan_energi=$request->satuan_energi;
        $mineral->satuan_mn=$request->satuan_mn;
        $mineral->satuan_cr=$request->satuan_cr;
        $mineral->satuan_fe=$request->satuan_fe;
        $mineral->satuan_yodium=$request->satuan_yodium;
        $mineral->satuan_selenium=$request->satuan_selenium;
        $mineral->satuan_fluor=$request->satuan_fluor;
        $mineral->save();
        // Edit BTP carry over bb
        if($request->satuan_btp!='' &&$request->btp_carry_over!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            $hitung_btp_carryOver = tr_btp_bb::where('id_bahan',$id_bahan)->count();
            if($hitung_btp_carryOver>=1){
                $btp_carryOver = tr_btp_bb::where('id_bahan',$id_bahan)->delete();
            }
            if ($validator->passes()) {
				$btp = implode(',', $request->input('btp_carry_over'));
				$btps = explode(',', $btp);
				$idb = implode(',', $request->input('satuan_btp'));
                $idc = explode(',', $idb);
				for ($i = 0; $i < count($btps); $i++)
				{
					$btp_carryOver = new tr_btp_bb;
                    $btp_carryOver->id_bahan=$id_bahan;
                    $btp_carryOver->btp = $btps[$i];
                    $btp_carryOver->id_satuan = $idc[$i];
					$btp_carryOver->save();
					$i = $i++;
				}
			}
        }
        // Edit zat aktif bb
        if($request->satuan_zat!='' && $request->zat_aktif!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            $hitung_zat = tr_zataktif_bb::where('id_bahan',$id_bahan)->count();
            if($hitung_zat>=1){
                $zat = tr_zataktif_bb::where('id_bahan',$id_bahan)->delete();
            }
            if ($validator->passes()) {
				$idz = implode(',', $request->input('zat_aktif'));
				$ids = explode(',', $idz);
				$idb = implode(',', $request->input('satuan_zat'));
				$idc = explode(',', $idb);
				for ($i = 0; $i < count($ids); $i++)
				{
					$zat = new tr_zataktif_bb;
                    $zat->id_bahan=$id_bahan;
                    $zat->zat_aktif = $ids[$i];
					$zat->id_satuan = $idc[$i];
					$zat->save();
					$i = $i++;
				}
			}
        }
        // Edit logam berat bb
        $hitung_logam = tr_logamberat_bb::where('id_bahan',$id_bahan)->count();
        if($hitung_logam>=1){
            $logam = tr_logamberat_bb::where('id_bahan',$id_bahan)->first();
        }if($hitung_logam==0){
            $logam = new tr_logamberat_bb;
        }
        $logam->id_bahan=$id_bahan;
        $logam->As=$request->as;
        $logam->pb=$request->pb;
        $logam->hg=$request->hg;
        $logam->cd=$request->cd;
        $logam->sn=$request->sn;
        $logam->save();
        // Edit asam amino bb
        $hitung_logam = tr_asam_amino_bb::where('id_bahan',$id_bahan)->count();
        if($hitung_logam>=1){
            $asam = tr_asam_amino_bb::where('id_bahan',$id_bahan)->first();
        }if($hitung_logam==0){
            $asam = new tr_asam_amino_bb;
        }
        $asam->id_bahan=$id_bahan;
        $asam->l_glutamin=$request->l_glutamin;
        $asam->Threonin=$request->l_glutamin;
        $asam->Methionin=$request->threonin;
        $asam->Phenilalanin=$request->phenilalanin;
        $asam->Histidin=$request->histidin;
        $asam->lisin=$request->lisinin;
        $asam->BCAA=$request->bcaa;
        $asam->Valin=$request->valin;
        $asam->Leusin=$request->leusin;
        $asam->Aspartat=$request->aspartat;
        $asam->Alanin=$request->alanin;
        $asam->Sistein=$request->sistein;
        $asam->Serin=$request->serin;
        $asam->Glisin=$request->glisin;
        $asam->Glutamat=$request->glutamat;
        $asam->Tyrosin=$request->tyrosin;
        $asam->Proline=$request->proline;
        $asam->Arginine=$request->arginine;
        $asam->Isoleusin=$request->Isoleusin;
        $asam->save();
        // Edit allergen contain bb
        if($request->contain!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            $hitung_allergen = bb_allergen::where('id_bb',$id_bahan)->where('allergen_countain','!=','NULL')->count();
            if($hitung_allergen>=1){
                $allergen = bb_allergen::where('id_bb',$id_bahan)->where('allergen_countain','!=','NULL')->delete();
            }
            if ($validator->passes()) {
				$idz = implode(',', $request->input('contain'));
				$ids = explode(',', $idz);
                for ($i = 0; $i < count($ids); $i++)
				{
					$allergen = new bb_allergen;
                    $allergen->id_bb=$id_bahan;
                    $allergen->allergen_countain = $ids[$i];
					$allergen->save();
					$i = $i++;
				}
			}
        }
        // Edit allergen may contain bb
        if($request->may_contain!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            $hitung_mayContain = bb_allergen::where('id_bb',$id_bahan)->where('allergen_may_contain','!=','NULL')->count();
            if($hitung_mayContain>=1){
                $mayContain = bb_allergen::where('id_bb',$id_bahan)->where('allergen_may_contain','!=','NULL')->delete();
            }
            if ($validator->passes()) {
				$idz = implode(',', $request->input('may_contain'));
				$ids = explode(',', $idz);
				for ($i = 0; $i < count($ids); $i++)
				{
					$mayContain = new bb_allergen;
                    $mayContain->id_bb=$id_bahan;
                    $mayContain->allergen_may_contain = $ids[$i];
					$mayContain->save();
					$i = $i++;
				}
			}
        }
        // Registrasi Mikro
        $hitung_m = tr_mikro_bb::where('id_bahan',$id_bahan)->count();
        if($hitung_m>=1){
            $m = tr_mikro_bb::where('id_bahan',$id_bahan)->first();
        }if($hitung_m==0){
            $m = new tr_mikro_bb;
        }
        $m->id_bahan=$bahan->id;
        $m->Enterobacter=$request->Enterobacter;
        $m->Salmonella=$request->Salmonella;
        $m->aureus=$request->aureus;
        $m->TPC=$request->TPC;
        $m->Yeast=$request->Yeast;
        $m->Coliform=$request->Coliform;
        $m->Coli=$request->Coli;
        $m->Bacilluscereus=$request->Bacilluscereus;
        $m->save();
        // Edit mikro biologi bb
        if($request->bpom!=''){
            $hitung_mikro = tr_mikro_biologi_bb::where('id_bahan',$id_bahan)->count();
            if($hitung_mikro>=1){
                $mikro = tr_mikro_biologi_bb::where('id_bahan',$id_bahan)->first();
            }if($hitung_mikro==0){
                $mikro = new tr_mikro_biologi_bb;
            }
            $mikro->id_bahan=$id_bahan;
            $mikro->id_bpom=$request->bpom;
            $mikro->save();
        }if($request->mikro!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule); 
            $hitung_mikro = tr_mikro_biologi_bb::where('id_bahan',$id_bahan)->count();
            if($hitung_mikro>=1){
                $mikro = tr_mikro_biologi_bb::where('id_bahan',$id_bahan)->delete();
            }
            if ($validator->passes()) {
				$mikro = implode(',', $request->input('mikro'));
				$data_mikro = explode(',', $mikro);
				$n = implode(',', $request->input('n'));
				$data_n = explode(',', $n);
				$c = implode(',', $request->input('c'));
				$data_c = explode(',', $c);
				$m = implode(',', $request->input('m'));
				$data_m = explode(',', $m);
				$M2 = implode(',', $request->input('M2'));
				$data_M2 = explode(',', $M2);
				$satuan_mikro = implode(',', $request->input('satuan_mikro'));
				$data_satuan_mikro = explode(',', $satuan_mikro);
				for ($i = 0; $i < count($data_mikro); $i++)
				{
					$mikro = new tr_mikro_biologi_bb;
                    $mikro->id_bahan=$id_bahan;
                    $mikro->id_jenis_mikro = $data_mikro[$i];
                    $mikro->n = $data_n[$i];
                    $mikro->c = $data_c[$i];
                    $mikro->m = $data_m[$i];
                    $mikro->M2 = $data_M2[$i];
                    $mikro->satuan = $data_satuan_mikro[$i];
					$mikro->save();
					$i = $i++;
				}
			}
        }

        return Redirect::back()->with('status', $bahan->nama_sederhana.' Telah DiUpdate!');
    }
}
