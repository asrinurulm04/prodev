<?php

namespace App\Http\Controllers\datamaster;

use App\master\Maklon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class MaklonController extends Controller
{

    public function index()
    {
        $maklons = Maklon::all();
        return view('datamaster.maklon')->with([
            'maklons' => $maklons
        ]);
    }

    public function store(Request $request)
    {
        $maklon = new Maklon;
        $maklon->maklon = $request->maklon;
        $maklon->keterangan = $request->keterangan;
        $maklon->save();

        return Redirect::back()->with('status','Maklon '.$maklon->maklon.' Telah Dibuat');
    }

    public function update(Request $request, Maklon $maklon)
    {
        $maklon->maklon = $request->maklon;
        $maklon->keterangan = $request->keterangan;
        $maklon->save();

        return Redirect()->route('maklon.index')->with('status','Maklon '.$maklon->maklon.' Telah DiUpdate');
    }

    public function destroy(Maklon $maklon)
    {
        $maklon->delete();

        return Redirect::back()->with('error','Maklon '.$maklon->maklon.' Berhasil Dihapus !');

    }
}