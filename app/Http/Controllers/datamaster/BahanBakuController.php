<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\dev\Bahan;
use App\model\master\Satuan;
use App\model\master\Subkategori;
use App\model\master\Curren;
use App\model\master\Kelompok;

use App\User;
use Redirect;
use DB;

class BahanBakuController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:admin');
    }

    public function bahan(){
        $bahans = Bahan::all();
        $satuans = Satuan::all();
        $subkategoris = Subkategori::all();
        $currens = Curren::all();
        $kelompoks = Kelompok::all();
        $users = User::where('status','=','active')->get();
        return view('datamaster.bahanbaku')->with([
            'bahans' => $bahans,
            'satuans' =>$satuans,
            'subkategoris' => $subkategoris,
            'currens' => $currens,
            'kelompoks' => $kelompoks,
            'users' => $users]);
    }

    public function delbahan($id){
        $bahan = Bahan::where('id',$id)->first();
        $n = $bahan->nama_sederhana;
        $bahan->delete();

        return Redirect::back()->with('error', $n.' Telah Dihapus!');
    }

    public function active($id){
        $bahan = Bahan::find($id)->first();
        $bahan->status = 'active';
        $bahan->save();

        return Redirect::back()->with('status','Status '.$bahan->nama_sederhana.' Active!');
    }

    public function nonactive($id){
        $bahan = Bahan::find($id)->first();
        $bahan->update(['status'=>'nonactive']);

        return Redirect::back()->with('error','Status '.$bahan->nama_sederhana.' NonActive!');
    }

    public function addbahan(Request $request){
        $bahan = new Bahan;
        $bahan->nama_sederhana = $request->nama_sederhana;
        $bahan->nama_bahan = $request->nama_bahan;
        $bahan->kode_oracle = $request->kode_oracle;
        $bahan->kode_komputer = $request->kode_komputer;
        $bahan->supplier = $request->supplier;
        $bahan->principle = $request->principle;
        $bahan->no_HEIPBR = $request->no_HEIPBR;
        $bahan->PIC = $request->PIC;
        $bahan->cek_halal = $request->cek_halal;
        $bahan->subkategori_id = $request->subkategori;

        if (isset($request->c_kelompok)) {
            $id = DB::table('kelompoks')->insertGetId(
                [ 'nama' => $request->custom_kelompok]
            );
            $bahan->kelompok_id = $id;
        }else{                
            $bahan->kelompok_id = $request->kelompok;
        }

        $bahan->berat = $request->berat;
        $bahan->satuan_id = $request->satuan;
        $bahan->harga_satuan = $request->harga_satuan;
        $bahan->curren_id = $request->curren;
        $bahan->user_id = $request->user;
        $bahan->save();

        return Redirect::back()->with('status', $bahan->nama_sederhana.' Telah Ditambahkan!');
    }

    public function saveupdateBahan($id,Request $request){
        $bahan = Bahan::find($id)->first();
        $bahan->nama_sederhana = $request->nama_sederhana;
        $bahan->nama_bahan = $request->nama_bahan;
        $bahan->kode_oracle = $request->kode_oracle;
        $bahan->kode_komputer = $request->kode_komputer;
        $bahan->supplier = $request->supplier;
        $bahan->principle = $request->principle;
        $bahan->no_HEIPBR = $request->no_HEIPBR;
        $bahan->PIC = $request->PIC;
        $bahan->cek_halal = $request->cek_halal;
        $bahan->subkategori_id = $request->subkategori;
        $bahan->kelompok_id = $request->kelompok;
        $bahan->berat = $request->berat;
        $bahan->satuan_id = $request->satuan;
        $bahan->harga_satuan = $request->harga_satuan;
        $bahan->curren_id = $request->curren;
        $bahan->user_id = $request->user;
        $bahan->save();

        return Redirect()->route('bahanbaku')->with('status', $bahan->nama_sederhana.' Telah DiUpdate!');
    }
}
