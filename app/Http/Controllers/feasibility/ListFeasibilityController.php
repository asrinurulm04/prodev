<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modelfn\finance;
use App\Modelfn\pesan;
use App\dev\Formula;
use Redirect;

class ListFeasibilityController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($id){
        $myFormula = Formula::where('id',$id)->first();
        $dataF = finance::where('id_formula',$id)->get();
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

        $status  = formula::where('id',$id)->first();
            $status->status_fisibility='approved';
            $status->save();

        return redirect()->route('formula.feasibility');
    }
}
