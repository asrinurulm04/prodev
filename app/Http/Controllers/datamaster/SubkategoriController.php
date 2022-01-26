<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\master\Subkategori;
use App\model\master\Kategori;
use Redirect;

class SubkategoriController extends Controller
{
    public function index(){
        $subkategoris = Subkategori::select('subkategori','id','kategori_id')->get();
        $kategoris    = Kategori::select('kategori','id')->get();
        return view('datamaster.subkategori')->with([
            'subkategoris' => $subkategoris,
            'kategoris'    => $kategoris
        ]);
    }

    public function store(Request $request){
        $subkategori = new Subkategori;
        $subkategori->subkategori = $request->subkategori;
        $subkategori->kategori_id = $request->kategori;
        $subkategori->save();

        return Redirect::back()->with('status','Subkategori '.$subkategori->subkategori.' Berhasil Dibuat');
    }
    
    public function update(Request $request, Subkategori $subkategori){
        $subkategori->subkategori = $request->subkategori;
        $subkategori->kategori_id = $request->kategori;
        $subkategori->save();

        return Redirect()->route('subkategori.index')->with('status','Subkategori '.$subkategori->subkategori.' Telah DiUpdate');
    }
}