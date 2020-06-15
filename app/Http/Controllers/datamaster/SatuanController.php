<?php

namespace App\Http\Controllers\datamaster;

use App\master\Satuan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class SatuanController extends Controller
{

    public function index()
    {
        $satuans = Satuan::all();
        return view('datamaster.satuan')->with([
            'satuans' => $satuans
        ]);
    }

    public function store(Request $request)
    {
        $satuan = new Satuan;
        $satuan->satuan = $request->satuan;
        $satuan->save();

        return Redirect::back()->with('status','Satuan '.$satuan->satuan.' Berhasil Dibuat');
    }

    public function update(Request $request, Satuan $satuan)
    {
        $satuan->satuan = $request->satuan;
        $satuan->save();

        return Redirect()->route('satuan.index')->with('status','Satuan '.$satuan->satuan.' Berhasil DiUpdate');
    }

    public function destroy(Satuan $satuan)
    {
        $satuan->delete();

        return Redirect::back()->with('error','Satuan '.$satuan->satuan.' Telah Dihapus !');

    }
}