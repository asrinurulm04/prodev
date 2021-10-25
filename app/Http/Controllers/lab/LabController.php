<?php

namespace App\Http\Controllers\lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\model\Modellab\Dlab;
use App\model\Modellab\DataLab;
use App\model\Modellab\analisa;
use App\model\Modellab\ItemDesc;
use App\model\pkp\PkpProject;
use App\model\formula\Formula;
use App\model\Modelmesin\IO;
use Redirect;

class LabController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:lab');
    }

    public function index($id,$fs){
        $desc   = ItemDesc::all();
        $pkp    = PkpProject::where('id_project',$id)->first();
        return view('lab.datalab')->with([
            'pkp'   => $pkp,
            'desc'  => $desc,
            'fs'    => $fs
        ]);
    }

    public function AddItem($id,$fs){
        $io     = IO::all();
        $pkp    = PkpProject::where('id_project',$id)->first();
        return view('lab.add_item')->with([
            'pkp'   => $pkp,
            'io'    => $io,
            'fs'    => $fs
        ]);
    }

    public function add(Request $request){
        $item = new ItemDesc;
        $item->io=$request->io;
        $item->lokasi=$request->lokasi;
        $item->item_desc=$request->item;
        $item->biaya_analisa_tahun=$request->biaya_analisa_tahun;
        $item->total_batch=$request->total_batch;
        $item->mikro_analisa=$request->mikro_analisa;
        $item->spl_batch=$request->spl_batch;
        $item->analisa_swab=$request->analisa_swab;
        $item->sample_swab=$request->sample_swab;
        $item->biaya_tahanan=$request->biaya_tahanan;
        $item->parameter_mikro=$request->parameter_mikro;
        $item->kimia_batch=$request->kimia_batch;
        $item->sample_analisa=$request->sample_analisa;
        $item->biaya_analisa=$request->biaya_analisa;
        $item->jlh_sample_mikro=$request->jlh_sample_mikro;
        $item->jlh_mikro_tahunan=$request->jlh_mikro_tahunan;
        $item->save();

        return redirect::route('datalab',[$request->project,$request->fs]);
    }
}