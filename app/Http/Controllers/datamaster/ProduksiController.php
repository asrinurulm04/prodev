<?php

namespace App\Http\Controllers\datamaster;

use App\master\Produksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class ProduksiController extends Controller
{

    public function index()
    {
        $produksis = Produksi::all();
        return view('datamaster.produksi')->with([
            'produksis' => $produksis
        ]);
    }

    public function store(Request $request)
    {
        $produksi = new Produksi;
        $produksi->produksi = $request->Produksi;
        $produksi->keterangan = $request->Keterangan;
        $produksi->save();

        return Redirect::back()->with('status','Produksi '.$produksi->produksi.' Berhasil Dibuat');

    }

    public function update(Request $request, Produksi $produksi)
    {
        $produksi->produksi = $request->Produksi;
        $produksi->keterangan = $request->Keterangan;
        $produksi->save();

        return Redirect()->route('produksi.index')->with('status','Produksi '.$produksi->produksi.' Berhasil DiUpdate');
    }

    public function destroy(Produksi $produksi)
    {
        $produksi->delete();
        return Redirect::back()->with('error','Produksi '.$produksi->produksi.' Berhasil Dihapus');

    }
}