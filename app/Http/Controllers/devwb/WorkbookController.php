<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\dev\Workbook;
use App\dev\Formula;
use App\dev\Fortail;
use App\dev\Premix;
use App\dev\Pretail;
use App\master\Jenismakanan;
use App\master\Brand;
use App\pkp\pkp_project;
use App\pkp\tipp;
use App\User;
use App\Pesan;
use Auth;
use Redirect;

class WorkbookController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function index(){   
        $id = Auth::id();
        $workbooks = Workbook::where('user_id',$id)->get();
        $jms = Jenismakanan::all();
        $brands = Brand::all();
        $cw = Workbook::where('user_id',$id)->count();
        $no = 0;

        $allproject = collect();
        foreach ($workbooks as $workbook){

            // Hitung Jumlah Pesan
            $pm =  Pesan::where([
                ['workbook_id',$workbook->id],
                ['jenis2','dev'],
            ])->count(); 
            
            $pt = Pesan::where([
                ['workbook_id',$workbook->id],
                ['jenis','dev']
            ])->count(); 

            // Hitung Jumlah Versi
            $jv = Formula::where('workbook_id',$workbook->id)->count();

            $allproject->push([
                'id' => $workbook->id,                
                'nama_project' => $workbook->nama_project,
                'NO_PKP' => $workbook->NO_PKP,
                'jenis' => $workbook->jenis,
                'revisi' => $workbook->revisi,
                'deskripsi' => $workbook->deskripsi,
                'status' => $workbook->status,
                'jv' => $jv,
                'pm' => $pm,
                'pt' => $pt
            ]);
        }

