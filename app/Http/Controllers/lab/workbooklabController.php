<?php

namespace App\Http\Controllers\lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\dev\Formula;
use App\pkp\tipp;
use App\pkp\pkp_project;
use App\Modellab\analisa;
use App\Modellab\Dlab;
use App\modellab\workbook_lab;

use Auth;
use DB;
Use redirect;

class workbooklabController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:manager' || 'rule:lab');
    }

    public function index($formula,$id){
        $formulas = Formula::where('id',$formula)->get();
        $analisa = analisa::all();
        $fe=workbook_lab::where('id_formula',$formula)->first();
        $mikroba = DB::table('fs_jenismikroba')->select(['jenis_mikroba'])->distinct()->get();
        $dataL =Dlab::where('id_wb_lab',$id)->get();
        $count_lab = Dlab::where('id_wb_lab',$id)->count();
        $Jlab = Dlab::where('id_wb_lab',$id)->sum('rate');
        $lab2 = DB::table('formulas')
            ->join('tippu','tippu.id_pkp','=','formulas.workbook_id')
            ->join('pkp_datapangan','pkp_datapangan.id_pangan','=','tippu.bpom')
            ->join('bpom','pkp_datapangan.no_kategori','=','bpom.no')
            ->where('formulas.id',$formula)->where('status_fisibility','=','proses')
            ->where('status_data','=','active')->get();
        $cek_lab =Dlab::where('id_wb_lab',$id)->count();
        return view('lab.datalab',['fe'=>$fe])->with([
            'cek_lab' => $cek_lab,
            'mikroba' => $mikroba,
            'analisa' => $analisa,
            'formulas' => $formulas,
            'lab2' => $lab2,
            'dataL' => $dataL,
            'count_lab' => $count_lab,
            'id' => $id,
            'jlab' =>$Jlab
        ]);
    }
}
