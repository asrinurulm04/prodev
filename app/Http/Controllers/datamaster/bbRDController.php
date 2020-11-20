<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\master\bahan_rd;
use App\master\Satuan;
use App\master\kategori;
use App\master\Subkategori;
use App\master\Curren;
use App\master\Kelompok;

use App\User;
use Redirect;
use DB;

class bbRDController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:admin' || 'rule:user_produk');
    }

    public function bahan(){
        $bahans = bahan_rd::all();
        $satuans = Satuan::all();
        $kategori = kategori::all();
        $subkategoris = Subkategori::all();
        $currens = Curren::all();
        $kelompoks = Kelompok::all();
        $users = User::where('status','=','active')->get();
        return view('datamaster.bb_rd')->with([
            'bahans' => $bahans,
            'satuans' =>$satuans,
            'subkategoris' => $subkategoris,
            'kategori' => $kategori,
            'currens' => $currens,
            'kelompoks' => $kelompoks,
            'users' => $users]);
    }

    public function addbahanrd(Request $request){
        $bahan = new bahan_rd;
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

    public function delbahanrd($id){
        $bahan = bahan_rd::where('id_bahan',$id)->first();
        $n = $bahan->nama_bahan;
        $bahan->delete();

        return Redirect::back()->with('error', $n.' Telah Dihapus!');
    }

    public function editBBrd($id,Request $request){
        $bahan = bahan_rd::find($id)->first();
        $bahan->nama_bahan = $request->nama_bahan;
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

        return Redirect()->route('bbrd')->with('status', $bahan->nama_bahan.' Telah DiUpdate!');
    }
}
