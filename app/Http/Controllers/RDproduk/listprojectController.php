<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\PkpProject;
use App\model\pkp\SubPKP;
use App\model\pdf\ProjectPDF;
use App\model\promo\promo;
use App\model\master\Brand;
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
        $pkp   = PkpProject::where('status_project','=','active')->where('status_pkp','=','proses')->orwhere('status_pkp','=','close')->orderBy('pkp_number','desc')->get();
        $brand = Brand::all();
        return view('devwb.listprojectpkp')->with([
            'brand' => $brand,
            'pkp' => $pkp
        ]);
    }

    public function listpdf(){
        $pdf    = ProjectPDF::all();
        $brand  = Brand::all();
        return view('devwb.listpdfproject')->with([
            'pdf' => $pdf,
            'brand' => $brand
        ]);
    }

    public function listpromo(){
        $promo = promo::all();
        $brand = Brand::all();
        return view('devwb.listprojectpromo')->with([
            'promo' => $promo,
            'brand' => $brand
        ]);
    }
}