<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\devnf\storage;
use App\model\devnf\panel;
use App\model\devnf\hasilpanel;
use App\model\devnf\hasilstorage;
use App\model\dev\Formula;
use auth;
use redirect;

class storageController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function st($formula,$id){
        $formula = Formula::where('id',$id)->first();;
        $fo=Formula::where('id',$id)->first();;
        $panel =panel::all();
        $proses=hasilstorage::where('id_formula',$id)->get();
        $idfor = $formula->workbook_id;
        $pn = hasilpanel::all();
        $idf = $formula->id;
        $storage = storage::where('id_formula',$id)->get();
        $cek_storage =storage::where('id_formula',$id)->count();
        $cek_panel =hasilpanel::where('id_formula',$id)->count();
        return view('formula.storage')->with([
            'fo' => $fo,
            'idf' => $idf,
            'id' => $id,
            'idfor' => $idfor,
            'pn' => $pn,
            'storage' => $storage,
            'panel' => $panel,
            'proses' => $proses,
            'cek_panel' => $cek_panel,
            'formula' => $formula,
            'cek_storage' =>$cek_storage
        ]);
    }

    public function hasilnya(Request $request)
    {
        $add_st = new storage;
        $add_st->id_formula=$request->idf;
        $add_st->no_PST=$request->spt;
        $add_st->suhu=$request->suhu;
        $add_st->estimasi_selesai=$request->estimasi;
        $add_st->save();
        return redirect()->back();
    }

    public function proses(Request $request)
    {
        $add_proses= new hasilstorage;
        $add_proses->id_formula=$request->idf;
        $add_proses->id_storage=$request->storage;
        $add_proses->tgl_input=$request->input;
        $add_proses->proses=$request->progres;
        $add_proses->save();

        return redirect()->back()->with('status','proses storage'.' Telah ditambahkan! ');
    }

    public function editdata(request $request, $id)
    {
        $data_storage= storage::where('id',$id)->first();
        $data_storage->no_HSA=$request->hsa;
        $data_storage->keterangan=$request->kesimpulan;
        $data_storage->save();

        return redirect()->back();
    }

    public function delete($id){
        $storage = storage::where('id',$id)->delete();

        return redirect()->back()->with('status','proses storage'.' Telah Dihapus! ');
    }
}