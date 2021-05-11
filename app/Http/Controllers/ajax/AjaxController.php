<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\dev\Bahan;
use App\model\nutfact\BPOM;
use DB;

class AjaxController extends Controller
{
    public function getAlternatif($id){
        $prioritas  = Bahan::where('id',$id)->first();
        $alternatif = DB::table('ms_bahans')->pluck('nama_sederhana','id');
        return json_encode($alternatif);
    }

    public function getSubbrand($id){
        $subbrand = DB::table('ms_subbrands')->where('brand_id',$id)->pluck('subbrand','id');
        return json_encode($subbrand);
    }

    public function selectAjax(Request $request){
    	if($request->ajax()){
    		$kategori = DB::table('ms_kategori')->where('id_jenis',$request->id_jenis)->pluck("nama_kategori","id")->get();
    		$data = view('ajax-select',compact('kategori'))->render();
            return response()->json($data);  
    	}
    }

    public function getpangan($id_pangan){
        $pangan = DB::table('ms_data_pangan')->where('id_pangan',$id_pangan)->pluck('pangan','id_pangan');
        return json_encode($pangan);
    }

    public function getkatpangan($id_pangan){
        $pangan = DB::table('ms_data_pangan')->where('id_pangan',$id_pangan)->pluck('no_kategori','id_pangan');
        return json_encode($pangan);
    }

    public function getjenismikro($id_pangan){
        $pangan = DB::table('ms_jenis_mikroba')->where('id_pangan',$id_pangan)->get();
        return json_encode($pangan);
    }

    public function getolahan($id_pangan){
        $pangan = DB::table('ms_pangan_olahan')->where('id_pangan',$id_pangan)->pluck('pangan_olahan','id');
        return json_encode($pangan);
    }

    public function getkomponen($id){
        $komponen = DB::table('ms_klaim')->where('id_komponen',$id)->pluck('klaim','id');
        return json_encode($komponen);
    }

    public function getdetailklaim($id){
        $detail = DB::table('ms_detail_klaim')->where('id_komponen',$id)->pluck('detail','id');
        return json_encode($detail);
    }

    public function subkategori($id){
        $kategori = DB::table('ms_subkategoris')->where('kategori_id',$id)->pluck('subkategori','id');
        return json_encode($kategori);
    }
    
    public function index(){
        $mesins = Mesin::all();
        return response()->json($mesins);
    }

    public function store(Request $request){
        $mesin = DataMesin::create($request->all());
        return response()->json($mesin);
    }
    
    public function update(Request $request, $id){
        $mes = DataMesin::find($id)->update($request->all());
        return response()->json($mes);
    }

    public function destroy($id){
        DataMesin::find($id)->delete();
        return response()->json(['done']);
    }
}