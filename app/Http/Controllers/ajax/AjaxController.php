<?php

namespace App\Http\Controllers\ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\formula\Bahan;
use App\model\Modelmesin\Mesin;
use App\model\Modelmesin\datamesin;
use DB;

class AjaxController extends Controller
{
    public function getAlternatif($id){ //data bahan baku untuk ualternatif workbook
        $prioritas  = Bahan::where('id',$id)->first();
        $alternatif = DB::table('ms_bahans')->pluck('nama_sederhana','id');
        return json_encode($alternatif);
    }

    public function getSubbrand($id){ // mangambil data subbrand
        $subbrand = DB::table('ms_subbrands')->where('brand_id',$id)->pluck('subbrand','id');
        return json_encode($subbrand);
    }

    public function selectAjax(Request $request){
    	if($request->ajax()){
    		$kategori = DB::table('ms_kategori')->where('id_jenis',$request->id_jenis)->pluck("nama_kategori","id")->get();
    		$data     = view('ajax-select',compact('kategori'))->render();
            return response()->json($data);  
    	}
    }

    public function getpangan($id_pangan){ //menarik data pangan
        $pangan = DB::table('ms_data_pangan')->where('id_pangan',$id_pangan)->pluck('pangan','id_pangan');
        return json_encode($pangan);
    }

    public function getkatpangan($id_pangan){ // menarik data kategori pangan
        $pangan = DB::table('ms_data_pangan')->where('id_pangan',$id_pangan)->pluck('no_kategori','id_pangan');
        return json_encode($pangan);
    }

    public function getjenismikro($id_pangan){ // menarik data jenis mikroba
        $pangan = DB::table('ms_jenis_mikroba')->where('id_pangan',$id_pangan)->get();
        return json_encode($pangan);
    }

    public function getitemdesc($id_item){ // menampilkan data item desc lab
        $pangan = DB::table('ms_item_desc')->where('id',$id_item)->get();
        return json_encode($pangan);
    }

    public function getolahan($id_pangan){ //menampilkan data olahan pangan
        $pangan = DB::table('ms_pangan_olahan')->where('id_pangan',$id_pangan)->pluck('pangan_olahan','id');
        return json_encode($pangan);
    }

    public function getkomponen($id){ // menampilkan data komponen
        $komponen = DB::table('ms_klaim')->where('id_komponen',$id)->pluck('klaim','id');
        return json_encode($komponen);
    }

    public function getdetailklaim($id){ // menampilkan data detail kliam
        $detail = DB::table('ms_detail_klaim')->where('id_komponen',$id)->pluck('detail','id');
        return json_encode($detail);
    }

    public function subkategori($id){ // menampilkan data sub kategoris
        $kategori = DB::table('ms_subkategoris')->where('kategori_id',$id)->pluck('subkategori','id');
        return json_encode($kategori);
    }
    
    public function index(){ //menampilkan seluruh data master mesin
        $mesins = Mesin::all();
        return response()->json($mesins);
    }

    public function store(Request $request){ // menampilkan data transaksi mesin
        $mesin = datamesin::create($request->all());
        return response()->json($mesin);
    }
    
    public function update(Request $request, $id){ // update data transaksi mesin
        $mes = datamesin::find($id)->update($request->all());
        return response()->json($mes);
    }

    public function destroy($id){ // menghapus data transaksi mesin
        datamesin::find($id)->delete();
        return response()->json(['done']);
    }
}