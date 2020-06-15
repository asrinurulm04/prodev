<?php

namespace App\Http\Controllers\devnf;
use App\nutfact\tb_parameter;
use App\devnf\tb_nutrition;
use App\dev\formula;
use App\devnf\tb_vitmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NutfactController extends Controller
{
    public function datapn(){
        $tampilkan = formula::with('Workbook')->where('status_nutfact','PROSES')->get();
        return view('devnf.datapn', compact('tampilkan'));
    }

    public function nb($id){
        //WORKBOOK
        $data       = formula::with('Workbook')->where('id',$id)->get();
        $ing        = tb_nutrition::with('get_bahan','get_btp')->get();
        $tampilkan  = tb_parameter::with('get_akg')->offset(23)->limit(84)->get();
        
        //NUTFACT BAYANGAN
        $vit_a      = tb_vitmin::select('target')->where('parameter','12')->get();
        $thi        = tb_vitmin::select('target')->where('parameter','2')->get();
        $rib        = tb_vitmin::select('target')->where('parameter','10')->get();
        $nia        = tb_vitmin::select('target')->where('parameter','3')->get();
        $b5         = tb_vitmin::select('target')->where('parameter','20')->get();
        $pyr        = tb_vitmin::select('target')->where('parameter','21')->get();
        $b7         = tb_vitmin::select('target')->where('parameter','11')->get();
        $b12        = tb_vitmin::select('target')->where('parameter','60')->get();
        $asam       = tb_vitmin::select('target')->where('parameter','4')->get();
        $vit_c      = tb_vitmin::select('target')->where('parameter','61')->get();
        $vit_d      = tb_vitmin::select('target')->where('parameter','62')->get();
        $vit_e      = tb_vitmin::select('target')->where('parameter','14')->get();
        $mag        = tb_vitmin::select('target')->where('parameter','47')->get();
        $man        = tb_vitmin::select('target')->where('parameter','16')->get();
        $zin        = tb_vitmin::select('target')->where('parameter','48')->get();
        $lod        = tb_vitmin::select('target')->where('parameter','22')->get();
        $zat        = tb_vitmin::select('target')->where('parameter','45')->get();
        $sel        = tb_vitmin::select('target')->where('parameter','49')->get();
        $mol        = tb_vitmin::select('target')->where('parameter','69')->get();
        $ino        = tb_vitmin::select('target')->where('parameter','68')->get();
        
        return view('devnf.nutfactbayangan', 
        compact('ing','tampilkan','AMC','AMC2','AMC3','AMC4','AMC5','AMC6','AMC7',
                'data','vit_a','thi','rib','nia','b5','pyr','b7','b12','asam','vit_c',
                'vit_d','vit_e','mag','man','zin','lod','zat','sel','mol','ino' ,'id'  ));
    }
}