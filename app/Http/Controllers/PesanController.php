<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Pesan;
use Redirect;
use App\dev\Formula;

class PesanController extends Controller
{
    public function __construct(){        
        $this->middleware('auth');
    }   
    
    public function send(Request $request){
        
        $pesan = new Pesan;
        $pesan->workbook_id = $request->workbook_id;
        if($request->formula_id != 'no'){
            $pesan->formula_id = $request->formula_id;
            $myformula = Formula::where('id',$request->formula_id)->first();  
                $pesan->untuk = $myformula->versi;
                if($myformula->turunan  != ''){
                    $pesan->untuk = $myformula->versi.'.'.$myformula->turunan;
                }
        }
        elseif($request->formula_id == 'no'){
            $pesan->untuk = "For All";
        }
        $pesan->pengirim = Auth::user()->name;
        $pesan->jenis = $request->jenis;
        $pesan->jenis2 = $request->jenis2;
        $pesan->pesan = $request->pesan;
        $pesan->save();

        return Redirect::back()->with('status','Pesan Telah Dikirim');
    }
}