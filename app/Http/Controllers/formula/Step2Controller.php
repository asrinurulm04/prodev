<?php

namespace App\Http\Controllers\formula;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\model\dev\Formula;
use App\model\dev\Fortail;
use App\model\dev\Bahan;
use App\model\pkp\PkpProject;
use App\model\pkp\ProjectPDF;
use App\model\users\User;
use App\model\devnf\AllergenFormula;
use Auth;
use DB;
use Redirect;

class Step2Controller extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }
    
    public function create($formula,$pkp,$project){
        $id_for         = $formula;
        $id_pkp         = $pkp;
        $id_pro         = $project;
        $project        = PkpProject::where('id_project',$pkp)->first();
        $fortails       = Fortail::where('formula_id',$formula)->orderBy('per_serving','desc')->get();
        $ada            = Fortail::where('formula_id',$formula)->count();
        $formula        = Formula::where('id',$id_for)->first();
        $target_serving = $formula->serving_size;

        // checkbase !
        if($formula->batch != null){
            if($formula->batch != 0){
                $mybase = $formula->batch / $formula->serving; $mybase = round($mybase , 3);
            }else{
                $mybase = 0;
            }
        }else{
            $mybase = 0;
        }

        $idfor_pdf  = $formula->workbook_pdf_id;
        $bahans     = Bahan::orderBy('nama_sederhana','asc')->select('id','nama_bahan','nama_sederhana')->get();
        $no         = 0;

        $scalecollect = collect();
        $rjBatch    = 0;   $rjServing  = 0;
        $rjsBatch   = 0;   $rjsServing = 0;
        $granulasi  = 0;   $premix     = 0;
        foreach($fortails as $fortail){
            $scalecollect->push([
                'no'             => ++$no,                
                'id'             => $fortail->id,      
                'formula_id'     => $fortail->formula_id,
                'nama_sederhana' => $fortail->nama_sederhana,
                'alternatif1'    => $fortail->alternatif1,
                'alternatif2'    => $fortail->alternatif2,
                'alternatif3'    => $fortail->alternatif3,
                'alternatif4'    => $fortail->alternatif4,
                'alternatif5'    => $fortail->alternatif5,
                'alternatif6'    => $fortail->alternatif6,
                'alternatif7'    => $fortail->alternatif7,
                'nama_bahan'     => $fortail->nama_bahan,
                'per_batch'      => round($fortail->per_batch , 3),
                'per_serving'    => $fortail->per_serving,
                'scale_batch'    => '',
                'scale_serving'  => '',
                'premix'         => $fortail->premix,    
                'granulasi'      => $fortail->granulasi                
            ]);
            $rjBatch   = $rjBatch + $fortail->per_batch;
            $rjServing = $rjServing + $fortail->per_serving;
            
            // Granulasi
            if($fortail->granulasi == 'ya'){
            $granulasi = $granulasi + 1;     
            }       
            
            // premix
            if($fortail->premix == 'ya'){
                $premix = $premix + 1;         
            } 
        }

        // Check Total Serving
        if($ada > 0){
            $sesuai_target = $formula->serving - $target_serving;
        }else{
            $sesuai_target = 0;
        }  
        return view('formula/step2')->with([
            'target_serving' => $target_serving,
            'formula'        => $formula,
            'mybase'         => $mybase,
            'project'        => $project,
            'fortails'       => $fortails,
            'scalecollect'   => $scalecollect,
            'bahans'         => $bahans,
            'idfor'          => $id_for,
            'idpkp'          => $id_pkp,
            'idpro'          => $id_pro,
            'idfor_pdf'      => $idfor_pdf,
            'granulasi'      => $granulasi,     
            'premix'         => $premix,  
            'ada'            => $ada,
            'sesuai_target'  => $sesuai_target
        ]);
    }

    public function update($formula,$id,Request $request){
        $formula = Formula::where('id',$formula)->first();
        $formula->catatan_rd      = $request->keterangan;
        $formula->note_formula    = $request->formula;
        $formula->catatan_manager = $request->manager;
        $formula->save();
        
        return Redirect::back();
    }

    public function insert($vf,Request $request){
        $formula = Formula::where('id',$vf)->first();
        if($formula->batch != null){
            if($formula->batch != 0){
                $mybase = $formula->batch / $formula->serving; $mybase = round($mybase , 3);
            }else{
                $mybase = 0;
            }
        }
        else{
            $mybase = 0;
        }
        
        // checkfortail !
        $ada= Fortail::where('formula_id',$vf)->count();
        if($ada>0){            
            $paraFortail= Fortail::where('formula_id',$vf)->get();
        }

        $bp = Bahan::where('id', $request->prioritas)->first();
        $pkk = $bp->kode_komputer;
        $pns = $bp->nama_sederhana;
        $pko = $bp->kode_oracle;
        $pnb = $bp->nama_bahan;
            
        $fortailss = new Fortail; // Start Fortail Baru
        $fortailss->formula_id     = $vf;
        $fortailss->kode_komputer  = $bp->kode_komputer;
        $fortailss->kode_oracle    = $bp->kode_oracle;
        $fortailss->nama_sederhana = $bp->nama_sederhana;
        $fortailss->principle      = $bp->principle;
        $fortailss->kode_oracle    = $pko;
        $fortailss->bahan_id       = $bp->id;
        $fortailss->nama_bahan     = $bp->nama_bahan;
        $fortailss->save();

        $idmaxfortail = Fortail::where('formula_id',$vf)->max('id');
        $fortails     = Fortail::where('id',$idmaxfortail)->first();
        $c = $request->c;
        // Jika Lebih Dari 1
        if($c>0){
            for($d = 1;$d<=$c;$d++){
                $ba[$d] =  Bahan::where('id',$request->alternatif[$d])->first();
                $pkk    = $pkk.' / '.$ba[$d]->kode_komputer;
                $e      = $d+1;
            }
        }
        
        $all =  new AllergenFormula;
        $all->id_bahan=$bp->id;
        $all->id_formula=$vf;
        $all->id_fortails=$fortails->id;
        $all->save();

        if($c>0){
            $fortails->alternatif1= $ba[1]->nama_sederhana;
            $fortails->nama_bahan1= $ba[1]->nama_bahan;
            $fortails->principle1 = $ba[1]->principle;
                    
            $all1 =  new AllergenFormula;
            $all1->id_bahan     = $ba[1]->id;
            $all1->id_formula   = $vf;
            $all1->id_fortails  = $fortails->id;
            $all1->save();
            if($c>1){
                $fortails->alternatif2= $ba[2]->nama_sederhana;
                $fortails->nama_bahan2= $ba[2]->nama_bahan;
                $fortails->principle2 = $ba[2]->principle;
                
                $all2 =  new AllergenFormula;
                $all2->id_bahan     =$ba[2]->id;
                $all2->id_formula   =$vf;
                $all2->id_fortails  =$fortails->id;
                $all2->save();
            }
            if($c>2){
                $fortails->alternatif3= $ba[3]->nama_sederhana;
                $fortails->nama_bahan3= $ba[3]->nama_bahan;
                $fortails->principle3 = $ba[3]->principle;
                
                $all3 =  new AllergenFormula;
                $all3->id_bahan     =$ba[3]->id;
                $all3->id_formula   =$vf;
                $all3->id_fortails  =$fortails->id;
                $all3->save();
            }
            if($c>3){
                $fortails->alternatif4= $ba[4]->nama_sederhana;
                $fortails->nama_bahan4= $ba[4]->nama_bahan;
                $fortails->principle4 = $ba[4]->principle;

                $all4 =  new AllergenFormula;
                $all4->id_bahan     =$ba[4]->id;
                $all4->id_formula   =$vf;
                $all4->id_fortails  =$fortails->id;
                $all4->save();
            }
            if($c>4){
                $fortails->alternatif5= $ba[5]->nama_sederhana;
                $fortails->nama_bahan5= $ba[5]->nama_bahan;
                $fortails->principle5 = $ba[5]->principle;
                
                $all5 =  new AllergenFormula;
                $all5->id_bahan   =$ba[5]->id;
                $all5->id_formula =$vf;
                $all5->id_fortails=$fortails->id;
                $all5->save();
            }
            if($c>5){
                $fortails->alternatif6= $ba[6]->nama_sederhana;
                $fortails->nama_bahan6= $ba[6]->nama_bahan;
                $fortails->principle6 = $ba[6]->principle;
                
                $all6 =  new AllergenFormula;
                $all6->id_bahan     =$ba[6]->id;
                $all6->id_formula   =$vf;
                $all6->id_fortails  =$fortails->id;
                $all6->save();
            }
            if($c>6){
                $fortails->alternatif7= $ba[7]->nama_sederhana;
                $fortails->nama_bahan7= $ba[7]->nama_bahan;
                $fortails->principle7 = $ba[7]->principle;
                
                $all7 =  new AllergenFormula;
                $all7->id_bahan     =$ba[7]->id;
                $all7->id_formula   =$vf;
                $all7->id_fortails  =$fortails->id;
                $all7->save();
            }
        }        

        $fortails->per_serving = $request->per_serving;
        // Jika Base Masih Kosong
        if (isset($request->cbase)){
            $batch   = $request->per_batch;
            $serving = $request->per_serving;
            $mybase  = $batch / $serving;

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
        }else if($mybase>0){                
            $fortails->per_serving = $request->per_serving;  
            $fortails->per_batch   = $mybase * $request->per_serving;                                                        
        }else if($mybase==0){
            $fortails->per_serving = $request->per_serving;
        }

        // Granulasi
        if (isset($request->cgranulasi)){
            $fortails->granulasi = 'ya';                
        }else{
            $fortails->granulasi = 'tidak';
        }

        // premix
        if (isset($request->cpremix)){
            $fortails->premix = 'ya';                
        }else{
            $fortails->premix = 'tidak';
        }    
        $fortails->save();

        // Count Total Serving and Total Batch after inserting
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

        if(auth()->user()->role->namaRule == 'manager'){
            try{
                Mail::send('formula.info', [
                    'info' => 'Manager Anda Telah Merubah Data Untuk Formula "'.$formula->formula.'"' ,
                ],function($message)use($request,$vf){
                    $message->subject('INFO PRODEV');
                    $for = Formula::where('id',$vf)->first();
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
        return redirect()->back()->with('status','BahanBaku Berhasil Ditambahkan');
    }

    public function hapusall($formula){
        $fortails = Fortail::where('formula_id',$formula)->delete();
        $formula  = Formula::where('id',$formula)->first();
        $formula->serving=NULL;
        $formula->batch=NULL;
        $formula->save();

        $allergen = AllergenFormula::where('id_formula',$formula)->delete();

        return redirect::back();
    }

    public function destroy($id,$vf){
        $formula    = Formula::where('id',$vf)->first();
        $idfor      = $formula->workbook_id;
        $idfor_pdf  = $formula->workbook_pdf_id;
        $fortail    = Fortail::where([['id',$id],['formula_id',$vf]])->first();
        $allergen   = AllergenFormula::where('id_fortails',$id)->delete();
        if($formula->batch != null){
            $totalb = $formula->batch - $fortail->per_batch;
            $formula->batch = $totalb;
        }
        
        $totals = $formula->serving - $fortail->per_serving;
        $formula->serving = $totals;
        $formula->save();
       
        $fortail->delete();
        if($formula->workbook_id!=NULL){
            return redirect::back()->with('error','BahanBaku Telah Berhasil Dihapus');
        }if($formula->workbook_pdf_id!=NULL){
            return redirect::back()->with('error','BahanBaku Telah Berhasil Dihapus');
        }
    }
}