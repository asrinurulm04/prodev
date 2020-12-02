<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dev\Fortail;
use App\dev\Bahan;
use App\dev\Premix;
use App\dev\Formula;
use App\dev\Pretail;
use Auth;

class EditFortailController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }
        
    public function index($id,$for)
    {    
        $fortail = Fortail::where('id',$id)->get();
        $edit = Fortail::where('id',$id)->get();
        $fortails = Fortail::where('id',$id)->first();
        $for = formula::where('id',$fortails->formula_id)->get();
        $idf = $fortails->formula_id;
        $myprioritas = Bahan::where('id',$fortails->bahan_id)->first();
        $bahans = Bahan::where('status','active')->orWhere('user_id',Auth::id())->get();
        $alternatifs = Bahan::where('subkategori_id',$myprioritas->subkategori_id)->get();
        $count_bahan = 8;
        for($i = 2;$i<=8;$i++){
            $ask = 'alternatif'.$i;
            $ii=$i-1;
            if($fortails->$ask == null){
                $count_bahan--;
            }
        }
        $count_alternatif = $count_bahan;

        return view('formula.editfortail')->with([
            'idf' => $idf,
            'fortail' => $fortail,
            'for' => $for,
            'edit' => $edit,
            'bahans' => $bahans,
            'alternatifs' => $alternatifs,
            'count_bahan' => $count_bahan,
            'count_alternatif' => $count_alternatif
        ]);
    }

    public function update($idf,$id,Request $request)
    {
        $delpremix = Premix::where('fortail_id',$id)->get();
        foreach($delpremix as $px){
            $delpretail = Pretail::where('premix_id')->get();
            foreach($delpretail as $pt){
                $pt->delete();
            }
            $px->delete();
        }
        if($request->prioritas!=NULL){
            $bp = Bahan::where('id', $request->prioritas)->first();
            $pin = $bp->id_ingredient;
            $pkk = $bp->kode_komputer;
            $pns = $bp->nama_sederhana;
            $pko = $bp->kode_oracle;
            $pnb = $bp->nama_bahan;
        }

        $fortails = Fortail::where('id',$id)->first();

        $c = $request->c;
        if($c>0){
            for($d = 1;$d<=$c;$d++){
                $ba[$d] =  Bahan::where('id',$request->alternatif[$d])->first();
                // $pkk = $pkk.' / '.$ba[$d]->kode_komputer;
                // $pns = $pns.' / '.$ba[$d]->nama_sederhana;
                // $pko = $pko.' / '.$ba[$d]->kode_oracle;
                $e=$d+1;
                
                // $nk = 'kode_komputer'.$e;
                // $fortails->$nk = $ba[$d]->id;
            }
        }
        
        if($request->prioritas!=NULL){
        $fortails->formula_id = $idf;
        $fortails->kode_komputer = $bp->kode_komputer;
        $fortails->id_ingredient = $pin;
        $fortails->kode_oracle = $bp->kode_oracle;
        $fortails->nama_sederhana = $bp->nama_sederhana;
        $fortails->principle = $bp->principle;
        $fortails->kode_oracle = $pko;
        $fortails->bahan_id = $bp->id;
        $fortails->nama_bahan = $bp->nama_bahan;
        }
            if($c>0){
                if($ba[1]!=NULL){
                    $fortails->alternatif1= $ba[1]->nama_sederhana;
                    $fortails->nama_bahan1= $ba[1]->nama_bahan;
                    $fortails->principle1= $ba[1]->principle;
                }
                if($ba[1]==NULL){
                    $fortails->alternatif1= NULL;
                    $fortails->nama_bahan1= NULL;
                    $fortails->principle1= NULL;
                }
            }
            if($c>1){
                if($ba[2]!=NULL){
                    $fortails->alternatif2= $ba[2]->nama_sederhana;
                    $fortails->nama_bahan2= $ba[2]->nama_bahan;
                    $fortails->principle2= $ba[2]->principle;
                }
                if($ba[2]==NULL){
                    $fortails->alternatif2= NULL;
                    $fortails->nama_bahan2= NULL;
                    $fortails->principle2= NULL;
                }
            }
            if($c>2){
                if($ba[3]!=NULL){
                    $fortails->alternatif3= $ba[3]->nama_sederhana;
                    $fortails->nama_bahan3= $ba[3]->nama_bahan;
                    $fortails->principle3= $ba[3]->principle;
                }
                if($ba[3]==NULL){
                    $fortails->alternatif3= NULL;
                    $fortails->nama_bahan3= NULL;
                    $fortails->principle3= NULL;
                }
            }
            if($c>3){
                if($ba[4]!=NULL){
                    $fortails->alternatif4= $ba[4]->nama_sederhana;
                    $fortails->nama_bahan4= $ba[4]->nama_bahan;
                    $fortails->principle4= $ba[4]->principle;
                }
                if($ba[4]==NULL){
                    $fortails->alternatif4= NULL;
                    $fortails->nama_bahan4= NULL;
                    $fortails->principle4= NULL;
                }
            }
            if($c>4){
            if($ba[5]!=NULL){
                    $fortails->alternatif5= $ba[5]->nama_sederhana;
                    $fortails->nama_bahan5= $ba[5]->nama_bahan;
                    $fortails->principle5= $ba[5]->principle;
                }
                if($ba[5]==NULL){
                    $fortails->alternatif5= NULL;
                    $fortails->nama_bahan5= NULL;
                    $fortails->principle5= NULL;
                }
            }
            if($c>5){
            if($ba[6]!=NULL){
                    $fortails->alternatif6= $ba[6]->nama_sederhana;
                    $fortails->nama_bahan6= $ba[6]->nama_bahan;
                    $fortails->principle6= $ba[6]->principle;
                }
                if($ba[6]==NULL){
                    $fortails->alternatif6= NULL;
                    $fortails->nama_bahan6= NULL;
                    $fortails->principle6= NULL;
                }
            }
            if($c>6){
            if($ba[7]!=NULL){
                    $fortails->alternatif7= $ba[7]->nama_sederhana;
                    $fortails->nama_bahan7= $ba[7]->nama_bahan;
                    $fortails->principle7= $ba[7]->principle;
                }
                if($ba[7]==NULL){
                    $fortails->alternatif7= NULL;
                    $fortails->nama_bahan7= NULL;
                    $fortails->principle7= NULL;
                }
            }
        if($request->per_batch >= 3000){
            $fortails->jenis_timbangan='B';
        }elseif($request->per_batch < 3000){
            $fortails->jenis_timbangan='A';
        }

        $fortails->save();

        $jumlah_bahan = $c + 1;
    
        return Redirect()->back()->with('status','Bahan Baku Telah Di Update');
    }
}
