<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\pkp_type;
use App\model\pkp\pkp_project;
use App\model\pkp\project_pdf;
use App\model\pkp\data_forecast;
use App\model\master\Brand;
use App\model\pkp\klaim;
use App\model\pkp\kemaspdf;
use App\model\pkp\detail_klaim;
use App\model\pkp\komponen;
use App\model\pkp\data_klaim;
use App\model\pkp\data_detail_klaim;
use App\model\pkp\data_ses;
use App\model\pkp\promo;
use App\model\pkp\data_promo;
use App\model\pkp\coba;
use App\model\pkp\tipp;

use Auth;
use DB;
use Redirect;

class listprojectController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:marketing' || 'rule:user_produk'  || 'rule:kemas');
    }

    public function listpkp(){
        $pkp = pkp_project::where('status_project','!=','draf')->where('status_project','!=','sent')->orderBy('pkp_number','desc')->get();
        $type = pkp_type::all();
        $brand = brand::all();
        $hitungpkp = tipp::where('status_pkp','=','draf')->count();
        $hitungpromo = data_promo::where('status_promo','=','draf')->count();
        $hitungpdf = coba::where('status_data','=','draf')->count();
        $jumlah = $hitungpkp+$hitungpromo+$hitungpdf;
        return view('devwb.listprojectpkp')->with([
            'type' => $type,
            'brand' => $brand,
            'pkp' => $pkp,
            'hitungpkp' => $hitungpkp,
            'hitungpromo' => $hitungpromo,
            'hitungpdf' => $hitungpdf,
            'jumlah' => $jumlah
        ]);
    }

    public function listpdf(){
        $pdf = project_pdf::all();
        $type = pkp_type::all();
        $brand = brand::all();
        $hitungpkp = tipp::where('status_pkp','=','draf')->count();
        $hitungpromo = data_promo::where('status_promo','=','draf')->count();
        $hitungpdf = coba::where('status_data','=','draf')->count();
        $jumlah = $hitungpkp+$hitungpromo+$hitungpdf;
        return view('devwb.listpdfproject')->with([
            'type' => $type,
            'pdf' => $pdf,
            'brand' => $brand,
            'hitungpkp' => $hitungpkp,
            'hitungpromo' => $hitungpromo,
            'hitungpdf' => $hitungpdf,
            'jumlah' => $jumlah
        ]);
    }

    public function listpromo(){
        $promo = promo::all();
        $brand = brand::all();
        return view('devwb.listprojectpromo')->with([
            'promo' => $promo,
            'brand' => $brand
        ]);
    }

    public function dasboard(){
        $pkp = pkp_project::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $pkp1 = pkp_project::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapkp = $pkp + $pkp1;
        $pdf = project_pdf::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $pdf1 = project_pdf::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapdf = $pdf + $pdf1;
        $promo = promo::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $promo1 = promo::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapromo = $promo + $promo1;
        return view('devwb.dasboard')->with([
            'pkp' => $datapkp,
            'pdf' => $datapdf,
            'promo' => $datapromo
        ]);
    }
}
