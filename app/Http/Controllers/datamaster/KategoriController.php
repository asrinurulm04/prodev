<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\master\Kategori;
use Redirect;

class KategoriController extends Controller
{
    public function index(){
        $kategoris = Kategori::all();
        return view('datamaster.kategori')->with([
            'kategoris' => $kategoris
        ]);
    }

    public function store(Request $request){
        $kategori = new Kategori;
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return Redirect::back()->with('status','Kategori '.$kategori->kategori.' Berhasil Ditambahkan');
    }
    
    public function update(Request $request, Kategori $kategori){
        $kategori->kategori = $request->kategori;
        $kategori->save();

        return Redirect()->route('kategori.index')->with('status','Kategori '.$kategori->kategori.' Berhasil DiUpdate');
    }

    public function destroy(Kategori $kategori){
        $kategori->delete();

        return Redirect::back()->with('error','Kategori '.$kategori->kategori.' Berhasil Dihapus');
    }
}