<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Modelfn\finance;
use App\model\Modelfn\pesan;
use App\model\dev\Formula;
use App\model\pkp\tipp;
use App\model\pkp\PkpProject;
use Redirect;

class ListFeasibilityController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($id){
        $myFormula = tipp::where('id_pkp',$id)->first();
        $dataF = finance::where('id_feasibility',$id)->get();
        $jumlahp =pesan::where('user','produksi')->count();
        $jumlahm =pesan::where('user','inputor')->count();
        $jumlahl =pesan::where('user','lab')->count();
        $jumlahk =pesan::where('user','kemas')->count();
        $kirim = finance::where('id_formula',$id)->get();
        return view('feasibility.feasibility')->with([
            'myFormula' => $myFormula,
            'id' => $id,
            'jumlahp' => $jumlahp,
            'jumlahm' => $jumlahm,
            'jumlahl' => $jumlahl,
            'jumlahk' => $jumlahk,
            'dataF' => $dataF,
            'kirim' => $kirim
        ]);
    }

    public function deletefs ($id){
        $fs = finance::find($id);
        $fs->delete();
        return redirect::back()->with('message', 'Data berhasil dihapus!');
    }

    public function kirimWB(Request $request,$id,$id_feasibility)
    {
        $change_status  = finance::where('kemungkinan',$request->get('dropdown'))->first();
        $change_status->status_feasibility='selesai';
        $change_status->save();

        $status  = Formula::where('id',$id)->first();
        $status->status_fisibility='approved';
        $status->save();

        return redirect()->route('formula.feasibility');
    }

    public function workbookFS($wb){
        $workbook = Formula::where('id',$wb)->first();
        $myFormula = tipp::where('id_pkp',$workbook->workbook_id)->first();
        $hitungkemas = workbook_kemas::where('id_formula',$workbook->id)->count();
        $hitunglab = workbook_lab::where('id_formula',$workbook->id)->count();
        $hitungmaklon = workbook_maklon::where('id_formula',$workbook->id)->count();
        $datakemas = workbook_kemas::where('id_formula',$workbook->id)->get();
        $datalab = workbook_lab::where('id_formula',$workbook->id)->get();
        $datamaklon = workbook_maklon::where('id_formula',$workbook->id)->get();
        $dataF = Finance::where('id_wb',$workbook->workbook_id)->where('id_formula',$wb)->get();
        $dF = Finance::where('id_wb',$workbook->workbook_id)->where('id_formula',$wb)->first();
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
