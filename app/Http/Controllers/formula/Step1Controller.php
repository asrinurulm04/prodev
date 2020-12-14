<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\master\Subbrand;
use App\model\master\Produksi;
use App\model\pkp\tipp;
use App\model\pkp\pkp_project;
use App\model\users\User;
use App\model\users\Departement;
use App\model\dev\Formula;

class Step1Controller extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }
    
    public function create($formula,$id){
        $depts = Departement::all();
        $subbrands = Subbrand::all();
        $produksis = Produksi::all();
        $formula = Formula::where('id',$id)->first();
        $idfor = $formula->workbook_id;
        $idf = $id;
        return view('formula/step1')->with([
            'idf' => $idf,
            'formula' => $formula,
            'depts' => $depts,
            'subbrands' => $subbrands,
            'idfor' => $idfor,
            'produksis' => $produksis
        ]);
    }

    public function step1_pdf($formula,$id){
        $depts = Departement::all();
        $subbrands = Subbrand::all();
        $produksis = Produksi::all();
        $formula = Formula::where('id',$id)->first();
        $idfor_pdf = $formula->workbook_pdf_id;
        $idf = $id;
        return view('formula/step1_pdf')->with([
            'idf' => $idf,
            'formula' => $formula,
            'depts' => $depts,
            'subbrands' => $subbrands,
            'idfor_pdf' => $idfor_pdf,
            'produksis' => $produksis
        ]);
    }

    public function update($formula,$id,Request $request){
        $formula = Formula::where('id',$formula)->first();
        $formula->catatan_rd = $request->keterangan;
        $formula->note_formula = $request->formula;
        $formula->serving_size = $request->serving;
        $formula->formula = $request->sample;
        $formula->satuan = $request->satuan;
        $formula->berat_jenis = $request->berat_jenis;
		if($request->kategori_formula!=NULL){
		$formula->kategori=$request->kategori_formula;
		}else{
			$formula->kategori='fg';
		}
        $formula->save();
        
        return Redirect()->route('step2', [$formula->id,$formula]);
    }
}