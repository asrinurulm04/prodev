<?php

namespace App\Http\Controllers\RDkemas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\PkpProject;
use App\model\formula\Formula;
use App\model\Modelkemas\KonsepKemas;
use App\model\Modelkemas\FormulaKemas;
use App\model\feasibility\Feasibility;
use Redirect;
use Auth;

class KonsepController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:kemas');
    }

    public function index($id){
        $fs           = Feasibility::where('id_project',$id)->first();
        $pkp          = PkpProject::where('id_project',$id)->where('status_project','=','active')->first();
        $myFormula    = Formula::where('id',$fs->id_formula)->get();
        return view('RDkemas/konsep', compact('gramasi'))->with([
            'myFormula'     => $myFormula,
            'id'            => $id,
			'pkp'      => $pkp
        ]);
    }

    public function hasilnya(Request $request,$id, $id_feasibility){
        $formulas   = Formula::where('id',$id)->get();
        $request->session()->get('id_feasibility');
        $request->session()->put('id_feasibility', $id_feasibility);
        $id         = $request->session()->get('id_feasibility');
        $myFormula  = Formula::where('id',$id)->first();
        $konsep     = KonsepKemas::where('id_feasibility',$id_feasibility)->get();
        $data       = finance::where('id_feasibility', $id)->pluck('id_formula')->first();
        $fe         =finance::find($id_feasibility);
		$kemas      =FormulaKemas::where('id_feasibility', $id_feasibility)->get();
        $dataF      = finance::where('id_feasibility', $id_feasibility)->get();
        return view('kemas.has', compact('toImport'))->with([
            'fe'             => $fe,
            'dataF'          => $dataF,
            'kemas'          => $kemas,
            'id'             => $id,
            'konsep'         => $konsep,
            'data'           => $data,
            'myFormula'      => $myFormula,
            'id_feasibility' => $id_feasibility
        ]);
    }

    public function insert(Request $request){
        $kemass= new KonsepKemas;
        $kemass->konsep         = $request->get('konsepkemas');
        $kemass->keterangan     = $request->keterangan;
        $kemass->id_feasibility = $request->finance;
        $kemass->s_primer       = $request->get('primer');
        $kemass->primer         = $request->d;
        $kemass->user           = Auth::user()->name;
        $kemass->s_sekunder     = $request->get('sekunder');
        $kemass->sekunder       = $request->s;
        $kemass->s_tersier      = $request->get('tersier');
        $kemass->tersier        = $request->g;
        $kemass->s_tersier2     = $request->get('tersier2');
        $kemass->tersier2       = $request->t;
        $kemass->palet_batch    = $request->BP;
        $kemass->box_palet      = $request->BP;
        $kemass->box_layer      = $request->BL;
        $kemass->kubikasi       = $request->kubikasi;
        $kemass->batch          = $request->batch;
        $kemass->renceng        = $request->ren;
        $kemass->save();

        $change_status = finance::where('id_feasibility',$request->finance)->first();
		$change_status->status_kemas='sending';
		$change_status->save();

        return redirect()->back();
    }
}