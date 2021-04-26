<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\pkp_project;
use App\model\pkp\project_pdf;
use App\model\master\Brand;
use App\model\pkp\promo;
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
        $pkp = tipp::where('status_data','=','active')->join('tr_project_pkp','tr_project_pkp.id_project','=','tr_sub_pkp.id_pkp')->where('status_project','!=','draf')->where('status_project','!=','sent')->orderBy('pkp_number','desc')->get();
        $brand = brand::all();
        return view('devwb.listprojectpkp')->with([
            'brand' => $brand,
            'pkp' => $pkp
        ]);
    }

    public function listpdf(){
        $pdf = project_pdf::all();
        $brand = brand::all();
        return view('devwb.listpdfproject')->with([
            'pdf' => $pdf,
            'brand' => $brand
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