<?php

namespace App\Http\Controllers\finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\Modelfn\finance;
use App\model\Modelfn\pesan;
use App\model\dev\Formula;
use App\model\pkp\tipp;
use App\model\pkp\pkp_project;
use App\model\modelmaklon\workbook_maklon;

use Auth;
use DB;
Use Redirect;

class workbookfsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:lab' || 'rule:evaluator' || 'rule:maklon' || 'rule:kemas');
    }

    public function workbookFS($wb){
        $workbook = formula::where('id',$wb)->first();
        $myFormula = tipp::where('id_pkp',$workbook->workbook_id)->first();
        $hitungkemas = workbook_kemas::where('id_formula',$workbook->id)->count();
        $hitunglab = workbook_lab::where('id_formula',$workbook->id)->count();
        $hitungmaklon = workbook_maklon::where('id_formula',$workbook->id)->count();
        $datakemas = workbook_kemas::where('id_formula',$workbook->id)->get();
        $datalab = workbook_lab::where('id_formula',$workbook->id)->get();
        $datamaklon = workbook_maklon::where('id_formula',$workbook->id)->get();
        $dataF = finance::where('id_wb',$workbook->workbook_id)->where('id_formula',$wb)->get();
        $dF = finance::where('id_wb',$workbook->workbook_id)->where('id_formula',$wb)->first();
        return view('workbookfs.workbook')->with([
            'myFormula' => $myFormula,
            'wb' => $wb,
            'for' => $dF,
            'hitungkemas' => $hitungkemas,
            'hitunglab' => $hitunglab,
            'hitungmaklon' => $hitungmaklon,
            'datakemas' => $datakemas,
            'datalab' => $datalab,
            'datamaklon' => $datamaklon,
            'dataF' => $dataF
        ]);
    }

    public function addwbkemas($id_formula){
        $kemas = new workbook_kemas;
        $kemas->id_formula=$id_formula;
        $kemas->status='proses';
        $kemas->revisi='1';
        $kemas->turunan='0';
        $kemas->save();

        return redirect::route('wbkemas',[$id_formula,$kemas->id_wb_kemas]);
    }
    
    public function addwblab($id_formula){
        $lab = new workbook_lab;
        $lab->id_formula=$id_formula;
        $lab->status='proses';
        $lab->revisi='1';
        $lab->turunan='0';
        $lab->save();

        return redirect::route('datalab',[$id_formula,$lab->id_wb_lab]);
    }

    
    public function addwbmaklon($id_formula){
        $maklon = new workbook_maklon;
        $maklon->id_formula=$id_formula;
        $maklon->status='proses';
        $maklon->revisi='1';
        $maklon->turunan='0';
        $maklon->save();

        return redirect::route('wbmaklon',[$id_formula,$maklon->id_wb_maklon]);
    }
}
