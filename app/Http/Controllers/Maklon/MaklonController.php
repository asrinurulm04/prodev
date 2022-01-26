<?php

namespace App\Http\Controllers\Maklon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Modelmaklon\Maklon;
use App\model\feasibility\Feasibility;

use Redirect;

class MaklonController extends Controller
{
    public function FsMaklon(Request $request, $fs){
        $hitung = Maklon::where('id_fs',$fs)->count();
        if($hitung=='0'){
            $maklon = new Maklon;
        }elseif($hitung!=0){
            $maklon = Maklon::where('id_fs',$fs)->first();
        }
        $maklon->id_fs              = $request->id_fs;
        $maklon->biaya_maklon       = $request->biaya;
        $maklon->satuan             = $request->satuan;
        $maklon->remarks_biaya      = $request->remarks_biaya;
        $maklon->biaya_transport    = $request->transportasi;
        $maklon->remarks_transport  = $request->remarks_transport;
        $maklon->save();

        $fs = Feasibility::where('id',$fs)->first();
        $fs->status_maklon = 'sending';
        $fs->save();

        return redirect::back()->with('status','Successfully');
    }
}
