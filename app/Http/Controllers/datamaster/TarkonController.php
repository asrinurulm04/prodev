<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\master\Tarkon;
use Redirect;

class TarkonController extends Controller
{
    public function index(){
        $tarkons = Tarkon::all();
        return view('datamaster.tarkon')->with([
            'tarkons' => $tarkons
        ]);
    }

    public function store(Request $request){
        $tarkon = new Tarkon;
        $tarkon->tarkon = $request->tarkon;
        $tarkon->dari = $request->dari;
        $tarkon->sampai = $request->sampai;
        $tarkon->save();

        return Redirect::back()->with('status','Target Konsumen '.$tarkon->tarkon.' Berhasil Dibuat !');
    }

    public function edit(Tarkon $tarkon){
        return view('datamaster.edittarkon')->with([
            'tarkon' => $tarkon
        ]);
    }

    public function update(Request $request, Tarkon $tarkon){
        $tarkon->tarkon = $request->tarkon;
        $tarkon->dari = $request->dari;
        $tarkon->sampai = $request->sampai;
        $tarkon->save();

        return Redirect()->route('tarkon.index')->with('status','Target Konsumen '.$tarkon->tarkon.' Berhasil Diupdate !');
    }

    public function destroy(Tarkon $tarkon){
        $tarkon->delete();
        return Redirect::back()->with('error','Target Konsumen '.$tarkon->tarkon.' Telah Dihapus !');

    }
}