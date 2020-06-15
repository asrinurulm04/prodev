<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dev\Bahan;
use App\master\Satuan;
use App\master\Subkategori;
use App\master\Curren;
use App\nutfact\tb_ingredient;
use App\master\Kelompok;
use App\nutfact\uom;
use Auth;
use Redirect;
use DB;

class MyRamenController extends Controller
{
    public function __construct(){
        
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }
    
    public function index($idf){
        $satuans = Satuan::all();
        $uom = uom::all();
        $subkategoris = Subkategori::all();
        $currens = Curren::all();
        $kelompoks = Kelompok::all();
        return view('formula.myramen')->with([
            'satuans' =>$satuans,
            'uom' =>$uom,
            'subkategoris' => $subkategoris,
            'currens' => $currens,
            'kelompoks' => $kelompoks,
            'idf' => $idf
        ]);
    }

    public function insert($idf,Request $request){
        $bahan = new Bahan;
        $bahan->nama_sederhana = $request->nama_bahan;
        $bahan->nama_bahan = $request->nama_bahan;
        $bahan->kode_oracle = $request->kode_oracle;
        $bahan->kode_komputer = $request->kode_komputer;
        $bahan->supplier = $request->supplier;
        $bahan->principle = $request->principle;
        $bahan->no_HEIPBR = $request->no_HEIPBR;
        $bahan->PIC = $request->PIC;
        $bahan->cek_halal = $request->cek_halal;
        $bahan->id_uom = $request->uom;
        $bahan->status='baru';
        $bahan->umur_simpan = $request->lama;
        $bahan->subkategori_id = $request->subkategori;
        
        if (isset($request->c_kelompok)) {
            $id = DB::table('kelompoks')->insertGetId(
                [ 'nama' => $request->custom_kelompok]
            );
            $bahan->kelompok_id = $id;
        }
        else{                
            $bahan->kelompok_id = $request->kelompok;
        }

        $bahan->berat = $request->berat;
        $bahan->satuan_id = $request->satuan;
        $bahan->harga_satuan = $request->harga_satuan;
        $bahan->curren_id = $request->curren;
        $bahan->user_id = $request->user;
        $bahan->save();

        $ingredient= new tb_ingredient;
        $ingredient->fat= $request->fat;
        $ingredient->ingredient= $request->nama_bahan;
        $ingredient->SFA= $request->sfa;
        $ingredient->karbohidrat= $request->karbohidrat;
        $ingredient->gula_total= $request->gula;
        $ingredient->laktosa= $request->laktosa;
        $ingredient->sukrosa= $request->sukrosa;
        $ingredient->serat= $request->serat;
        $ingredient->serat_larut= $request->seratL;
        $ingredient->protein= $request->protein;
        $ingredient->na= $request->na;
        $ingredient->k= $request->k;
        $ingredient->ca= $request->ca;
        $ingredient->p= $request->p;
        $ingredient->beta_glucan= $request->beta;
        $ingredient->cr= $request->cr;
        $ingredient->vitC= $request->vitc;
        $ingredient->vitE= $request->vite;
        $ingredient->vitD= $request->vitd;
        $ingredient->carnitin= $request->carnitin;
        $ingredient->CLA= $request->cla;
        $ingredient->sterol_ester= $request->sterol;
        $ingredient->chondroitin= $request->chondroitin;
        $ingredient->Omega3= $request->omega3;
        $ingredient->DHA= $request->dha;
        $ingredient->epa= $request->epa;
        $ingredient->creatine= $request->creatine;
        $ingredient->lysine= $request->lysine;
        $ingredient->glucosamine= $request->glucosamine;
        $ingredient->kolin= $request->kolin;
        $ingredient->MUFA= $request->mufa;
        $ingredient->linoleic_acid6= $request->linoleic_acid6;
        $ingredient->linolenic_acid= $request->linoleic;
        $ingredient->Oleic_acid= $request->Oleic_acid;
        $ingredient->sorbitol= $request->soritol;
        $ingredient->maltitol= $request->maltitol;
        $ingredient->kafein= $request->kafein;
        $ingredient->kolesterol= $request->kolesterol;
        $ingredient->glukosa1= $request->glukosa1;
        $ingredient->glukosa2= $request->glukosa2;
        $ingredient->Lglutamin= $request->Lglutamin;
        $ingredient->threonin= $request->threonin;
        $ingredient->methionin= $request->methionin;
        $ingredient->save();

        return Redirect()->route('step2',$idf)->with('status', 'Bahan Baku '.$bahan->nama_sederhana.' Telah Ditambahkan!');
    }
}