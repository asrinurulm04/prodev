<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\model\formula\Bahan;
use App\model\formula\Formula;
use App\model\formula\Fortail;
use App\model\pkp\PkpProject;
use App\model\pdf\ProjectPDF;
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
        $base = $request->thebase;
        if($base == ''){
            $base = 0;
        }
        $total_batch = 0;
        $fortails = Fortail::where('formula_id',$idf)->get(); // Get Fortail
        foreach ($fortails as $fortail) {
            $batch = $fortail->per_serving * $base;
            $fortail->per_batch = $batch;// Change Batch
            $fortail->save();
            $total_batch    = $total_batch + $batch;      // Count TOTAL                   
        }
        $formula = Formula::where('id',$idf)->first(); // Edit Formula
        $formula->batch = $total_batch;
        $formula->save();

        $wb = $formula->workbook_id;
        return redirect::back()->with('status','Base Telah Diubah menjadi '.$base);
    }

    public function cekscale(Request $request, $for,$pkp,$project){// check scale option
        $scale_option  = $request->scale_option;
        $scale_method  = $request->scale_method;
        $target_scale  = $request->target_scale; // FOR %
        $target_value  = $request->target_scale; // FOR GRAM
        $target_id     = $request->target_number;
        $jFortail      = $request->jFortail;

        // Base Lama
        $formula = Formula::where('id',$for)->first();   
        $pro     = PkpProject::where('id_project',$pkp)->first();
        $base    = $formula->batch / $formula->serving;
        $mybase  = $base;
        
        // FORTAIL TARGET
        $target_fortail = Fortail::where('id',$target_id)->first();
        if($scale_option == '%'){// Cari Value dari persen
            $percent        = $target_scale;
            if($scale_method == 'A'){
                $c_target_value = $formula->serving;
                $target_value   = ($c_target_value / 100 ) * $percent;
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

        $scalecollect = collect();
        $granulasi    = 0;
        $premix       = 0;
        $fortails     = Fortail::where('formula_id',$for)->orderBy('per_serving','desc')->get();

        if($scale_method == 'A'){ // Target Scale Jserving
            $jServing = $formula->serving;
            $i        = 0;   
            foreach($fortails as $fortail){
                ++$i;          
                $Serving         = $fortail->per_serving;                                
                $c_scale_serving = ($target_value * $Serving) / $jServing;
                $c_scale_batch   = $c_scale_serving * $base;
                $c_scale_serving = round($c_scale_serving,5);
                $c_scale_batch   = round($c_scale_batch,5);
                // Get Other Component
                $c_no            = $i;
                $c_id            = $fortail->id;
                $c_nama_sederhana= $fortail->nama_sederhana;
                $c_granulasi     = $fortail->granulasi;
                $c_premix        = $fortail->premix;
                $c_per_batch     = $fortail->per_batch;
                $c_per_serving   = $fortail->per_serving;
                $scalecollect->push([        
                    'no'             => $c_no,                
                    'id'             => $c_id,
                    'nama_sederhana' => $c_nama_sederhana,
                    'per_batch'      => $c_per_batch,
                    'per_serving'    => $c_per_serving,
                    'scale_batch'    => $c_scale_batch,
                    'scale_serving'  => $c_scale_serving,
                    'alternatif1'    => $fortail->alternatif1,
                    'alternatif2'    => $fortail->alternatif2,
                    'alternatif3'    => $fortail->alternatif3,
                    'alternatif4'    => $fortail->alternatif4,
                    'alternatif5'    => $fortail->alternatif5,
                    'alternatif6'    => $fortail->alternatif6,
                    'alternatif7'    => $fortail->alternatif7,
                    'premix'         => $c_premix,
                    'granulasi'      => $c_granulasi                
                ]);
               
                if($fortail->granulasi == 'ya'){  // Jika Granulasi
                    $granulasi = $granulasi + 1;
                }
                if($fortail->premix == 'ya'){ // Jika premix
                    $premix = $premix + 1;
                }
            }                        
        }
        elseif($scale_method == 'B'){            
            $i              = 0;   
            $Serving_target = $target_fortail->per_serving;
            foreach($fortails as $fortail){
                ++$i;
                $Serving          = $fortail->per_serving;                
                $c_scale_serving  = ($Serving * $target_value) / $Serving_target;
                $c_scale_batch    = $c_scale_serving * $base;
                $c_scale_serving  = round($c_scale_serving,5);
                $c_scale_batch    = round($c_scale_batch,5);
                // Get Other Component
                $c_no             = $i;
                $c_id             = $fortail->id;
                $c_nama_sederhana = $fortail->nama_sederhana;
                $c_granulasi      = $fortail->granulasi;
                $c_premix         = $fortail->premix;
                $c_per_batch      = $fortail->per_batch;
                $c_per_serving    = $fortail->per_serving;
                $scalecollect->push([        
                    'no'             => $c_no,                
                    'id'             => $c_id,
                    'nama_sederhana' => $c_nama_sederhana,
                    'per_batch'      => $c_per_batch,
                    'per_serving'    => $c_per_serving,
                    'scale_batch'    => $c_scale_batch,
                    'scale_serving'  => $c_scale_serving,
                    'alternatif1'    => $fortail->alternatif1,
                    'alternatif2'    => $fortail->alternatif2,
                    'alternatif3'    => $fortail->alternatif3,
                    'alternatif4'    => $fortail->alternatif4,
                    'alternatif5'    => $fortail->alternatif5,
                    'alternatif6'    => $fortail->alternatif6,
                    'alternatif7'    => $fortail->alternatif7,
                    'premix'         => $fortail->premix,
                    'granulasi'      => $c_granulasi                
                ]);
                
                if($fortail->granulasi == 'ya'){// Jika Granulasi
                    $granulasi = $granulasi + 1;
                }
                if($fortail->premix == 'ya'){  // Jika premix
                    $premix = $premix + 1;
                }
            }
        }
        elseif($scale_method == 'C'){// Get New Base
            $sServing_target = $target_fortail->per_serving;
            $c_newbase       = $target_value / $sServing_target;  
            $i               = 0;   
            foreach($fortails as $fortail){
                ++$i;
                $sServing         = $fortail->per_serving;
                $c_scale_batch    = $sServing * $c_newbase;
                $c_scale_serving  = $sServing;
                $c_scale_serving  = round($c_scale_serving,5);
                $c_scale_batch    = round($c_scale_batch,5);
                // Get Other Component
                $c_no             = $i;
                $c_id             = $fortail->id;
                $c_nama_sederhana = $fortail->nama_sederhana;
                $c_granulasi      = $fortail->granulasi;
                $c_premix         = $fortail->premix;
                $c_per_batch      = $fortail->per_batch;
                $c_per_serving    = $fortail->per_serving;
                $scalecollect->push([        
                    'no'             => $c_no,                
                    'id'             => $c_id,
                    'nama_sederhana' => $c_nama_sederhana,
                    'per_batch'      => $c_per_batch,
                    'per_serving'    => $c_per_serving,
                    'scale_batch'    => $c_scale_batch,
                    'scale_serving'  => $c_scale_serving,
                    'alternatif1'    => $fortail->alternatif1,
                    'alternatif2'    => $fortail->alternatif2,
                    'alternatif3'    => $fortail->alternatif3,
                    'alternatif4'    => $fortail->alternatif4,
                    'alternatif5'    => $fortail->alternatif5,
                    'alternatif6'    => $fortail->alternatif6,
                    'alternatif7'    => $fortail->alternatif7,
                    'premix'         => $fortail->premix,
                    'granulasi'      => $c_granulasi                
                ]);
                
                if($fortail->granulasi == 'ya'){// Jika Granulasi
                    $granulasi = $granulasi + 1;
                }
                if($fortail->premix == 'ya'){  // Jika premix
                    $premix = $premix + 1;
                }
            }
        }
        elseif($scale_method == 'D'){  // Get New Base
            $jsServing_target = $formula->serving;
            $c_newbase        = $target_value / $jsServing_target;
            $i                = 0;   
            foreach($fortails as $fortail){
                ++$i;
                $sServing         = $fortail->per_serving;
                $c_scale_batch    = $sServing * $c_newbase;
                $c_scale_serving  = $sServing;
                $c_scale_serving  = round($c_scale_serving,5);
                $c_scale_batch    = round($c_scale_batch,5);
                // Get Other Component
                $c_no             = $i;
                $c_id             = $fortail->id;
                $c_nama_sederhana = $fortail->nama_sederhana;
                $c_granulasi      = $fortail->granulasi;
                $c_premix         = $fortail->premix;
                $c_per_batch      = $fortail->per_batch;
                $c_per_serving    = $fortail->per_serving;
                $scalecollect->push([        
                    'no'             => $c_no,                
                    'id'             => $c_id,
                    'nama_sederhana' => $c_nama_sederhana,
                    'per_batch'      => $c_per_batch,
                    'per_serving'    => $c_per_serving,
                    'scale_batch'    => $c_scale_batch,
                    'scale_serving'  => $c_scale_serving,
                    'alternatif1'    => $fortail->alternatif1,
                    'alternatif2'    => $fortail->alternatif2,
                    'alternatif3'    => $fortail->alternatif3,
                    'alternatif4'    => $fortail->alternatif4,
                    'alternatif5'    => $fortail->alternatif5,
                    'alternatif6'    => $fortail->alternatif6,
                    'alternatif7'    => $fortail->alternatif7,
                    'premix'         => $fortail->premix,
                    'granulasi'      => $c_granulasi                
                ]);
                
                if($fortail->granulasi == 'ya'){// Jika Granulasi
                    $granulasi = $granulasi + 1;
                }
                if($fortail->premix == 'ya'){  // Jika premix
                    $premix = $premix + 1;
                }
            }
        }
        // GET Other Needed
        $formula        = Formula::where('id',$for)->first();
        $bahans         = Bahan::where('status','active')->orWhere('user_id',Auth::id())->get();        
        $ada            = $fortails->count();        
        $target_serving = $formula->target_serving;
        
        if($ada > 0){ // Check Total Serving
            $sesuai_target = $formula->serving - $target_serving;
        }else{
            $sesuai_target = 0;
        }  
        return view('formula/step2')->with([
            'target_serving' => $target_serving,
            'formula'        => $formula,
            'mybase'         => $mybase,
            'fortails'       => $fortails,
            'scalecollect'   => $scalecollect,
            'bahans'         => $bahans,
            'idpkp'          => $pkp,
            'idfor'          => $for,
            'idpro'          => $project,
            'idfor_pdf'      => $for,
            'project'        => $pro,
            'granulasi'      => $granulasi,
            'premix'         => $premix,
            'ada'            => $ada,
            'sesuai_target'  => $sesuai_target
        ]);
    }

    public function savescale(Request $request,$for,$pkp){
        $jFortail       = $request->jFortail;
        $total_batch    = 0;
        $total_serving  = 0;
        for($i=1;$i<=$jFortail;$i++){ // Collect Needed Value
            $id         = $request->ftid[$i];
            $sBatch     = $request->sBatch[$i];
            $sServing   = $request->sServing[$i];

            $myFortail = Fortail::where('id',$id)->first();  // Start Updating
            $myFortail->per_batch   = $sBatch;
            $myFortail->per_serving = $sServing;
            $myFortail->save();
            
            $total_batch    = $total_batch + $sBatch;
            $total_serving  = $total_serving + $sServing;
        }
        
        $formula = Formula::where('id',$for)->first(); // Edit Formula
        $formula->batch   = $total_batch;
        $formula->serving = $total_serving;
        $formula->save();      
        
        if($formula->workbook_id!=NULL){
            $wb = $formula->workbook_id;
            return redirect()->route('step2',[$for,$pkp,$wb])->with('status','Scale Berhasil Tersimpan');
        }if($formula->workbook_pdf_id!=NULL){
            $wb = $formula->workbook_pdf_id;
            return redirect()->route('step2',[$for,$pkp,$wb])->with('status','Scale Berhasil Tersimpan');
        }
    }

    public function savechanges($idf,Request $request){ // simpan hasil cek scale
        $jFortail       = $request->jFortail;
        $total_batch    = 0;
        $total_serving  = 0;
        $formula        = Formula::where('id',$idf)->first();
        $wb             = $formula->workbook_id;
       
        $base  = $formula->batch / $formula->serving; // Get Base
        for($i=1;$i<=$jFortail;$i++){  // Collect Needed Value
            $id        = $request->ftid[$i];            
            $Serving   = $request->Serving[$i];     
            if($request->Batch[$i]!=0){
                $Batch       = $request->Batch[$i];
                $total_batch = $total_batch + $Batch;
            }elseif($request->Batch[$i]==0 && $request->total_btc!=NULL){
                $total       = ($request->total_btc/$request->total_svg)*$request->Serving[$i];
                $total_batch = $request->total_btc;
                $Batch       = $total;
            }

            $myFortail = Fortail::where('id',$id)->first(); // Start Updating
            if($request->Batch[$i]!=0){
                $myFortail->per_batch   = $Batch;
            }
            $myFortail->per_serving = $Serving;
            $myFortail->save();
            
            $total_serving  = $total_serving + $Serving;
        }
        // Edit Formula
        $formula->batch   = $total_batch;
        $formula->serving = $total_serving;
        $formula->save();
        
        if(auth()->user()->role->namaRule == 'manager'){ // jika manager RD melakukan perubahan pada informasi formula, maka user akan mendapatkan informasi melalui email
            try{
                Mail::send('email.info', [
                    'info' => 'Manager Anda Telah Merubah Serving/Batch Pada Formula "'.$formula->formula.'"' ,
                ],function($message)use($request,$idf){
                    $message->subject('INFO PRODEV');
                    $for = Formula::where('id', $idf)->first();
                    if($for->workbook_id!=NULL){
                        $project = PkpProject::where('id_project',$for->workbook_id)->first();
                        $user    = DB::table('tr_users')->where('id', $project->userpenerima)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $message->to($data);
                        }
                    }elseif($for->workbook_pdf_id!=NULL){
                        $project = ProjectPDF::where('id_project_pdf',$for->workbook_pdf_id)->first();
                        $user    = DB::table('tr_users')->where('id', $project->userpenerima)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $message->to($data);
                        }
                    }
                });
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }
        return redirect::back()->with('status','Serving Berhasil Tersimpan');
    }   

    public function savechanges2($idf,Request $request){
        $jFortail       = $request->jFortail;
        $total_batch    = 0;
        $total_serving  = 0;
        $formula        = Formula::where('id',$idf)->first();
        $wb             = $formula->workbook_id;
        // Get Base
        $base           = $formula->batch / $formula->serving;
        for($i=1;$i<=$jFortail;$i++){ // Collect Needed Value
            $id        = $request->ftid[$i];            
            $Serving   = $request->Serving[$i];
            $Batch     = $Serving * $base; 

            $myFortail  = Fortail::where('id',$id)->first(); // Start Updating
            $myFortail->per_serving = $Serving;
            $myFortail->save();
            
            $total_batch    = $total_batch + $Batch;
            $total_serving  = $total_serving + $Serving;
        }
        // Edit Formula
        $formula->serving_size   = $total_serving;
        $formula->batch          = $total_batch;
        $formula->serving        = $total_serving;
        $formula->save();

        return redirect::back()->with('status','Serving Berhasil Tersimpan');
    }  
    
    public function savedosis($idf,Request $request){ //simpan perubahan dosis
        $formula = Formula::where('id',$idf)->first();
        $formula->pangan    = $request->katpang;
        $formula->batas_air = $request->batas;
        $formula->saran_saji= $request->saran;
        $formula->save();

        return redirect::back()->with('status','Data Berhasil ter-Update');
    }  
}