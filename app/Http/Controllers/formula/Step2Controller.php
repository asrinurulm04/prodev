<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\User;
use App\dev\Workbook;
use App\dev\Formula;
use App\dev\Fortail;
use App\dev\Premix;
use App\dev\Pretail;
use App\pkp\tipp;
use App\dev\Bahan;
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
                'nama_sederhana' => $fortail->nama_sederhana,
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

        $fortails = new Fortail; // Start Fortail Baru
        $c = $request->c;
        // Jika Lebih Dari 1
        if($c>0){
            for($d = 1;$d<=$c;$d++){
                $ba[$d] =  Bahan::where('id',$request->alternatif[$d])->first();
                $pkk = $pkk.' / '.$ba[$d]->kode_komputer;
                // $pin = $pin.' / '.$ba[$d]->id_ingredient;
                $pns = $pns.' / '.$ba[$d]->nama_sederhana;
                $pko = $pko.' / '.$ba[$d]->kode_oracle;
                $pnb = $pnb.' / '.$ba[$d]->nama_bahan;
                $e=$d+1;
                
                $nk = 'kode_komputer'.$e;
                $fortails->$nk = $ba[$d]->id;
            }
        }
        
        $fortails->formula_id = $vf;
        $fortails->kode_komputer = $pkk;
        $fortails->id_ingredient = $pin;
        $fortails->nama_sederhana = $pns;
        $fortails->kode_oracle = $pko;
        $fortails->bahan_id = $bp->id;
        $fortails->nama_bahan = $pnb;
        if($c>0){
            $fortails->alternatif= $ba[1]->nama_sederhana;
        }        
        
        // if($request->per_batch >= 3000){
        //     $fortails->jenis_timbangan='B';
        // }elseif($request->per_batch < 3000){
        //     $fortails->jenis_timbangan='A';
        // }

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

    // Premix(Bahan Ada Satu)------------------------------------
        if($jumlah_bahan == 1){
            $kgbatch = $fortails->per_batch / 1000;
            $persiapan_utuh = intdiv($kgbatch,$bp->berat);
            $persiapan_koma = round(fmod($kgbatch,$bp->berat),5);
            
            $premix = new Premix;
            $premix->fortail_id = $fortails->id;
            $premix->utuh = $persiapan_utuh;
            $premix->koma = $persiapan_koma;
            $premix->utuh_cpb = $persiapan_utuh;
            $premix->koma_cpb = $persiapan_koma;
            $premix->satuan = $bp->satuan->satuan;
            $premix->berat = $bp->berat;
            $premix->save();
        }
        
    // Premix(Bahan Ada Lebih Dari Satu)-----------------
        if($jumlah_bahan > 1){

            $kgbatch = $fortails->per_batch / 1000;
            for($i=1;$i<=$jumlah_bahan;$i++){
                if($i==1){
                    $persiapan_utuh[1] = intdiv($kgbatch,$bp->berat);
                    $persiapan_koma[1] = round(fmod($kgbatch,$bp->berat),5);
                    $persiapan_keterangan[1] = $bp->nama_sederhana;
                    $persiapan_satuan[1] = $bp->satuan->satuan;
                    $persiapan_berat[1] = $bp->berat;
                    $myCollection = collect([
                        ['utuh' => $persiapan_utuh[1],
                         'koma' => $persiapan_koma[1], 
                         'keterangan' => $persiapan_keterangan[1], 
                         'satuan'=> $persiapan_satuan[1], 
                         'berat' => $persiapan_berat[1]]
                    ]);       
                }
                else{
                    $ii = $i - 1;
                    $persiapan_utuh[$i] = intdiv($kgbatch,$ba[$ii]->berat);
                    $persiapan_koma[$i] = round(fmod($kgbatch,$ba[$ii]->berat),5);
                    $persiapan_keterangan[$i] = $ba[$ii]->nama_sederhana;
                    $persiapan_satuan[$i] = $ba[$ii]->satuan->satuan;
                    $persiapan_berat[$i] = $ba[$ii]->berat;
                    $myCollection->push([
                        'utuh' => $persiapan_utuh[$i], 
                        'koma' => $persiapan_koma[$i], 
                        'keterangan' => $persiapan_keterangan[$i],
                        'satuan' => $persiapan_satuan[$i],
                        'berat' => $persiapan_berat[$i]
                    ]);
                }
            }
           
            $groupMyCollection = $myCollection->groupBy('utuh');
            // $groupMyCollection->toArray();

        foreach($groupMyCollection as $eachRow){
            $premix = new Premix;
            $premix->fortail_id = $fortails->id;
                $hiji = 1;
                foreach($eachRow as $each){
                    if($hiji == 1){
                        $persiapan_keterangan = 'Jika '.$each['keterangan'];
                        $premix->utuh = $each['utuh'];
                        $premix->koma = $each['koma'];
                        $premix->utuh_cpb = $each['utuh'];
                        $premix->koma_cpb = $each['koma'];
                        $premix->satuan = $each['satuan'];
                        $premix->berat = $each['berat'];
                    }
                    else{
                        $persiapan_keterangan = $persiapan_keterangan.' / '.$each['keterangan'];
                    }
                    $hiji = 0;
                }
            $premix->keterangan = $persiapan_keterangan;
            $premix->save();
        }

        }
        
        return redirect()->route('step2',['id_workbook' => $vf, 'id_formula' => $formula->id])->with('status','BahanBaku Berhasil Ditambahkan');
    }

    public function destroy($id,$vf){
        //dd($id);
        $formula = Formula::where('id',$vf)->first();
        $idfor = $formula->workbook_id;
        $fortail = Fortail::where([
            ['id',$id],
            ['formula_id',$vf]
            ])->first();

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