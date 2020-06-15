<?php

namespace App\Http\Controllers\devnf;
use App\nutfact\tb_parameter;
use App\devnf\tb_analisa;
use App\dev\formula;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TbAnalisaController extends Controller
{
    public function index($id){
        $data       = formula::with('Workbook')->where('id',$id)->get();
        $tampil     = tb_parameter::with('get_akg')->offset(26)->limit(84)->get();
        $lemak      = tb_analisa::where('formula', $id)->offset(2)->limit(1)->get();
        $jenuh      = tb_analisa::where('formula', $id)->offset(4)->limit(1)->get();         
        $analisa    = tb_analisa::where('formula',$id)->with('get_parame')->get();
        return view('devnf.datanutri', compact('tampil','ing','data','analisa','lemak','jenuh'));
    }

    public function store(Request $request,$id){
        $jumlah_data    = $request->jumlah_data;
        for($i=1;$i<$jumlah_data;$i++){
            $analisa = new tb_analisa;  
            $analisa->formula       = $id;
            $analisa->parameter     = $request->parameter[$i];
            $analisa->per_serving   = $request->per_serving[$i];
            $analisa->hasil_analisa = $request->hasil_analisa[$i];
            $analisa->akg           = $request->akg[$i];
            $analisa->save();
        }
        return back();
    }
} 