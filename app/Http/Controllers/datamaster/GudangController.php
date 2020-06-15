<?php

namespace App\Http\Controllers\datamaster;

use App\master\Gudang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class GudangController extends Controller
{

    public function index()
    {
        $gudangs = Gudang::all();
        return view('datamaster.datagudang')->with([
            'gudangs' => $gudangs
        ]);
    }

    public function store(Request $request)
    {
        $gudang = new Gudang;
        $gudang->gudang = $request->gudang;
        $gudang->keterangan = $request->keterangan;
        $gudang->save();

        return Redirect::back()->with('status','Gudang '.$gudang->gudang.' Berhasil Dibuat');
    }

    public function edit(Gudang $gudang)
    {
        return view('datamaster.editgudang')->with([
            'gudang' => $gudang
        ]);
    }

    public function update(Request $request, Gudang $gudang)
    {
        $gudang->gudang = $request->gudang;
        $gudang->keterangan = $request->keterangan;
        $gudang->save();

        return Redirect()->route('gudang.index')->with('status','Gudang '.$gudang->gudang.' Berhasil Diupdate');
    }

    public function destroy(Gudang $gudang)
    {
        $gudang->delete();

        return Redirect::back()->with('error','Gudang '.$gudang->gudang.' Berhasil Dihapus !');
    }
}