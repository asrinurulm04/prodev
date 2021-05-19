<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\PkpProject;
use App\model\pkp\ProjectPDF;
use App\model\pkp\Promo;
use App\model\pkp\SubPKP;
use App\model\master\Brand;
use Auth;
use DB;
use Redirect;

class ListProjectController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:marketing' || 'rule:user_produk'  || 'rule:kemas');
    }

    public function listpkp(){
        $pkp = SubPKP::where('status_data','=','active')->join('tr_project_pkp','tr_project_pkp.id_project','=','tr_sub_pkp.id_pkp')->where('status_project','!=','draf')->where('status_project','!=','sent')->orderBy('pkp_number','desc')->get();
        $brand = Brand::all();
        return view('devwb.listprojectpkp')->with([
            'brand' => $brand,
            'pkp' => $pkp
        ]);
    }

    public function listpdf(){
        $pdf = ProjectPDF::all();
        $brand = Brand::all();
        return view('devwb.listpdfproject')->with([
            'pdf' => $pdf,
            'brand' => $brand
        ]);
    }

    public function listpromo(){
        $promo = Promo::all();
        $brand = Brand::all();
        return view('devwb.listprojectpromo')->with([
            'promo' => $promo,
            'brand' => $brand
        ]);
    }

    public function dasboard(){
        $pkp = PkpProject::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $pkp1 = PkpProject::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapkp = $pkp + $pkp1;
        $pdf = ProjectPDF::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $pdf1 = ProjectPDF::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapdf = $pdf + $pdf1;
        $promo = Promo::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $promo1 = Promo::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapromo = $promo + $promo1;
        return view('devwb.dasboard')->with([
            'pkp' => $datapkp,
            'pdf' => $datapdf,
            'promo' => $datapromo
        ]);
    }
}