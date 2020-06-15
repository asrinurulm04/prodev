<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dev\Formula;
use App\dev\Workbook;
use App\Modelfn\finance;
use Redirect;

class PengajuanFormulaController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }
    
    public function vp($id){
        $formula = Formula::find($id);
        $formula->vv = 'proses';
        $formula->status = 'proses';
        $formula->save();

        $myworkbook = Workbook::where('id',$formula->workbook_id)->first();
        $myworkbook->status = 'proses';
        $myworkbook->save();
        
        return Redirect::back()->with('status', 'Formula '.$formula->versi.'.'.$formula->turunan.' Telah Di Ajukan VP');
    }

    public function fs($id){
        $formula = Formula::find($id);
        $formula->status_fisibility = 'proses';
        $formula->vv = 'ok';
        $formula->save();

        // // Pengajuan/Pembuatan Row Finance
        $finance = new Finance;
        $finance->id_formula = $id;
        $finance->message = 'Pengajuan Feasibility Baru';
        $finance->save();

        // Change Status Workbook
        $myworkbook = Workbook::where('id',$formula->workbook_id)->first();
        $myworkbook->bintang = $formula->id;
        $myworkbook->status = 'proses';
        $myworkbook->save();
        
        return Redirect::back()->with('status', 'Formula '.$formula->versi.'.'.$formula->turunan.' Telah Di Ajukan Feasibility');
    }

    public function nf($id){
        $formula = Formula::find($id);
        $formula->status_nutfact = 'proses';
        $formula->status = 'proses';
        $formula->save();
        
        // Change Status Workbook
        $myworkbook = Workbook::where('id',$formula->workbook_id)->first();
        $myworkbook->bintang = $formula->id;
        $myworkbook->status = 'proses';
        $myworkbook->save();
        
        return Redirect::back()->with('status', 'Formula '.$formula->versi.'.'.$formula->turunan.' Telah Di Ajukan Nutfact');
    }
}