<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\master\Subbrand;
use App\master\Gudang;
use App\master\Produksi;
use App\master\Maklon;
use App\pkp\tipp;
use App\pkp\pkp_project;
use App\User;
use App\users\Departement;
use App\dev\Formula;

class Step1Controller extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }
    
    public function create($id){
        $depts = Departement::all();
        $subbrands = Subbrand::all();
        $gudangs = Gudang::all();
        $produksis = Produksi::all();
        $maklons = Maklon::all();
        $formula = Formula::find($id);
        $idf = $id;
        return view('formula/step1')->with([
            'idf' => $idf,
            'formula' => $formula,
            'depts' => $depts,
            'subbrands' => $subbrands,
            'gudangs' => $gudangs,
            'produksis' => $produksis,
            'maklons' => $maklons,
            ]);
    }

    public function update($id,Request $request){
        $this->validate(request(), [
            'bj' => 'numeric',
            'batch' => 'numeric',
            'serving' => 'numeric',
            'liter' => 'numeric'
        ]);

        $formula = Formula::find($id);
        $formula->kode_formula = $request->kode_formula;
        $formula->gudang_id = $request->gudang;
        $formula->produksi_id = $request->produksi;
        $formula->maklon_id = $request->maklon;
        $formula->main_item = $request->main_item;
        $formula->main_item_eks = $request->main_item_eks;
        $formula->bj = $request->bj;
        $formula->batch = $request->batch;
        $formula->serving = $request->serving;
        $formula->liter = $request->liter;
        $formula->keterangan = $request->keterangan;
        $formula->save();
        
        return Redirect()->route('step2', $formula->id);
    }
}