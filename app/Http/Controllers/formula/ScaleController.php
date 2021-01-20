<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\dev\Bahan;
use App\model\dev\Formula;
use App\model\dev\Fortail;

use Redirect;
use DB;
use Auth;

class ScaleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }    

    public function gantibase($idf,Request $request){
        $base           = $request->thebase;
        if($base == ''){
            $base = 0;
        }
        $total_batch    = 0;
        // Get Fortail
        $fortails = Fortail::where('formula_id',$idf)->get();
        foreach ($fortails as $fortail) {
            $batch = $fortail->per_serving * $base;
            // Change Batch
            $fortail->per_batch = $batch;
            $fortail->save();
            // Count TOTAL
            $total_batch    = $total_batch + $batch;                       
        }
        // Edit Formula
        $formula = Formula::where('id',$idf)->first();
        $formula->batch = $total_batch;
        $formula->save();

        $wb = $formula->workbook_id;
        return redirect::back()->with('status','Base Telah Diubah menjadi '.$base);

    }

    public function cekscale(Request $request, $for,$idf){
        // check scale option
        $scale_option  = $request->scale_option;
        $scale_method  = $request->scale_method;
        $target_scale  = $request->target_scale; // FOR %
        $target_value  = $request->target_scale; // FOR GRAM
        $target_id    = $request->target_number;
        $jFortail      = $request->jFortail;

        // Base Lama
        $formula = Formula::where('id',$idf)->first();   
        $base    = $formula->batch / $formula->serving;
        $mybase = $base;
        
        // FORTAIL TARGET
        $target_fortail = Fortail::where('id',$target_id)->first();
        
        // Cari Value dari persen
        if($scale_option == '%'){
            $percent        = $target_scale;
            if($scale_method == 'A'){
                $c_target_value = $formula->serving;
                $target_value = ($c_target_value / 100 ) * $percent;
            }
            elseif($scale_method == 'B'){
                $c_target_value = $target_fortail->per_serving;
                $target_value   = ($c_target_value / 100 ) * $percent;
            }
            elseif($scale_method == 'C'){
                $c_target_value = $target_fortail->per_batch;
                $target_value   = ($c_target_value / 100 ) * $percent;
            }
            elseif($scale_method == 'D'){
                $c_target_value = $formula->batch;
                $target_value   = ($c_target_value / 100 ) * $percent;
            }
            elseif($scale_method == 'Z'){
                return Redirect::back()->with('error','Anda Belum Memilih Target');
            }            
        }        

        // Start Check Scale
        $scalecollect = collect();
        // Hitung Granulasi
        $granulasi = 0;
        // Hitung premix
        $premix = 0;
        // Get Fortails;
        $fortails  = Fortail::where('formula_id',$idf)->get();

        // Target Scale Jserving
        if($scale_method == 'A'){
            $jServing = $formula->serving;
            $i = 0;   
            foreach($fortails as $fortail){
                // Urutan
                ++$i;
                // Get Scale Serving                
                $Serving = $fortail->per_serving;                                
                $c_scale_serving = ($target_value * $Serving) / $jServing;
                // Get Scale Batch
                $c_scale_batch = $c_scale_serving * $base;
                // Pembulatan
                $c_scale_serving = round($c_scale_serving,5);
                $c_scale_batch = round($c_scale_batch,5);
                // Get Other Component
                $c_no = $i;
                $c_id = $fortail->id;
                $c_nama_sederhana = $fortail->nama_sederhana;
                $c_granulasi = $fortail->granulasi;
                $c_premix = $fortail->premix;
                $c_per_batch = $fortail->per_batch;
                $c_per_serving = $fortail->per_serving;
                // Insert To Collect
                $scalecollect->push([        
                    'no' => $c_no,                
                    'id' => $c_id,
                    'nama_sederhana' => $c_nama_sederhana,
                    'per_batch' => $c_per_batch,
                    'per_serving' => $c_per_serving,
                    'scale_batch' => $c_scale_batch,
                    'scale_serving' => $c_scale_serving,
                    'alternatif1' => $fortail->alternatif1,
                    'alternatif2' => $fortail->alternatif2,
                    'alternatif3' => $fortail->alternatif3,
                    'alternatif4' => $fortail->alternatif4,
                    'alternatif5' => $fortail->alternatif5,
                    'alternatif6' => $fortail->alternatif6,
                    'alternatif7' => $fortail->alternatif7,
                    'premix' => $c_premix,
                    'granulasi' => $c_granulasi                
                ]);

                // Jika Granulasi
                if($fortail->granulasi == 'ya'){
                    $granulasi = $granulasi + 1;
                }
                // Jika premix
                if($fortail->premix == 'ya'){
                    $premix = $premix + 1;
                }
            }                        
        }
        elseif($scale_method == 'B'){            
            $i = 0;   
            $Serving_target = $target_fortail->per_serving;
            foreach($fortails as $fortail){
                // Urutan
                ++$i;
                // Get Scale Serving
                $Serving = $fortail->per_serving;                
                $c_scale_serving = ($Serving * $target_value) / $Serving_target;
                // Get Scale Batch
                $c_scale_batch = $c_scale_serving * $base;
                // Pembulatan
                $c_scale_serving = round($c_scale_serving,5);
                $c_scale_batch = round($c_scale_batch,5);
                // Get Other Component
                $c_no = $i;
                $c_id = $fortail->id;
                $c_nama_sederhana = $fortail->nama_sederhana;
                $c_granulasi = $fortail->granulasi;
                $c_premix = $fortail->premix;
                $c_per_batch = $fortail->per_batch;
                $c_per_serving = $fortail->per_serving;
                // Insert To Collect
                $scalecollect->push([        
                    'no' => $c_no,                
                    'id' => $c_id,
                    'nama_sederhana' => $c_nama_sederhana,
                    'per_batch' => $c_per_batch,
                    'per_serving' => $c_per_serving,
                    'scale_batch' => $c_scale_batch,
                    'scale_serving' => $c_scale_serving,
                    'alternatif1' => $fortail->alternatif1,
                    'alternatif2' => $fortail->alternatif2,
                    'alternatif3' => $fortail->alternatif3,
                    'alternatif4' => $fortail->alternatif4,
                    'alternatif5' => $fortail->alternatif5,
                    'alternatif6' => $fortail->alternatif6,
                    'alternatif7' => $fortail->alternatif7,
                    'premix' => $fortail->premix,
                    'granulasi' => $c_granulasi                
                ]);
                
                // Jika Granulasi
                if($fortail->granulasi == 'ya'){
                    $granulasi = $granulasi + 1;
                }
                // Jika premix
                if($fortail->premix == 'ya'){
                    $premix = $premix + 1;
                }
            }
        }
        elseif($scale_method == 'C'){
            // Get New Base
            $sServing_target = $target_fortail->per_serving;
            $c_newbase = $target_value / $sServing_target;  
            
            $i = 0;   
            foreach($fortails as $fortail){
                // Urutan
                ++$i;
                // Serving
                $sServing = $fortail->per_serving;
                // Get Scale Batch
                $c_scale_batch = $sServing * $c_newbase;
                // Get Scale Serving
                $c_scale_serving = $sServing;
                // Pembulatan
                $c_scale_serving = round($c_scale_serving,5);
                $c_scale_batch = round($c_scale_batch,5);
                // Get Other Component
                $c_no = $i;
                $c_id = $fortail->id;
                $c_nama_sederhana = $fortail->nama_sederhana;
                $c_granulasi = $fortail->granulasi;
                $c_premix = $fortail->premix;
                $c_per_batch = $fortail->per_batch;
                $c_per_serving = $fortail->per_serving;
                // Insert To Collect
                $scalecollect->push([        
                    'no' => $c_no,                
                    'id' => $c_id,
                    'nama_sederhana' => $c_nama_sederhana,
                    'per_batch' => $c_per_batch,
                    'per_serving' => $c_per_serving,
                    'scale_batch' => $c_scale_batch,
                    'scale_serving' => $c_scale_serving,
                    'alternatif1' => $fortail->alternatif1,
                    'alternatif2' => $fortail->alternatif2,
                    'alternatif3' => $fortail->alternatif3,
                    'alternatif4' => $fortail->alternatif4,
                    'alternatif5' => $fortail->alternatif5,
                    'alternatif6' => $fortail->alternatif6,
                    'alternatif7' => $fortail->alternatif7,
                    'premix' => $fortail->premix,
                    'granulasi' => $c_granulasi                
                ]);
                
                // Jika Granulasi
                if($fortail->granulasi == 'ya'){
                    $granulasi = $granulasi + 1;
                }
                // Jika premix
                if($fortail->premix == 'ya'){
                    $premix = $premix + 1;
                }
            }
        }
        elseif($scale_method == 'D'){
            // Get New Base
            $jsServing_target = $formula->serving;
            $c_newbase = $target_value / $jsServing_target;
            $i = 0;   
            foreach($fortails as $fortail){
                // Urutan
                ++$i;
                $sServing = $fortail->per_serving;
                // Get Scale Batch
                $c_scale_batch = $sServing * $c_newbase;
                // Get Scale Serving
                $c_scale_serving = $sServing;
                // Pembulatan
                $c_scale_serving = round($c_scale_serving,5);
                $c_scale_batch = round($c_scale_batch,5);
                // Get Other Component
                $c_no = $i;
                $c_id = $fortail->id;
                $c_nama_sederhana = $fortail->nama_sederhana;
                $c_granulasi = $fortail->granulasi;
                $c_premix = $fortail->premix;
                $c_per_batch = $fortail->per_batch;
                $c_per_serving = $fortail->per_serving;
                // Insert To Collect
                $scalecollect->push([        
                    'no' => $c_no,                
                    'id' => $c_id,
                    'nama_sederhana' => $c_nama_sederhana,
                    'per_batch' => $c_per_batch,
                    'per_serving' => $c_per_serving,
                    'scale_batch' => $c_scale_batch,
                    'scale_serving' => $c_scale_serving,
                    'alternatif1' => $fortail->alternatif1,
                    'alternatif2' => $fortail->alternatif2,
                    'alternatif3' => $fortail->alternatif3,
                    'alternatif4' => $fortail->alternatif4,
                    'alternatif5' => $fortail->alternatif5,
                    'alternatif6' => $fortail->alternatif6,
                    'alternatif7' => $fortail->alternatif7,
                    'premix' => $fortail->premix,
                    'granulasi' => $c_granulasi                
                ]);
                
                // Jika Granulasi
                if($fortail->granulasi == 'ya'){
                    $granulasi = $granulasi + 1;
                }
                // Jika premix
                if($fortail->premix == 'ya'){
                    $premix = $premix + 1;
                }
            }
        }

        // GET Other Needed
        $formula   = Formula::where('id',$idf)->first();
        $bahans    = $bahans = Bahan::where('status','active')->orWhere('user_id',Auth::id())->get();        
        $ada = $fortails->count();        
        $target_serving = Formula::where('id',$idf)->first()->target_serving;
        
        // Check Total Serving
        if($ada > 0){
            $sesuai_target = $formula->serving - $target_serving;
        }else{
            $sesuai_target = 0;
        }  
        return view('formula/step2')->with([
            'target_serving' => $target_serving,
            'formula' => $formula,
            'mybase' => $mybase,
            'fortails' => $fortails,
            'scalecollect' => $scalecollect,
            'bahans' => $bahans,
            'idf' => $idf,
            'idfor' => $for,
            'idfor_pdf' => $for,
            'granulasi' => $granulasi,
            'premix' => $premix,
            'ada' => $ada,
            'sesuai_target' => $sesuai_target
        ]);
    }

    public function savescale($for,Request $request){
        $jFortail       = $request->jFortail;
        $total_batch    = 0;
        $total_serving  = 0;
        for($i=1;$i<=$jFortail;$i++){
            // Collect Needed Value
            $id         = $request->ftid[$i];
            $sBatch     = $request->sBatch[$i];
            $sServing   = $request->sServing[$i];

            // Start Updating
            $myFortail  = Fortail::where('id',$id)->first();
            $myFortail->per_batch   = $sBatch;
            $myFortail->per_serving = $sServing;
            $myFortail->save();
            
            $total_batch    = $total_batch + $sBatch;
            $total_serving  = $total_serving + $sServing;
        }
        
        // Edit Formula
        $formula = Formula::where('id',$for)->first();
        $formula->batch   = $total_batch;
        $formula->serving = $total_serving;
        $formula->save();        
        
        if($formula->workbook_id!=NULL){
            $wb = $formula->workbook_id;
            return redirect()->route('step2',['id'=>$wb,'workbook_id' => $for])->with('status','Scale Berhasil Tersimpan');
        }if($formula->workbook_pdf_id!=NULL){
            $wb = $formula->workbook_pdf_id;
            return redirect()->route('step2',['id'=>$wb,'workbook_pdf_id' => $for])->with('status','Scale Berhasil Tersimpan');
        }
    }

    public function savechanges($idf,Request $request){
        $jFortail       = $request->jFortail;
        $total_batch    = 0;
        $total_serving  = 0;
        $formula = Formula::where('id',$idf)->first();
        $wb = $formula->workbook_id;
        // Get Base
        $base  = $formula->batch / $formula->serving;
        for($i=1;$i<=$jFortail;$i++){
            // Collect Needed Value
            $id        = $request->ftid[$i];            
            $Serving   = $request->Serving[$i];
            $Batch     = $Serving * $base; 

            // Start Updating
            $myFortail  = Fortail::where('id',$id)->first();
            $myFortail->per_batch   = $Batch;
            $myFortail->per_serving = $Serving;
            $myFortail->save();
            
            $total_batch    = $total_batch + $Batch;
            $total_serving  = $total_serving + $Serving;
        }
        
        // Edit Formula
        $formula->batch   = $total_batch;
        $formula->serving = $total_serving;
        $formula->save();

        return redirect::back()->with('status','Serving Berhasil Tersimpan');
    }    
}