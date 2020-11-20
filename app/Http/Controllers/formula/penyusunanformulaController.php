<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\formula\registrasi_formula;
use App\formula\tb_formula;
use App\dev\Bahan;

use Auth;
use Redirect;

class penyusunanformulaController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function penyusunan($registrasi,$id){
        $formulas = tb_formula::where('id_registrasi',$registrasi)->get();
        $for = tb_formula::where('id_registrasi',$registrasi)->get();
        $regis = registrasi_formula::where('id_registrasi',$registrasi)->get();
        $bahan = bahan::all();
        $no = 0;

        $scalecollect = collect();
        $rjServing  = 0;
        $rjbatch  = 0;
        $rjkomposisi  = 0;
        foreach($for as $for){
            $scalecollect->push([
                'no' => ++$no,           
                'per_serving' => $for->bb_serving,
                'per_batch' => $for->bb_batch,
                'komposisi' => $for->komposisi,
            ]);
            $rjServing = $rjServing + $for->bb_serving;
            $rjbatch = $rjbatch + $for->bb_batch;
            $rjkomposisi = $rjkomposisi + $for->komposisi;
        }
        return view('formula/penyusunan_formula')->with([
            'bahan' => $bahan,
            'formulas' => $formulas,
            'rjserving' => $rjServing,
            'rjbatch' => $rjbatch,
            'rjkomposisi' => $rjkomposisi,
            'registrasi' => $regis
        ]);
    }

    public function formula(Request $request,$registrasi){
        $formula = new tb_formula;
        $formula->id_registrasi=$request->regis;
        $formula->id_bahan=$request->bb;
        $formula->allergen=$request->Allergen;
        $formula->uom=$request->UOM;
        $formula->berat_uom=$request->berat_uom;
        $formula->bb_serving=$request->bb_serving;
        $formula->bb_batch=$request->bb_batch;
        $formula->komposisi=$request->komposisi;
        $formula->target_serving_size=$request->target_serving;
        $formula->save();

        return redirect::back();
    }

    public function updateregis(Request $request,$registrasi,$id){
        $regis = registrasi_formula::where('id_registrasi',$registrasi)->where('id_pkp',$id)->first();
        $regis->rasio_batch_formula=$request->rasio_formula;
        $regis->scale_batch=$request->scale;
        $regis->catatan=$request->catatan;
        $regis->save();

        // update formula (lini persiapan)
        $scores = $request->input('scores');
        foreach($scores as $row){
            $formulas = tb_formula::where('id_formula',$row['id'])->where('id_registrasi',$registrasi)->update([
                "lini_persiapan" => $row['persiapan']
            ]);
        }
        return redirect::route('penyusunan.alternatif',[$registrasi,$id]);
    }
}
