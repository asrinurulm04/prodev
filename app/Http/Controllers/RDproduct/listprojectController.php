<?php

namespace App\Http\Controllers\RDproduct;

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
        $brand = Brand::select('brand')->get();
        return view('RDproduct.listprojectpkp')->with([
            'brand' => $brand,
            'pkp' => $pkp
        ]);
    }

    public function listpdf(){
        $pdf    = ProjectPDF::all();
        return view('RDproduct.listpdfproject')->with([
            'pdf' => $pdf
        ]);
    }

    public function listpromo(){
        $promo = promo::all();
        $brand = Brand::select('brand')->get();
        return view('RDproduct.listprojectpromo')->with([
            'promo' => $promo,
            'brand' => $brand
        ]);
    }
}