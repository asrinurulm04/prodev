<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\formula\Bahan;
use App\model\pkp\DataPangan;
use App\model\master\Satuan;
use App\model\master\SatuanVit;
use App\model\master\Kategori;
use App\model\master\Curren;
use App\model\master\Supplier;
use App\model\master\Principal;
use App\model\nutfact\JenisMikroba;
use App\model\nutfact\SatuanBpom;
use App\model\nutfact\BPOM;
use App\model\nutfact\BTP;
use App\model\nutfact\Allergen;
use App\model\nutfact\MakroBB;
use App\model\nutfact\MikroBiologiBB;
use App\model\nutfact\MikroBB;
use App\model\nutfact\BtpBB;
use App\model\nutfact\MineralBB;
use App\model\nutfact\VitaminBB;
use App\model\nutfact\AsamAminoBB;
use App\model\nutfact\ZatAktif;
use App\model\nutfact\ZatAktifBB;
use App\model\nutfact\LogamBB;
use App\model\nutfact\AllergenBB;
use Redirect;
use DB;
use Auth;

class BahanBakuController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:admin' || 'rule:user_produk');
    }

    public function bahan(){
        $bahans = Bahan::where('status_bb','eksis')->select('nama_sederhana','nama_bahan','kode_oracle','supplier','harga_satuan','id')->get();
        return view('datamaster.bahanbaku')->with([
            'bahans' => $bahans
        ]);
    }

    public function active($id){
        $bahan = Bahan::where('id',$id)->first();
        $bahan->status = 'active';
        $bahan->save();

        return Redirect::back()->with('status','Status '.$bahan->nama_sederhana.' Active!');
    }

    public function nonactive($id){
        $bahan = Bahan::where('id',$id)->first();
        $bahan->update(['status'=>'inactive']);

        return Redirect::back()->with('error','Status '.$bahan->nama_sederhana.' NonActive!');
    }

    public function bahanrd(){
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
        $bahan->status_bb = $request->status;
        $bahan->save();
        // registrasi makro bb
        $makro = new MakroBB;
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
        $makro->omega6=$request->omega6;
        $makro->omega9=$request->omega9;
        $makro->fat=$request->fat;
        $makro->GI=$request->gi;
        $makro->linoleat=$request->linoleat;
        $makro->kolesterol=$request->kolesterol;
        $makro->protein=$request->protein;
        $makro->kadar_air=$request->kadar_air;
        $makro->lemak=$request->lemak;
        $makro->save();
        // registrasi vitamin bb
        $vitamin = new VitaminBB;
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
        $mineral = new MineralBB;
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
					$btp_carryOver = new BtpBB;
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
					$zat = new ZatAktif;
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
        $logam = new LogamBB;
        $logam->id_bahan=$bahan->id;
        $logam->As=$request->as;
        $logam->pb=$request->pb;
        $logam->hg=$request->hg;
        $logam->cd=$request->cd;
        $logam->sn=$request->sn;
        $logam->save();
        // registrasi asam amino bb
        $asam = new AsamAminoBB;
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
					$contain = new AllergenBB;
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
					$mayContain = new AllergenBB;
                    $mayContain->id_bb=$bahan->id;
                    $mayContain->allergen_may_contain = $ids[$i];
					$mayContain->save();
					$i = $i++;
				}
			}
        }
        // Registrasi Mikro
        $m = new MikroBB;
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
            $mikro = new MikroBiologiBB;
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
					$mikro = new MikroBiologiBB;
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
        $currens = Curren::select('id','currency')->get();
        $allergen = Allergen::select('allergen')->get();
        $pangan = BPOM::select('id_pangan','no_kategori')->get();
        $satuan_bpom = SatuanBpom::select('satuan')->get();
        $zat = ZatAktif::select('zat_aktif')->get();
        $supplier = Supplier::orderBy('nama_supplier_principal','asc')->select('nama_supplier_principal')->get();
        $principal = Principal::orderBy('nama_cp','asc')->select('nama_cp')->get();
        $btp2 = BTP::select('btp')->get();
        $kategori = Kategori::orderBy('kategori','asc')->select('kategori','id')->get();
        $jenis = JenisMikroba::select('mikro','id')->get();
        $satuan_vit = SatuanVit::select('id_satuan_vit','satuan')->get();
        return view('datamaster.registrasiBB')->with([
            'allergen' =>$allergen,
            'pangan' => $pangan,
            'jenis' => $jenis,
            'satuan_bpom' => $satuan_bpom,
            'zat' => $zat,
            'zat1' => $zat,
            'supplier' => $supplier,
            'principal' => $principal,
            'btp2' => $btp2,
            'kategori' => $kategori,
            'satuan_vit' =>$satuan_vit,
            'curren' => $currens
        ]);
    }

    public function edit_bahan($id){
        $bahan = Bahan::where('id',$id)->first();
        $makro = MakroBB::where('id_bahan',$id)->get();
        $air = MakroBB::where('id_bahan',$id)->get();
        $vit = VitaminBB::where('id_bahan',$id)->get();
        $mineral = MineralBB::where('id_bahan',$id)->get();
        $asam = AsamAminoBB::where('id_bahan',$id)->get();
        $m = MikroBB::where('id_bahan',$id)->get();
        $supplier = Supplier::orderBy('nama_supplier_principal','asc')->select('nama_supplier_principal')->get();
        $principal = Principal::orderBy('nama_cp','asc')->select('nama_cp')->get();
        $currens = Curren::select('id','currency')->get();
        $satuan_bpom = SatuanBpom::select('satuan')->get();
        $zat_aktif = ZatAktif::select('zat_aktif')->get();
        $zat = ZataktifBB::where('id_bahan',$id)->get();
        $hitung_zat = ZataktifBB::where('id_bahan',$id)->count();
        $hasil_btp = BtpBB::where('id_bahan',$id)->get();
        $hitung_hasil_btp = BtpBB::where('id_bahan',$id)->count();
        $contain = AllergenBB::where('id_bb',$id)->where('allergen_countain','!=','NULL')->get();
        $mayContain = AllergenBB::where('id_bb',$id)->where('allergen_may_contain','!=','NULL')->get();
        $hitungmikro = MikroBiologiBB::where('id_bahan',$id)->count();
        $cekmikro = MikroBiologiBB::where('id_bahan',$id)->first();
        $mikro = MikroBiologiBB::where('id_bahan',$id)->get();
        $logam = LogamBB::where('id_bahan',$id)->get();
        $allergen2 = Allergen::select('allergen')->get();
        $data_pangan = dataPangan::select('id_pangan','no_kategori')->get();
        $btp2 = BTP::select('btp')->get();
        $kategori = Kategori::orderBy('kategori','asc')->select('kategori','id')->get();
        $jenis = JenisMikroba::select('mikro','id')->get();
        $satuan_vit = SatuanVit::select('id_satuan_vit','satuan')->get();
        return view('datamaster.editbb')->with([
            'makro' => $makro,'m' => $m,
            'hitung_zat' => $hitung_zat,
            'mayContain' => $mayContain,
            'satuan_bpom' => $satuan_bpom,
            'zat_aktif'=> $zat_aktif,
            'supplier' => $supplier,
            'principal' => $principal,
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
            'zat' => $zat,
            'hasil_btp' => $hasil_btp,
            'jenis' => $jenis,
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
        $bahan->status_bb = $request->status;
        $bahan->save();

        // Edit makro bb
        $hitung_mikro = MakroBB::where('id_bahan',$id_bahan)->count();
        if($hitung_mikro>=1){
            $makro = MakroBB::where('id_bahan',$id_bahan)->first();
        }if($hitung_mikro==0){
            $makro = new MakroBB;
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
        $makro->omega6=$request->omega6;
        $makro->omega9=$request->omega9;
        $makro->fat=$request->fat;
        $makro->GI=$request->gi;
        $makro->linoleat=$request->linoleat;
        $makro->kolesterol=$request->kolesterol;
        $makro->protein=$request->protein;
        $makro->kadar_air=$request->kadar_air;
        $makro->lemak=$request->lemak;
        $makro->save();
        // registrasi vitamin bb
        $hitung_vitamin = VitaminBB::where('id_bahan',$id_bahan)->count();
        if($hitung_vitamin>=1){
            $vitamin = VitaminBB::where('id_bahan',$id_bahan)->first();
        }if($hitung_vitamin==0){
            $vitamin = new VitaminBB;
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
        $hitung_mineral = MineralBB::where('id_bahan',$id_bahan)->count();
        if($hitung_mineral>=1){
            $mineral = MineralBB::where('id_bahan',$id_bahan)->first();
        }if($hitung_mineral==0){
            $mineral = new MineralBB;
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
            $hitung_btp_carryOver = BtpBB::where('id_bahan',$id_bahan)->count();
            if($hitung_btp_carryOver>=1){
                $btp_carryOver = BtpBB::where('id_bahan',$id_bahan)->delete();
            }
            if ($validator->passes()) {
				$idz = implode(',', $request->input('btp_carry_over'));
				$carry = explode(',', $idz);
				$btp = implode(',', $request->input('btp'));
				$nominal_btp = explode(',', $btp);
				$idb = implode(',', $request->input('satuan_btp'));
				$idc = explode(',', $idb);
				for ($i = 0; $i < count($carry); $i++)
				{
					$btp_carryOver = new BtpBB;
                    $btp_carryOver->id_bahan=$id_bahan;
                    $btp_carryOver->btp = $carry[$i];
                    $btp_carryOver->nominal = $nominal_btp[$i];
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
            $hitung_zat = ZatAktif::where('id_bahan',$id_bahan)->count();
            if($hitung_zat>=1){
                $zat = ZatAktif::where('id_bahan',$id_bahan)->delete();
            }
            if ($validator->passes()) {
				$idz = implode(',', $request->input('zat_aktif'));
				$ids = explode(',', $idz);
				$nominal = implode(',', $request->input('zat'));
				$nominal_zat = explode(',', $nominal);
				$idb = implode(',', $request->input('satuan_zat'));
				$idc = explode(',', $idb);
				for ($i = 0; $i < count($ids); $i++)
				{
					$zat = new ZatAktif;
                    $zat->id_bahan=$id_bahan;
                    $zat->zat_aktif = $ids[$i];
                    $zat->nominal = $nominal_zat[$i];
					$zat->id_satuan = $idc[$i];
					$zat->save();
					$i = $i++;
				}
			}
        }
        // Edit logam berat bb
        $hitung_logam = LogamBB::where('id_bahan',$id_bahan)->count();
        if($hitung_logam>=1){
            $logam = LogamBB::where('id_bahan',$id_bahan)->first();
        }if($hitung_logam==0){
            $logam = new LogamBB;
        }
        $logam->id_bahan=$id_bahan;
        $logam->As=$request->as;
        $logam->pb=$request->pb;
        $logam->hg=$request->hg;
        $logam->cd=$request->cd;
        $logam->sn=$request->sn;
        $logam->save();
        // Edit asam amino bb
        $hitung_logam = AsamAminoBB::where('id_bahan',$id_bahan)->count();
        if($hitung_logam>=1){
            $asam = AsamAminoBB::where('id_bahan',$id_bahan)->first();
        }if($hitung_logam==0){
            $asam = new AsamAminoBB;
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
            $hitung_allergen = AllergenBB::where('id_bb',$id_bahan)->where('allergen_countain','!=','NULL')->count();
            if($hitung_allergen>=1){
                $allergen = AllergenBB::where('id_bb',$id_bahan)->where('allergen_countain','!=','NULL')->delete();
            }
            if ($validator->passes()) {
				$idz = implode(',', $request->input('contain'));
				$ids = explode(',', $idz);
                for ($i = 0; $i < count($ids); $i++)
				{
					$allergen = new AllergenBB;
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
            $hitung_mayContain = AllergenBB::where('id_bb',$id_bahan)->where('allergen_may_contain','!=','NULL')->count();
            if($hitung_mayContain>=1){
                $mayContain = AllergenBB::where('id_bb',$id_bahan)->where('allergen_may_contain','!=','NULL')->delete();
            }
            if ($validator->passes()) {
				$idz = implode(',', $request->input('may_contain'));
				$ids = explode(',', $idz);
				for ($i = 0; $i < count($ids); $i++)
				{
					$mayContain = new AllergenBB;
                    $mayContain->id_bb=$id_bahan;
                    $mayContain->allergen_may_contain = $ids[$i];
					$mayContain->save();
					$i = $i++;
				}
			}
        }
        // Registrasi Mikro
        $hitung_m = MikroBB::where('id_bahan',$id_bahan)->count();
        if($hitung_m>=1){
            $m = MikroBB::where('id_bahan',$id_bahan)->first();
        }if($hitung_m==0){
            $m = new MikroBB;
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
            $hitung_mikro = MikroBiologiBB::where('id_bahan',$id_bahan)->count();
            if($hitung_mikro>=1){
                $mikro = MikroBiologiBB::where('id_bahan',$id_bahan)->first();
            }if($hitung_mikro==0){
                $mikro = new MikroBiologiBB;
            }
            $mikro->id_bahan=$id_bahan;
            $mikro->id_bpom=$request->bpom;
            $mikro->save();
        }if($request->mikro!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule); 
            $hitung_mikro = MikroBiologiBB::where('id_bahan',$id_bahan)->count();
            if($hitung_mikro>=1){
                $mikro = MikroBiologiBB::where('id_bahan',$id_bahan)->delete();
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
					$mikro = new MikroBiologiBB;
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
        return Redirect::route('bahan_rd')->with('status', $bahan->nama_sederhana.' Telah DiUpdate!');
    }
}