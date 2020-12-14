<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\users\User;
use App\model\dev\Formula;
use App\model\dev\Fortail;
use App\model\dev\Premix;
use App\model\dev\Pretail;

class Step3Controller extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }
    
    public function create($formula,$id){
        $no = 0;
        $formula = Formula::where('id',$id)->first();
        $idfor = $formula->workbook_id;
        $idf = $formula->id;
        //dd($idf);
        $fortails = Fortail::where('formula_id',$id)->get();
        $premix = Premix::where('id',$id)->get();
        return view('formula/step3')->with([
            'no' => $no,
            'idf' => $idf,
            'idfor' => $idfor,
            'premix' => $premix,
            'fortails' => $fortails,
            'formula' => $formula
            ]);
    }

    public function insert($idf,Request $request){
        $c_premix = $request->c_premix;
        for($cp = 1 ; $cp<= $c_premix ; $cp++){
            $id = $request->prid[$cp];
            // Delete Last Pretail
            $del_pretail = Pretail::where('premix_id',$id)->get();
            foreach($del_pretail as $df){
                $df->delete();
            }
            
            // Insert Utuh CPB dan Koma CPB
            $myPremix = Premix::where('id',$id)->first();
            $myPremix->utuh_cpb = $request->utuh_cpb[$cp];
            $myPremix->koma_cpb = $request->koma_cpb[$cp];
            $myPremix->save();
            
            // Insert Pretail
            for($cpt = 1 ; $cpt <= 10 ; $cpt++){
                $myPretail = $request->ke[$cpt][$cp];
                $turunan = $request->turunan[$cpt];
                if($myPretail != ''){
                    if($turunan >= 1){
                        $myPretail = $myPretail/$turunan;
                        for($tur = 1 ; $tur <= $turunan; $tur++){
                            $pretail = new Pretail;
                            $pretail->premix_id = $myPremix->id;
                            $pretail->premix_ke = $cpt;
                            $pretail->turunan = $tur;
                            $pretail->save();
                        }                        
                    }
                    else if($turunan < 1 || $turunan == null)
                    {
                        $pretail = new Pretail;
                        $pretail->premix_id = $myPremix->id;
                        $pretail->premix_ke = $cpt;
                        $pretail->jumlah = $myPretail;
                        $pretail->save();
                    }
                }
            }
        }
    }
}