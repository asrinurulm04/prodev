<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\dev\Bahan;
use App\model\master\Satuan;
use App\model\master\Subkategori;
use App\model\master\Curren;
use App\model\master\Kelompok;
use App\model\users\User;
use Redirect;
use DB;

class BahanBakuController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:admin' || 'rule:user_produk');
    }

    public function bahan(){
        $bahans = Bahan::where('status_bb','eksis')->get();
        $satuans = Satuan::all();
        $subkategoris = Subkategori::all();
        $currens = Curren::all();
        return view('datamaster.bahanbaku')->with([
            'bahans' => $bahans,
            'satuans' =>$satuans,
            'subkategoris' => $subkategoris,
            'currens' => $currens
        ]);
    }

    public function active($id){
        $bahan = Bahan::where('id',$id)->first();
        $bahan->status = 'active';
        $bahan->save();

        return Redirect::back()->with('status','Status '.$bahan->nama_sederhana.' Active!');
    }

    public function nonactive($id){
        $bahan = Bahan::where('id',$id)->first();
        $bahan->update(['status'=>'inactive']);

        return Redirect::back()->with('error','Status '.$bahan->nama_sederhana.' NonActive!');
    }
}
