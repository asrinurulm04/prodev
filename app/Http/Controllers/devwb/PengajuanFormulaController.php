<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dev\Formula;
use App\dev\Workbook;
use App\Modelfn\finance;
use App\pkp\tipp;
use App\dev\Fortail;
use App\dev\Premix;
use App\dev\Pretail;
use App\pkp\pkp_project;
use Redirect;

class PengajuanFormulaController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }
    
    public function vp($wb,$id){
        $formula = Formula::where('workbook_id',$wb)->where('id',$id)->first();
        $ada = Fortail::where('formula_id',$formula->id)->count();
        if($ada < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.' Masih Kosong');
        }elseif($formula->batch < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.'.'.$formula->turunan.' Belum Memliki Batch');
        }

        $formula = Formula::where('id',$id)->first();
        $formula->vv = 'proses';
        $formula->status = 'proses';
        $formula->save();

        $pkp = tipp::where('id_pkp',$wb)->first();
        //dd($wb);
        $data = pkp_project::where('id_project',$pkp->id_pkp)->first();
        $data->pengajuan_sample='sent';
        $data->save();
        
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