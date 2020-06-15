<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dev\Bahan;
use App\master\Curren;
use App\dev\Workbook;
use App\dev\Formula;
use App\dev\Fortail;
use App\Pesan;
use App\manager\pengajuan;
use Auth;
use DB;
use Redirect;

class FormulaApprovalController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv');
    }

    public function listapproval()
    {
        $workbooks = Workbook::where('status','proses')->get();

        //Inisalisasi Project                
        $projects = collect();

        // Checking Proses
        $no = 0; 
        foreach($workbooks as $workbook){

            $formulas = Formula::where([
                [ 'workbook_id',$workbook->id ],
                [ 'vv','!=','' ]
            ])->get();
            // Count Proses
            $jumlah_pengajuan = $formulas->count();                                    
            $jumlah_pesan = 0;                
                        
            // Hitung Jumlah Pesan
            $pm =  Pesan::where([
                ['workbook_id',$workbook->id],
                ['jenis2','pv'],
            ])->count(); 
            
            $pt = Pesan::where([
                ['workbook_id',$workbook->id],
                ['jenis','pv']
            ])->count(); 

            $projects->push([
                'no'               => ++$no,
                'id'               => $workbook->id,
                'user'             => $workbook->user->name,
                'dept'             => $workbook->user->departement->dept,
                'pkp'              => $workbook->NO_PKP,
                'project'          => $workbook->nama_project,
                'revisi'           => $workbook->revisi,
                'jumlah_pengajuan' => $jumlah_pengajuan,
                'pm'               => $pm,
                'pt'               => $pt             
            ]);
    
        }       
        
        return view('pv.approval')->with([
            'projects' => $projects
            ]);
    }

    // Lihat Detail Project Yang Diajukan -------------------------------------------------------------------------
    public function detailproject($id){
        $workbooks = Workbook::where('id',$id)->first();
        $formulas  = Formula::where([
            ['workbook_id', $id],
            ['vv', '!=', '']
            ])->get();
        $cf = $formulas->count();

        // View Pesan 
        $notif = Pesan::where([
            ['workbook_id',$id],
            ['jenis2','pv'],
        ])->count(); 

        $pesan_masuk = Pesan::where([
            ['workbook_id',$id],
            ['jenis2','pv']
        ])->get();

        $pesan_terkirim = Pesan::where([
            ['workbook_id',$id],
            ['jenis','pv']
        ])->get();        
        
    // View Formula
    $myformula = collect();
    $izin_ajukan_finance        = 'ok';
    foreach($formulas as $formula){
        
        if($formula->vv == 'ok'){
            $bintang = collect([
                'id' => $formula->id,
                'versi' => $formula->versi,
                'turunan' => $formula->turunan,
                'vv' => $formula->vv,
                'finance' => $formula->status_fisibility,
                'nutfact' => $formula->status_nutfact,
                'status'  => $formula->status,
                'keterangan' => $formula->keterangan
            ]);

            if($bintang['finance'] == 'proses' || $bintang['nutfact'] == 'proses'){
                $izin_ajukan_finance = 'tidak';
            }            
        }                
        
        $myformula->push([
            'id' => $formula->id,
            'versi' => $formula->versi,
            'turunan' => $formula->turunan,
            'vv' => $formula->vv,
            'finance' => $formula->status_fisibility,
            'nutfact' => $formula->status_nutfact,
            'status'  => $formula->status,
            'keterangan' => $formula->keterangan
        ]);
    }  

    return view('pv.detailproject')->with([
        'myformula' => $myformula,
        'workbooks' => $workbooks,
        'cf'        => $cf,
        'notif'     => $notif,
        'izin_ajukan_finance' => $izin_ajukan_finance,
        'pesan_masuk' => $pesan_masuk,
        'pesan_terkirim' => $pesan_terkirim
    ]);

    }

    // Lihat Detail Formula -----------------------------------------------------------------------------------------------
    public function lihatformulapv($id){

            $formula = Formula::where('id',$id)->first();
            $fortails = Fortail::where('formula_id',$formula->id)->get();
            $ada = Fortail::where('formula_id',$formula->id)->count();
    
            if($ada < 1){
                return Redirect::back()->with('status','Data Bahan Formula Versi '.$formula->versi.' Masih Kosong');
            }elseif($formula->batch < 1){
                return Redirect::back()->with('status','Data Bahan Formula Versi '.$formula->versi.' Belum Memliki Batch');
            }
    
            $detail_formula     = collect();
            $granulasi          = 0;
            $jumlah_granulasi   = 0;
            $biasa              = 0;
            $one_persen         = $formula->batch / 100;
    
            foreach($fortails as $fortail){
                // Get Persen
                $persen = $fortail->per_batch / $one_persen; $persen = round($persen, 2);
                $detail_formula->push([
    
                    'id' => $fortail->id,
                    'kode_komputer' => $fortail->kode_komputer,
                    'nama_sederhana' => $fortail->nama_sederhana,
                    'nama_bahan' => $fortail->nama_bahan,
                    'per_batch' => $fortail->per_batch,
                    'per_serving' => $fortail->per_serving,
                    'granulasi' => $fortail->granulasi,
                    'persen' => $persen,
                ]);            
    
                if($fortail->granulasi == 'ya'){
                    $granulasi = $granulasi + 1;
                    $jumlah_granulasi = $jumlah_granulasi + $fortail->per_batch;
                }
            }
    
            $biasa = $ada - $granulasi;
            $gp    = $jumlah_granulasi / $one_persen; $gp = round($gp , 2);
    
            // Tampil Harga Bahan Baku
            $detail_harga = collect();
            $satu_persen = $formula->serving / 100;
            // Inisialisasi Total
            $total_harga_per_gram = 0;
            $total_berat_per_serving = 0;
            $total_harga_per_serving = 0;
            $total_berat_per_batch = 0;
            $total_harga_per_batch = 0;
            $total_berat_per_kg = 0;
            $total_harga_per_kg = 0; 
    
            foreach($fortails as $fortail){
                //Get Needed
                $bahan  = Bahan::where('id',$fortail->bahan_id)->first();
                $curren = Curren::where('id',$bahan->curren_id)->first();
                //Start Count
                    // Harga Pergram
                    $hpg = ($bahan->harga_satuan * $curren->harga) / ($bahan->berat * 1000); $hpg = round($hpg,2);
                    // PerServing
                    $berat_per_serving = $fortail->per_serving; $berat_per_serving = round($berat_per_serving,5);
                    $persen = $fortail->per_serving / $satu_persen; $persen = round($persen,2);
                    $harga_per_serving = $berat_per_serving * $hpg; $harga_per_serving = round($harga_per_serving,2);
                    // Per Batch
                    $berat_per_batch = $fortail->per_batch; $berat_per_batch = round($berat_per_batch,5);
                    $harga_per_batch = $berat_per_batch * $hpg; $harga_per_batch = round($harga_per_batch,2);
                    // Per Kg
                    $berat_per_kg = (1000 * $berat_per_serving) / $formula->serving; $berat_per_kg = round($berat_per_kg,5);
                    $harga_per_kg = $berat_per_kg * $hpg; $harga_per_kg = round($harga_per_kg,2);       
                // Tampilkan
                $detail_harga->push([
    
                    'id' => $fortail->id,
                    'kode_komputer' => $bahan->kode_komputer,
                    'nama_sederhana' => $bahan->nama_sederhana,
                    'hpg' => $hpg,
                    'per_serving' =>  $berat_per_serving,
                    'persen' => $persen,
                    'harga_per_serving' => $harga_per_serving,
                    'per_batch' => $berat_per_batch,
                    'harga_per_batch' => $harga_per_batch,
                    'per_kg' => $berat_per_kg,
                    'harga_per_kg' => $harga_per_kg
    
                ]);
    
                // Count Total
                $total_harga_per_gram = $total_harga_per_gram + $hpg;
                $total_berat_per_serving = $total_berat_per_serving + $berat_per_serving;
                $total_harga_per_serving = $total_harga_per_serving + $harga_per_serving;
                $total_berat_per_batch = $total_berat_per_batch + $berat_per_batch;
                $total_harga_per_batch = $total_harga_per_batch + $harga_per_batch;
                $total_berat_per_kg = $total_berat_per_kg + $berat_per_kg;
                $total_harga_per_kg = $total_harga_per_kg + $harga_per_kg;
            }
    
            $total_harga = collect([
                'total_harga_per_gram' => $total_harga_per_gram,
                'total_berat_per_serving' => $total_berat_per_serving,
                'total_persen' => 100,
                'total_harga_per_serving' => $total_harga_per_serving,
                'total_berat_per_batch' => $total_berat_per_batch,
                'total_harga_per_batch' => $total_harga_per_batch,
                'total_berat_per_kg' => $total_berat_per_kg,
                'total_harga_per_kg' => $total_harga_per_kg,                       
            ]);
            $workbooks = Workbook::where('status','proses')->get();
            $projects = collect();
            $no = 0; 
        foreach($workbooks as $workbook){

            $formulas = Formula::where([
                [ 'workbook_id',$workbook->id ],
                [ 'vv','!=','' ]
            ])->get();
            // Count Proses
            $jumlah_pengajuan = $formulas->count();                                    
            $jumlah_pesan = 0;                
                        
            // Hitung Jumlah Pesan
            $pm =  Pesan::where([
                ['workbook_id',$workbook->id],
                ['jenis2','pv'],
            ])->count(); 
            
            $pt = Pesan::where([
                ['workbook_id',$workbook->id],
                ['jenis','pv']
            ])->count(); 

            $projects->push([
                'no'               => ++$no,
                'id'               => $workbook->id,
                'user'             => $workbook->user->name,
                'dept'             => $workbook->user->departement->dept,
                'pkp'              => $workbook->NO_PKP,
                'project'          => $workbook->nama_project,
                'revisi'           => $workbook->revisi,
                'jumlah_pengajuan' => $jumlah_pengajuan,
                'pm'               => $pm,
                'pt'               => $pt             
            ]);
    
        }    
            
            return view('pv/detailformula')->with([
                'ada'     => $ada,
                'formula' => $formula,
                'detail_formula' =>  $detail_formula,
                'granulasi' => $granulasi,
                'gp' => $gp,
                'projects' => $projects,
                'detail_harga' => $detail_harga,
                'total_harga' => $total_harga
            ]);

    }

    public function approve($id){
        $formulas = Formula::where('id',$id)->first();

        // Change Star
        $workbook = Workbook::where('id',$formulas->workbook_id)->first();
        $workbook->bintang = $id;
        $workbook->save();

        $formulas->vv = 'ok';
        $formulas->status = 'proses';
        $formulas->save();
        return Redirect::back()->with('status','Formula Versi'.$formulas->versi.'.'.$formulas->turunan.' Telah Diterima');
    }

    public function reject($id){
        $formulas = Formula::where('id',$id)->first();
        $formulas->vv = 'tidak';
        $formulas->status = 'draft';
        $formulas->save();
        return Redirect::back()->with('status','Formula Versi'.$formulas->versi.'.'.$formulas->turunan.' Telah Direject');
    }

    // Batalkan Project -------------------------------------------------------------
    public function batalkanproject($id){
        $workbook = Workbook::where('id',$id)->first();
        $formulas = Formula::where('workbook_id',$id)->get();
        
        // Change Status Workbook
        $workbook->status = 'batal';
        $workbook->bintang = '';
        $workbook->save();
        // Change Sttatus Formula
        foreach($formulas as $formula){
            if($formula->status == 'proses'){
                $formula->status = 'draft';
            }
            if($formula->vv == 'proses'){
                $formula->vv = null;
            }
            if($formula->status_fisibility == 'proses'){
                $formula->status_fisibility = null;
            }
            if($formula->status_nutfact == 'proses'){
                $formula->status_nutfact = null;
            }
            
            $formula->save();
        }
        
        return redirect()->route('approvalformula')->with('error','Project Berhasil Dibatalkan');
    }

    public function listapproved()
    {
        $formulas = Formula::where('vv','!=','proses')->get();

        return view('pv.approved')->with([
            'formulas' => $formulas
            ]);
    }

}