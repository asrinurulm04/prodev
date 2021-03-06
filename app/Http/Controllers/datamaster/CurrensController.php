<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\master\Curren;
use Redirect;

class CurrensController extends Controller
{
    public function index(){
        $currens = Curren::select('id','currency','keterangan','harga')->get();
        return view('datamaster.curren')->with([
            'currens' => $currens
        ]);
    }

    public function store(Request $request){ // menambahkan data curren baru
        $curren = new Curren;
        $curren->currency   = $request->currency;
        $curren->harga      = $request->harga;
        $curren->keterangan = $request->keterangan;
        $curren->save();

        return Redirect::back()->with('status','Currency '.$curren->currency.' Berhasil Dibuat');
    }

    public function update(Request $request, Curren $curren){
        $curren->currency   = $request->currency;
        $curren->harga      = $request->harga;
        $curren->keterangan = $request->keterangan;
        $curren->save();

        return Redirect()->route('curren.index')->with('status','Currency '.$curren->currency.' Berhasil DiUpdate');
    }
    
    public function destroy(Curren $curren){
        $curren->delete();
        return Redirect::back()->with('error','Currency '.$curren->currency.' Berhasil Dihapus');
    }
}