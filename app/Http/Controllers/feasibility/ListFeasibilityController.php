<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Modelfn\finance;
use App\model\dev\Formula;
use App\model\pkp\SubPKP;
use Redirect;

class ListFeasibilityController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function deletefs ($id){
        $fs = finance::find($id);
        $fs->delete();
        return redirect::back()->with('message', 'Data berhasil dihapus!');
    }

    public function kirimWB(Request $request,$id,$id_feasibility)
    {
        $change_status = finance::where('kemungkinan',$request->get('dropdown'))->first();
        $change_status->status_feasibility='selesai';
        $change_status->save();

        $status = Formula::where('id',$id)->first();
        $status->status_fisibility='approved';
        $status->save();

        return redirect()->route('formula.feasibility');
    }

    public function workbookFS($wb){
        $workbook     = Formula::where('id',$wb)->first();
        $myFormula    = SubPKP::where('id_pkp',$workbook->workbook_id)->first();
        $hitungkemas  = workbook_kemas::where('id_formula',$workbook->id)->count();
        $hitunglab    = workbook_lab::where('id_formula',$workbook->id)->count();
        $hitungmaklon = workbook_maklon::where('id_formula',$workbook->id)->count();
        $datakemas    = workbook_kemas::where('id_formula',$workbook->id)->get();
        $datalab      = workbook_lab::where('id_formula',$workbook->id)->get();
        $datamaklon   = workbook_maklon::where('id_formula',$workbook->id)->get();
        $dataF        = finance::where('id_wb',$workbook->workbook_id)->where('id_formula',$wb)->get();
        $dF           = finance::where('id_wb',$workbook->workbook_id)->where('id_formula',$wb)->first();
        return view('workbookfs.workbook')->with([
            'myFormula'    => $myFormula,
            'wb'           => $wb,
            'for'          => $dF,
            'hitungkemas'  => $hitungkemas,
            'hitunglab'    => $hitunglab,
            'hitungmaklon' => $hitungmaklon,
            'datakemas'    => $datakemas,
            'datalab'      => $datalab,
            'datamaklon'   => $datamaklon,
            'dataF'        => $dataF
        ]);
    }
}