        return view('devwb.workbooks')->with([
            'no' => $no,
            'allproject' => $allproject,
            'jms' => $jms,
            'brands' => $brands,
            'cw' => $cw
            ]);
    }

    public function store(Request $request)
    {
        $workbooks = new Workbook;
        $workbooks->user_id = $request->user;
        $workbooks->nama_project = $request->nama;
        $workbooks->mnrq = $request->mnrq;
        $workbooks->NO_PKP = $request->pkp;
        $workbooks->jenis = $request->jenis;
        if($request->revisi != ''){
            $workbooks->revisi = $request->revisi;
        }        
        $workbooks->subbrand_id = $request->subbrand;
        $workbooks->jenismakanan_id = $request->jm;
        $workbooks->tarkon = $request->tarkon;
        $workbooks->deskripsi = $request->deskripsi;
        $workbooks->save();
        
        return Redirect::back()->with('status', 'Workbook '.$workbooks->nama_project.' Telah Ditambahkan!');
    }

    public function update($id,Request $request)
    {
        $workbooks = Workbook::find($id);
        $workbooks->nama_project = $request->nama;
        $workbooks->mnrq = $request->mnrq;
        $workbooks->NO_PKP = $request->pkp;
        $workbooks->jenis = $request->jenis;
        if($request->revisi != ''){
            $workbooks->revisi = $request->revisi;
        }        
        $workbooks->subbrand_id = $request->subbrand;
        $workbooks->jenismakanan_id = $request->jm;
        $workbooks->tarkon_id = $request->tarkon;
        $workbooks->deskripsi = $request->deskripsi;
        $workbooks->target_serving = $request->target_serving;
        $workbooks->save();
        
        $formulas = Formula::where('workbook_id',$id)->get();
        foreach($formulas as $formula){
            $formula->nama_produk = $request->nama;
            $formula->jenis = $request->jenis;
            $formula->revisi = $request->revisi;
            $formula->subbrand_id = $request->subbrand;
            $formula->save();
        }

        return Redirect::back()->with('status', 'Workbook '.$workbooks->nama_project.' Berhasil Di Update!');
    }

    public function show($id)
    {
        $pkp = tipp::where('id',$id)->join('pkp_project','pkp_project.id_project','=','tippu.id_pkp')->where('status_data','=','active')->get();
        //dd($data);
        $workbooks = tipp::find($id);
        $formulas  = Formula::where('workbook_id', $id)->get();
        $cf=Formula::where('workbook_id', $id)->count();
        
        // Untuk edit Workbook / Alihkan Workbook
        $jms = Jenismakanan::all();
        $brands = Brand::all();
        $users = DB::table('users')->where([
            ['id',"!=", Auth::id()],
            ['role_id', Auth::user()->role_id],
            ['status', 'active']
            ])->get();
        
         // View Pesan 
        $notif = Pesan::where([
            ['workbook_id',$id],
            ['jenis2','dev'],
        ])->count(); 

        $pesan_masuk = Pesan::where([
            ['workbook_id',$id],
            ['jenis2','dev']
        ])->get();

        $pesan_terkirim = Pesan::where([
            ['workbook_id',$id],
            ['jenis','dev']
        ])->get();      

        // View
        $myformula = collect();
        $vpf       = collect();
        foreach($formulas as $formula){
            $myformula->push([
                'id' => $formula->id,
                'workbook_id' =>$formula->workbook_id,
                'versi' => $formula->versi,
                'turunan' => $formula->turunan,
                'vv' => $formula->vv,
                'finance' => $formula->status_fisibility,
                'nutfact' => $formula->status_nutfact,
                'status'  => $formula->status,
                'keterangan'    => $formula->keterangan
            ]);

            // VPF
            if($formula->vv == 'ok' || $formula->vv == 'proses' || $formula->vv == 'tidak'){
                $vpf->push([
                    'id' => $formula->id,
                    'workbook_id' =>$formula->workbook_id,
                    'versi' => $formula->versi,
                    'turunan' => $formula->turunan,
                    'vv' => $formula->vv,
                    'finance' => $formula->status_fisibility,
                    'nutfact' => $formula->status_nutfact,
                    'status'  => $formula->status,
                    'keterangan'    => $formula->keterangan
                ]);
            }
        }

        return view('devwb.formula')->with([
            'workbooks' => $workbooks,
            'pkp' => $pkp,
            'myformula' =>  $myformula,
            'vpf' => $vpf,
            'cf' => $cf,
            'users' => $users,
            'jms' => $jms,
            'brands' => $brands,
            'notif' => $notif,
            'pesan_masuk' => $pesan_masuk,
            'pesan_terkirim' => $pesan_terkirim
            ]);
    }

    public function alihkan($id,Request $request)
    {
        $workbooks = Workbook::find($id);
        $workbooks->user_id = $request->user;
        $workbooks->save();
        $pp = User::find($request->user);
        
        return Redirect()->route('myworkbooks')->with('status', 'Workbook '.$workbooks->nama_project.' Telah Dialihkan Kepada '.$pp->name);
    }

    public function destroy($id)
    {
        // find all & delete all
        $workbook = Workbook::where([
            ['id',$id],
            ['user_id',Auth::id()]
        ])->first();

        // Delete Pesan
        $pesan = Pesan::where('workbook_id',$id)->delete();
        $n = $workbook->nama_project;

        $formulas = Formula::where('workbook_id',$workbook->id)->get();
        foreach($formulas as $formula){
            $fortails = Fortail::where('formula_id',$formula->id)->get();
            foreach($fortails as $fortail){
                $premixs = Premix::where('fortail_id',$fortail->id)->get();
                foreach($premixs as $premix){
                    $pretails = Pretail::where('premix_id',$premix->id)->get();
                    foreach($pretails as $pretail){
                        $pretail->delete();
                    }
                $premix->delete();
                }
            $fortail->delete();
            }
        $formula->delete();
        }
        $workbook->delete();

        return Redirect::back()->with('error', 'Workbook '.$n.' Telah Dihapus!');
    }

    public function endproject($id){
        $workbook = Workbook::where('id',$id)->first();
        $formulas = Formula::where('workbook_id',$id)->get();
        
        // Change Status Workbook
        $workbook->status = 'selesai';
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
        
        return Redirect::back()->with('status','Project Telah Diselesaikan');
    }

    public function batalproject($id){
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
        return Redirect::back()->with('error','Project Dibatalkan');
    }

}