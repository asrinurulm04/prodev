<?php

namespace App\Http\Controllers\datamaster;

use App\master\Kelompok;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class KelompokController extends Controller
{

    public function index()
    {
        $kelompoks = Kelompok::all();
        return view('datamaster.kelompok')->with([
            'kelompoks' => $kelompoks
        ]);
    }

    public function store(Request $request)
    {
        $kelompok = new Kelompok;
        $kelompok->nama = $request->kelompok;
        $kelompok->save();

        return Redirect::back()->with('status','Kelompok '.$kelompok->nama.' Berhasil Dibuat !');
    }

    public function edit(Kelompok $kelompok)
    {
        return view('datamaster.editkelompok')->with([
            'kelompok' => $kelompok
        ]);
    }

    public function update(Request $request, Kelompok $kelompok)
    {
        $kelompok->nama = $request->kelompok;
        $kelompok->save();

        return Redirect()->route('kelompok.index')->with('status','Kelompok '.$kelompok->nama.' Berhasil DiUpdate !');
    }

    public function destroy(Kelompok $kelompok)
    {
        $kelompok->delete();
        return Redirect::back()->with('error','Kelompok '.$kelompok->nama.' Berhasil Dihapus');
    }
}