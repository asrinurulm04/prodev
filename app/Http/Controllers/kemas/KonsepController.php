<?php

namespace App\Http\Controllers\kemas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\dev\Formula;
use App\Modelfn\finance;
use App\Modelfn\pesan;
use App\Modelkemas\konsep;
use App\Modelkemas\userkemas;
use App\Modelkemas\gramasi;
use Redirect;
use Auth;

class KonsepController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:kemas');
    }

    public function index($id,$id_feasibility){
        $formulas = Formula::where('id',$id)->get();
        $fe=finance::find($id_feasibility);
        $myFormula = Formula::where('id',$id)->first();
        $konsep = konsep::where('id_feasibility',$id_feasibility)->get();
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $count_konsep = konsep::where('id_feasibility',$id_feasibility)->count();
        return view('kemas/konsep', compact('gramasi'))->with([
            'fe' => $fe,
            'dataF' => $dataF,
            'myFormula' => $myFormula,
            'id' => $id,
            'count_konsep' => $count_konsep,
            'konsep' => $konsep,
			'formulas' => $formulas,
            'id_feasibility' => $id_feasibility
        ]);
    }

    public function inboxkemas($id,$id_feasibility)
    {
        $inboxs = pesan::all()->where('user','kemas')->sortByDesc('created_at');
        $inbox = pesan::where('user','kemas');
        $jumlah = pesan::where('user','kemas')->count();
        $dataF = finance::with('formula')->get()->where('id_feasibility', $id_feasibility)->first();
        return view('kemas.inboxkemas')
        ->with(['id_feasibility' => $id_feasibility])
        ->with(['id' => $id])
        ->with(['jumlah' => $jumlah])
        ->with(['dataF' => $dataF])
        ->with(['inbox' => $inbox])
        ->with(['inboxs' => $inboxs]);
    }

    public function hasilnya(Request $request,$id, $id_feasibility)
    {
        $formulas = Formula::where('id',$id)->get();
        $request->session()->get('id_feasibility');
        $request->session()->put('id_feasibility', $id_feasibility);
        $id = $request->session()->get('id_feasibility');
        $myFormula = Formula::where('id',$id)->first();
        $data = finance::where('id_feasibility', $id)->pluck('id_formula')->first();
        $fe=finance::find($id_feasibility);
		$kemas =userkemas::where('id_feasibility', $id_feasibility)->get();
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        return view('kemas.has',['fe'=>$fe], compact('toImport'))
			->with(['dataF' => $dataF])
            ->with(['kemas' => $kemas])
            ->with(['id' => $id])
            ->with(['data' => $data])
            ->with(['myFormula' => $myFormula])
            ->with(['id_feasibility' => $id_feasibility]);
    }

    public function insert(Request $request){
        $kemass= new konsep;
        $kemass->konsep=$request->get('konsepkemas');
        $kemass->id_feasibility=$request->finance;
        $kemass->s_primer=$request->get('primer');
        $kemass->primer=$request->d;
        $kemass->user=Auth::user()->name;
        $kemass->s_sekunder=$request->get('sekunder');
        $kemass->sekunder=$request->s;
        $kemass->s_tersier=$request->get('tersier');
        $kemass->tersier=$request->g;
        $kemass->s_tersier2=$request->get('tersier2');
        $kemass->tersier2=$request->t;
        $kemass->palet_batch=$request->BP;
        $kemass->box_palet=$request->BP;
        $kemass->box_layer=$request->BL;
        $kemass->kubikasi=$request->kubikasi;
        $kemass->batch=$request->batch;
        $kemass->renceng=$request->ren;
        $kemass->save();

        return redirect()->back();
    }

    public function destroykemas($id)
    {
        $mail = pesan::find($id);
        $mail->delete();
        return redirect::back();
    }
}
