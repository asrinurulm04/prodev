<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\User;
use App\devnf\allergen_formula;
use App\dev\Workbook;
use App\dev\Formula;
use App\dev\Fortail;
use App\dev\Premix;
use App\dev\Pretail;
use App\pkp\tipp;
use App\dev\Bahan;
use App\dev\bb_allergen;
use Auth;
use DB;
use Redirect;

class Step2Controller extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }
    
    public function create($formula,$id){
        $formula = Formula::where('id',$id)->first();
        //dd($formula);
        $wb = tipp::where('id_pkp',$id)->first();
        $target_serving = $formula->serving_size;

        // checkbase !
        if($formula->batch != null){
            $mybase = $formula->batch / $formula->serving;
        }
        else{
            $mybase = 0;
        }

        $idf = $id;
        $idfor = $formula->workbook_id;
        $fortails = Fortail::where('formula_id',$id)->get();
        //dd($fortails);
        $ada= Fortail::where('formula_id',$id)->count();
        $bahans = Bahan::all();
        $no = 0;

        $scalecollect = collect();
        
        $rjBatch    = 0;
        $rjServing  = 0;
        $rjsBatch   = 0;
        $rjsServing = 0;
        $granulasi  = 0;
        foreach($fortails as $fortail){
            $scalecollect->push([
                
                'no' => ++$no,                
                'id' => $fortail->id,      
                'formula_id' => $fortail->formula_id,
                'nama_sederhana' => $fortail->nama_sederhana,
                'alternatif1' => $fortail->alternatif1,
                'alternatif2' => $fortail->alternatif2,
                'alternatif3' => $fortail->alternatif3,
                'alternatif4' => $fortail->alternatif4,
                'alternatif5' => $fortail->alternatif5,
                'alternatif6' => $fortail->alternatif6,
                'alternatif7' => $fortail->alternatif7,
                'nama_bahan' => $fortail->nama_bahan,
                'per_batch' => $fortail->per_batch,
                'per_serving' => $fortail->per_serving,
                'scale_batch' => '',
                'scale_serving' => '',
                'granulasi' => $fortail->granulasi                
            ]);
            $rjBatch   = $rjBatch + $fortail->per_batch;
            $rjServing = $rjServing + $fortail->per_serving;
            
            // Granulasi
            if($fortail->granulasi == 'ya'){
            $granulasi = $granulasi + 1;  
            // dd($scalecollect);        
            }                                  
        }

        // Check Total Serving
        if($ada > 0){
            $sesuai_target = $formula->serving - $target_serving;
        }
        else{
            $sesuai_target = 0;
        }  
        return view('formula/step2')->with([
            'target_serving' => $target_serving,
            'formula' => $formula,
            'mybase' => $mybase,
            'fortails' => $fortails,
            'scalecollect' => $scalecollect,
            'bahans' => $bahans,
            'idfor' => $idfor,
            'granulasi' => $granulasi,            
            'idf' => $idf,
            'ada' => $ada,
            'sesuai_target' => $sesuai_target
        ]);
    }

    public function update($formula,$id,Request $request){
        $formula = Formula::where('id',$formula)->first();
        $formula->catatan_rd = $request->keterangan;
        $formula->note_formula = $request->formula;
        $formula->catatan_manager = $request->manager;
        $formula->save();
        
        return Redirect()->back();
    }

    public function insert($vf,Request $request){
        // Check and Recheck
            $formula = Formula::where('id',$vf)->first();
        // checkbase !
            if($formula->batch != null){
                $mybase = $formula->batch / $formula->serving;
            }
            else{
                $mybase = 0;
            }
        
        // checkfortail !
            $ada= Fortail::where('formula_id',$vf)->count();
            if($ada>0){            
                $paraFortail= Fortail::where('formula_id',$vf)->get();
            }
        // Persiapan

        $bp = Bahan::where('id', $request->prioritas)->first();
        $pin = $bp->id_ingredient;
        $pkk = $bp->kode_komputer;
        $pns = $bp->nama_sederhana;
        $pko = $bp->kode_oracle;
        $pnb = $bp->nama_bahan;
            

        $fortailss = new Fortail; // Start Fortail Baru
        $fortailss->formula_id = $vf;
        
        $fortailss->kode_komputer = $bp->kode_komputer;
        $fortailss->id_ingredient = $pin;
        $fortailss->kode_oracle = $bp->kode_oracle;
        $fortailss->nama_sederhana = $bp->nama_sederhana;
        $fortailss->principle = $bp->principle;
        $fortailss->kode_oracle = $pko;
        $fortailss->bahan_id = $bp->id;
        $fortailss->nama_bahan = $bp->nama_bahan;

        $fortailss->save();

        $idmaxfortail = Fortail::where('formula_id',$vf)->max('id');
        $fortails = Fortail::where('id',$idmaxfortail)->first();
        $c = $request->c;
        // Jika Lebih Dari 1
        if($c>0){
            for($d = 1;$d<=$c;$d++){
                $ba[$d] =  Bahan::where('id',$request->alternatif[$d])->first();
                $pkk = $pkk.' / '.$ba[$d]->kode_komputer;
                // $pin = $pin.' / '.$ba[$d]->id_ingredient;
                // $pns = $pns.' / '.$ba[$d]->nama_sederhana;
                // $pko = $pko.' / '.$ba[$d]->kode_oracle;
                // $pnb = $pnb.' / '.$ba[$d]->nama_bahan;
                $e=$d+1;
            }
        }
        
        
        $all = new allergen_formula;
        $all->id_bahan=$bp->id;
        $all->id_formula=$vf;
        $all->id_fortails=$fortails->id;
        $all->save();

        if($c>0){
            $fortails->alternatif1= $ba[1]->nama_sederhana;
            $fortails->nama_bahan1= $ba[1]->nama_bahan;
            $fortails->principle1= $ba[1]->principle;
                    
            $all1 = new allergen_formula;
            $all1->id_bahan=$ba[1]->id;
            $all1->id_formula=$vf;
            $all1->id_fortails=$fortails->id;
            $all1->save();
            if($c>1){
            $fortails->alternatif2= $ba[2]->nama_sederhana;
            $fortails->nama_bahan2= $ba[2]->nama_bahan;
            $fortails->principle2= $ba[2]->principle;
            
            $all2 = new allergen_formula;
            $all2->id_bahan=$ba[2]->id;
            $all2->id_formula=$vf;
            $all2->id_fortails=$fortails->id;
            $all2->save();
            }
            if($c>2){
            $fortails->alternatif3= $ba[3]->nama_sederhana;
            $fortails->nama_bahan3= $ba[3]->nama_bahan;
            $fortails->principle3= $ba[3]->principle;
            
            $all3 = new allergen_formula;
            $all3->id_bahan=$ba[3]->id;
            $all3->id_formula=$vf;
            $all3->id_fortails=$fortails->id;
            $all3->save();
            }
            if($c>3){
            $fortails->alternatif4= $ba[4]->nama_sederhana;
            $fortails->nama_bahan4= $ba[4]->nama_bahan;
            $fortails->principle4= $ba[4]->principle;

            $all4 = new allergen_formula;
            $all4->id_bahan=$ba[4]->id;
            $all4->id_formula=$vf;
            $all4->id_fortails=$fortails->id;
            $all4->save();
            }
            if($c>4){
            $fortails->alternatif5= $ba[5]->nama_sederhana;
            $fortails->nama_bahan5= $ba[5]->nama_bahan;
            $fortails->principle5= $ba[5]->principle;
            
            $all5 = new allergen_formula;
            $all5->id_bahan=$ba[5]->id;
            $all5->id_formula=$vf;
            $all5->id_fortails=$fortails->id;
            $all5->save();
            }
            if($c>5){
            $fortails->alternatif6= $ba[6]->nama_sederhana;
            $fortails->nama_bahan6= $ba[6]->nama_bahan;
            $fortails->principle6= $ba[6]->principle;
            
            $all6 = new allergen_formula;
            $all6->id_bahan=$ba[6]->id;
            $all6->id_formula=$vf;
            $all6->id_fortails=$fortails->id;
            $all6->save();
            }
            if($c>6){
            $fortails->alternatif7= $ba[7]->nama_sederhana;
            $fortails->nama_bahan7= $ba[7]->nama_bahan;
            $fortails->principle7= $ba[7]->principle;
            
            $all7 = new allergen_formula;
            $all7->id_bahan=$ba[7]->id;
            $all7->id_formula=$vf;
            $all7->id_fortails=$fortails->id;
            $all7->save();
            }
        }        

        $fortails->per_serving = $request->per_serving;
        //Check Batch and Base
            // Jika Base Masih Kosong
            if (isset($request->cbase)){
                $batch = $request->per_batch;
                $serving = $request->per_serving;
                $mybase = $batch / $serving;

                // Check and fill all batch for fortail that doesnt have batch
                if($ada>0){
                    foreach($paraFortail as $bitch){
                        $s = $bitch->per_serving;
                        $bitch->per_batch = $mybase*$s;
                        $bitch->save();
                    }
                }
                // Fill My Batch N Serving
                $fortails->per_batch   = $request->per_batch;
                $fortails->per_serving = $request->per_serving;
            }
            else if($mybase>0){                
                $fortails->per_serving = $request->per_serving;  
                $fortails->per_batch   = $mybase * $request->per_serving;                                                        
            }
            else if($mybase==0){
                $fortails->per_serving = $request->per_serving;
            }

            // Granulasi
            if (isset($request->cgranulasi)){
                $fortails->granulasi = 'ya';                
            }else{
                $fortails->granulasi = 'tidak';
            }
                
        $fortails->save();

        // Count Total Serving and Total Batch after inserting wkwkwkwk
        $paraFortail2= Fortail::where('formula_id',$vf)->get();
        $totalb = 0;
        $totals = 0;
        foreach($paraFortail2 as $ok){
            $totalb = $totalb + $ok->per_batch;
            $totals = $totals + $ok->per_serving;
        }
        // Insert To Formula
        $formula->batch = $totalb;
        $formula->serving = $totals;
        $formula->save();

        $jumlah_bahan = $c + 1;

    
      
        return redirect()->route('step2',['id_workbook' => $vf, 'id_formula' => $formula->id])->with('status','BahanBaku Berhasil Ditambahkan');
    }

    public function hapusall($formula){
        $fortails = Fortail::where('formula_id',$formula)->delete();
        $allergen = allergen_formula::where('id_formula',$formula)->delete();

        return redirect::back();
    }

    public function destroy($id,$vf){
        $formula = Formula::where('id',$vf)->first();
        $idfor = $formula->workbook_id;
        $fortail = Fortail::where([['id',$id],['formula_id',$vf]])->first();
        $allergen = allergen_formula::where('id_fortails',$id)->delete();
        if($formula->batch != null){
            $totalb = $formula->batch - $fortail->per_batch;
            $formula->batch = $totalb;
        }
        
        $totals = $formula->serving - $fortail->per_serving;
        $formula->serving = $totals;
        $formula->save();
       
        $premixs = Premix::where('fortail_id',$fortail->id)->get();
                foreach($premixs as $premix){
                    $pretails = Pretail::where('premix_id',$premix->id)->get();
                    foreach($pretails as $pretail){
                        $pretail->delete();
                    }
                $premix->delete();
                }
            $fortail->delete();
        return redirect()->route('step2',[$idfor,$vf])->with('error','BahanBaku Telah Berhasil Dihapus');
    }

}