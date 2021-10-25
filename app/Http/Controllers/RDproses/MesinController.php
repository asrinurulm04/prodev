<?php

namespace App\Http\Controllers\RDproses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\model\Modelmesin\Mesin;
use App\model\Modelmesin\dataOH;
use App\model\Modelmesin\OH;
use App\model\Modelmesin\IO;
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

    public function index(Request $request,$id,$ws){
        $mesins     = DataMesin::all();
        $Mdata      = DB::table('tr_mesin')->join('ms_mesin','tr_mesin.id_data_mesin','=','ms_mesin.id_data_mesin')->where('id_wb_fs',$ws)->get();
        $hitung     = DB::table('tr_mesin')->where('id_wb_fs',$ws)->count();
        return view('RDproses.datamesin')->with([
            'mesins'        => $mesins,
            'Mdata'         => $Mdata,
            'id'            => $id,
            'ws'            => $ws,
            'hitung'        => $hitung
            ]);
    }

    public function AllergenBaru($id,$ws){
        $pkp    = PkpProject::where('id_project',$id)->first();
        return view('RDproses.allergenBaru')->with([
            'pkp'   => $pkp
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
        $dataO      = OH::where('id_ws',$ws)->get();
        $hitung     = DB::table('tr_dataoh')->where('id_ws',$ws)->count();
        return view('RDproses.dataoh')->with([
            'id'            => $id,
            'ws'            => $ws,
            'dataO'         => $dataO,
            'aktifitas'     => $aktifitas,
            'hitung'        => $hitung
        ]);
    }

    public function destroy($id){
        $mesin = Mesin::where('id_mesin',$id)->delete();
        return redirect::back()->with('alert', 'Data berhasil dihapus!');
    }

    public function destroyoh($id){
        $mesin = Oh::where('id',$id)->delete();
        return redirect::back()->with('message', 'Data berhasil dihapus!');
    }

    public function dataO(Request $request){
        $aktifitas= new OH;
        foreach ($request->input("oh") as $oh){
            $add_oh = new OH;
            $add_oh->id_ws = $request->id;
            $add_oh->id_oh = $oh;
            $add_oh->save();
        }
        return redirect()->back();
    }

    public function Mdata(Request $request){
        $ms= new Mesin;
        foreach ($request->input("pmesin") as $pmesin){
            $add_mesin = new Mesin;
            $add_mesin->id_wb_fs        = $request->id_ws;
            $add_mesin->id_data_mesin   = $pmesin;
            $add_mesin->save();
        }
    return redirect()->back();
    }

    public function runtime(Request $request){
        $scores = $request->input('scores');
        foreach($scores as $row){
            $mesin = Mesin::where('id_mesin',$row['id'])->update([
                "runtime" => $row['runtime'],
                "note"    => $row['note']
            ]);
        }

        return redirect::back();
    }

    public function runtimeoh(Request $request){
        $scores = $request->input('scores');
        foreach($scores as $row){
            $mesin = OH::where('id',$row['id'])->update([
                "runtime" => $row['runtime'],
                "note"    => $row['note']
            ]);
        }

        return redirect::back();
    }
}