<?php

namespace App\Http\Controllers\RDproses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\model\Modelmesin\Mesin;
use App\model\Modelmesin\dataOH;
use App\model\Modelmesin\OH;
use App\model\Modelmesin\DataMesin;
use App\model\modelkemas\KonsepKemas;
use App\model\Modelkemas\FormulaKemas;
use App\model\feasibility\WorkbookFs;
use App\model\feasibility\Feasibility;
use App\model\formula\Formula;
use App\model\pkp\PkpProject;
use Auth;
use Redirect;

class MesinController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:manager');
    }

    public function index(Request $request,$id){
        $mesins     = DataMesin::all();
        $messin     = DB::table('ms_mesin')->select(['workcenter'])->distinct()->get();
        $Mdata      = DB::table('tr_mesin')
                    ->join('ms_mesin','tr_mesin.id_data_mesin','=','ms_mesin.id_data_mesin')->get();
        return view('RDproses.datamesin')->with([
            'mesins'        => $mesins,
            'Mdata'         => $Mdata,
            'id'            => $id,
            'messin'        => $messin
            ]);
    }

    public function index2(Request $request,$id,$ws){
        $fs         = Feasibility::where('id',$id)->first();
        $formulas   = Formula::where('id',$id)->get();
        $mesins     = DataMesin::all();
        $messin     = DB::table('ms_mesin')->select(['workcenter'])->distinct()->get();
        $Mdata      = DB::table('tr_mesin')
                    ->join('ms_mesin','tr_mesin.id_data_mesin','=','ms_mesin.id_data_mesin')->get();
        return view('RDproses.datamesin2')->with([
            'fs'            => $fs,
			'formulas'      => $formulas,
            'mesins'        => $mesins,
            'Mdata'         => $Mdata,
            'id'            => $id,
            'messin'        => $messin
            ]);
    }

    public function status(Request $request,$id, $id_feasibility){
        $statuss=finance::where('id_feasibility',$id_feasibility)->first();
        $statuss->status_mesin=$request->statusM;
        $statuss->save();
        return redirect()->route('myFeasibility',$id);
    }

    public function dataOH($id,$ws){
        $aktifitas  = dataOH::all();
        $dataO      = OH::with('dataoh')->get()->where('id_ws', $ws);
        return view('RDproses.dataoh')->with([
            'id'            => $id,
            'dataO'         => $dataO,
            'aktifitas'     => $aktifitas
        ]);
    }

    public function ubahdata(Request $request){
        foreach (array_combine($request->input('rate'), $request->input('no')) as $rate => $no){
            $data = Mesin::find($no);
            $data->rate_mesin= $rate;
            $data->save();
        }
        return redirect()->back();
     }
     
    public function dataO(Request $request){
        $aktifitas= new oh;
        foreach ($request->input("oh") as $oh){
            $add_oh = new oh;
            $add_oh->id_feasibility = $request->finance;
            $add_oh->rate_aktifitas = $request->rateoh;
            $add_oh->id_aktifitasOH = $oh;
            $add_oh->save();
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id){
        $request->session()->forget('references');
        $mesin = DataMesin::find($id);
        $mesin->delete();

        return redirect::back()->with('alert', 'Data berhasil dihapus!');
    }

    public function destroyoh($id){
        $mesin = oh::find($id);
        $mesin->delete();
        return redirect::back()->with('message', 'Data berhasil dihapus!');
    }

    public function Mdata(Request $request){
        $ms= new DataMesin;
        foreach ($request->input("pmesin") as $pmesin){
            $add_mesin = new DataMesin;
            $add_mesin->id_feasibility  = $request->finance;
            $add_mesin->rate_mesin      = $request->rate;
            $add_mesin->standar_sdm     = $request->standar;
            $add_mesin->line            = $request->jlh_line;
            $add_mesin->id_data_mesin   = $pmesin;
            $add_mesin->user1           = Auth::user()->name;
            $add_mesin->runtime         = $request->hasil;
            $add_mesin->hasil           = $request->jumlah;
            $add_mesin->SDM             = $request->sdm;
            $add_mesin->save();
            $id                         = DataMesin::orderBy('created_at', 'desc')->pluck('id_feasibility')->first();
            $data                       = DB::table('fs_datamesin')
                                        ->leftjoin('tr_mesin','tr_mesin.id_data_mesin','=','fs_datamesin.id_data_mesin')
                                        ->rightjoin('tr_feasibility','tr_mesin.id_feasibility','=','tr_feasibility.id_feasibility')
                                        ->rightjoin('formulas','tr_feasibility.id_formula','=','formulas.id')
                                        ->where([['tr_feasibility.id_feasibility', $id]])->first();
            $request->session()->push('references', $data);
        }
    return redirect()->back();
    }

    public function createDMmesin(Request $request){
        $Dm= new Mesin;
        $Dm->workcenter     = $request->workcenter;
        $Dm->rate_mesin     = $request->rate;
        $Dm->kategori       = $request->kategori;
        $Dm->IO             = $rfinanceequest->aktifitas;
        $Dm->gedung         = $request->gedung;
        $Dm->jlh_line       = $request->line;
        $Dm->standar_sdm    = $request->sdm;
        $Dm->nama_kategori  = $request->Nkategori;
        $Dm->nama_mesin     = $request->mesin;
        $Dm->save();

        return redirect()->back();
    }
}