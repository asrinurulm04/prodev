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
        $subkategoris = Subkategori::all();
        $kategoris = Kategori::all();
        return view('datamaster.subkategori')->with([
            'subkategoris' => $subkategoris,
            'kategoris' =>$kategoris
        ]);
    }

    public function store(Request $request)
    {
        $subkategori = new Subkategori;
        $subkategori->subkategori = $request->subkategori;
        $subkategori->kategori_id = $request->kategori;
        $subkategori->pembulatan = $request->pembulatan;
        $subkategori->save();

        return Redirect::back()->with('status','Subkategori '.$subkategori->subkategori.' Berhasil Dibuat');
    }

    public function edit(Subkategori $subkategori){
        $kategoris = Kategori::all();
        return view('datamaster.editsubkategori')->with([
            'kategoris' =>$kategoris
        ]);
    }

    public function update(Request $request, Subkategori $subkategori){
        $subkategori->subkategori = $request->subkategori;
        $subkategori->kategori_id = $request->kategori;
        $subkategori->pembulatan = $request->pembulatan;
        $subkategori->save();

        return Redirect()->route('subkategori.index')->with('status','Subkategori '.$subkategori->subkategori.' Telah DiUpdate');
    }

    public function destroy(Subkategori $subkategori){
        $subkategori->delete();
        return Redirect::back()->with('error','Subkategori '.$subkategori->subkategori.' Berhasil Dihapus !');

    }
}