<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\dev\Bahan;
use App\model\nutfact\bpom_mikrobiologi;
use DB;

class getGet extends Controller
{
    public function getAlternatif($id){
        $prioritas  = Bahan::where('id',$id)->first();
        $alternatif = DB::table('bahans')->pluck('nama_sederhana','id');
        return json_encode($alternatif);
    }

    public function getSubbrand($id){
        $subbrand = DB::table('subbrands')->where('brand_id',$id)->pluck('subbrand','id');
        return json_encode($subbrand);
    }

    public function selectAjax(Request $request){
    	if($request->ajax()){
    		$kategori = DB::table('data_kategori')->where('id_jenis',$request->id_jenis)->pluck("nama_kategori","id")->get();
    		$data = view('ajax-select',compact('kategori'))->render();
            return response()->json($data);  
    	}
    }

    public function getpangan($id_pangan){
        $pangan = DB::table('fs_bpom_mikrobiologi')->where('id_pangan',$id_pangan)->pluck('kategori','id_pangan');
        return json_encode($pangan);
    }

    public function getkatpangan($id_pangan){
        $pangan = DB::table('fs_bpom_mikrobiologi')->where('id_pangan',$id_pangan)->pluck('no_kategori','id_pangan');
        return json_encode($pangan);
    }

    public function getjenismikro($id_pangan){
        $pangan = DB::table('fs_jenismikroba')->where('id_pangan',$id_pangan)->get();
        return json_encode($pangan);
    }

    public function getolahan($id_pangan){
        $pangan = DB::table('pangan_olahan')->where('id_pangan',$id_pangan)->pluck('pangan_olahan','id');
        return json_encode($pangan);
    }

    public function getkomponen($id){
        $komponen = DB::table('klaim')->where('id_komponen',$id)->pluck('klaim','id');
        return json_encode($komponen);
    }

    public function getdetailklaim($id){
        $detail = DB::table('detail_klaim')->where('id_komponen',$id)->pluck('detail','id');
        return json_encode($detail);
    }

    public function subkategori($id){
        $kategori = DB::table('subkategoris')->where('kategori_id',$id)->pluck('subkategori','id');
        return json_encode($kategori);
    }
    
}