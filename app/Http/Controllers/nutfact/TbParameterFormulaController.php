<?php

namespace App\Http\Controllers\nutfact;
use App\devnf\tb_parameter;
use App\devnf\tb_analisa;   
use App\devnf\tb_hitung_hak;
use App\dev\formula;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TbParameterFormulaController extends Controller
{
    public function datanut(){
        return view('nutfact.nutfact');
    }

    public function Tbanalisa(){    
    	$tampilkan = tb_parameter::all();
        $muncul = formula::with('get_wb')->get();
        return view('devnf.hasilanalisa', compact('tampilkan','muncul'));
    }
}