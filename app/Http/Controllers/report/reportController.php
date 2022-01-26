<?php

namespace App\Http\Controllers\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\model\pkp\PkpProject;
use App\model\pkp\notulen;
use App\model\pkp\Forecast;
use App\model\pkp\NoteForecast;
use App\model\pkp\DataPromo;
use App\model\pdf\SubPDF;
use App\model\promo\promo;
use App\model\manager\pengajuan;
use Auth;
use Redirect;
use DB;
use Carbon\Carbon;

class reportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_global' || 'rule:pv_lokal' || 'rule:NR' || 'rule:marketing' || 'rule:manager' || 'rule:admin');
    }

    public function tabulasi(){ // halaman tabulasi project PKP,PDF,PROMo
        $datapkp    = PkpProject::where('status_project','=','active')->where('status_pkp','!=','draf')->where('status_pkp','!=','drop')->orderBy('prioritas','asc')->get();
        $datapdf    = SubPDF::where('status_project','!=','draf') ->join('tr_pdf_project','tr_pdf_project.id_project_pdf','=','tr_sub_pdf.pdf_id')->where('status_pdf','=','active')->get();
        $datapromo  = promo::where('status_project','!=','draf') ->join('tr_promo','tr_project_promo.id_pkp_promo','=','tr_promo.id_pkp_promoo')->where('status_data','=','active')->get();
        $for        = Forecast::all();
        return view('pv.tabulasi')->with([
            'datapkp'   => $datapkp,
            'for'       => $for,
            'datapdf'   => $datapdf,
            'datapromo' => $datapromo
        ]);
    }

    public function reportnotulen(){ // halaman tabulasi notulen meeting
        $not       = notulen::select('tahun')->distinct()->get();
        $tahun     = Carbon::now()->format('Y');
        $DNpkp     = PkpProject::join('tr_notulen','tr_project_pkp.id_project','tr_notulen.id_pkp')->where('tr_notulen.tahun',$tahun)->orderBy('pkp_number','asc')->get();
        return view('pkp.reportnotulen')->with([
            'not'       => $not,
            'DNpkp'     => $DNpkp
        ]);
    }

    public function notulenpkp($bulan,$tgl,$info){ // hlaman notulen PKP
        $informasi = $info;
        $tahun     = Carbon::now()->format('Y');
        $for       = DB::table('tr_forecash')->select('id','id_project','id_pkp','revisi','turunan','revisi_kemas','satuan','forecast')->get();
        $datapkp   = PkpProject::where('status_pkp','sent')->orwhere('status_pkp','proses')->orwhere('status_pkp','revisi')->where('status_project','=','active')
                    ->orderBy('prioritas','asc')->select('id_project','project_name','id_brand','idea','prioritas','launch','years','id_pkp','revisi','turunan','revisi_kemas','status_freeze')->get();
        $notulen1  = DB::table('tr_notulen')->where('tahun',$tahun)->select('id_pkp','note_rd_pv','note_pv_marketing','Bulan','launch_years','launch','prioritas','created')->get();
        $NForecast = DB::table('tr_forecash_notulen')->select('info','satuan','forecash','id_pkp','date','Bulan')->get();
        return view('pkp.notulen')->with([
            'datapkp'   => $datapkp,
            'info'      => $informasi,
            'bln'       => $bulan,
            'tgl'       => $tgl,
            'for'       => $for,
            'notulen'   => $notulen1,
            'NForecast' => $NForecast
        ]) ;
    }

    public function updateUser(Request $request){ // update prioritas project PKP
        $name   = $request->input('name');
        $editid = $request->input('editid');
    
        if($name !=''){
            $not = PkpProject::where('id_project',$request->input('editid'))->first();
            if($not->prioritas<=$request->input('name')){
                $project = PkpProject::where('status_pkp','!=','draf')->where('status_project','=','active')->where('prioritas','<=',$request->input('name'))->get();
                foreach($project as $project){ // untuk project yang memiliki kode prioritas yang lebih besar dari project yang dipilih, maka kode prioritas dari setiap project akan dikurangi 1.
                    $akhir = PkpProject::where('id_project',$project->id_project)->where('prioritas','>=',$not->prioritas)->update([
                        'prioritas' => $project['prioritas']-1,
                    ]);
                }
            }
            elseif($not->prioritas>=$request->input('name')){
                $project = PkpProject::where('status_pkp','!=','draf')->where('status_project','=','active')->where('prioritas','>=',$request->input('name'))->get();
                foreach($project as $project){ // untuk project yang memiliki kode prioritas yang lebih kecil dari project yang dipilih, maka kode prioritas dari setiap project akan ditambah 1.
                    $akhir = PkpProject::where('id_project',$project->id_project)->where('prioritas','<=',$not->prioritas)->update([
                        'prioritas' => $project['prioritas']+1,
                    ]);
                }
            }
            
            $pkp = PkpProject::where('id_project',$request->input('editid'))->first();
            $pkp->prioritas=$request->input('name');
            $pkp->save();
            
          echo 'Update successfully.';
        }else{
          echo 'Fill all fields.';
        }
        exit; 
    }

    public function konfirmasi_notulen(Request $request){ // halaman konfirmasi awal pembuatan notulen
        $tgl        = $request->tgl;
        $konfirmasi = $request->info;
        $bulan      = $request->bulan;
        return redirect::route('notulenpkp',[$bulan,$tgl,$konfirmasi]);
    }

    public function notulenpkpp(Request $request){
        $note = $request->input('note');
        foreach($note as $note){
            $jumlah = notulen::where('id_pkp',$note['pkp'])->where('Bulan',$request->bulan)->where('tahun',$request->tahun)->where('note_rd_pv','!=','NULL')->count();
            $jumlah2 = notulen::where('id_pkp',$note['pkp'])->where('Bulan',$request->bulan)->where('tahun',$request->tahun)->where('note_pv_marketing','!=','NULL')->count();
            if($request->info=='1' && $note['note']!=NULL){
                $not = notulen::where('id_pkp',$note['pkp'])->where('Bulan',$request->bulan)->where('tahun',$request->tahun)->update([
                    'id_pkp'        => $note['pkp'],
                    'note_rd_pv'    => $note['note'],
                    'Bulan'         => $request->bulan,
                    'tahun'         => $request->tahun,
                    'created'       => $request->date,
                    'launch'        => $note['launch'],
                    'launch_years'  => $note['years'],
                    'prioritas'     => $note['prio'],
                    'user'          => Auth::user()->id
                ]);
                $nf = NoteForecast::where('info','=','1')->where('id_pkp',$note['pkp'])->delete();
            }elseif($request->info=='2' && $note['note']!=NULL){
                $not = notulen::where('id_pkp',$note['pkp'])->where('Bulan',$request->bulan)->where('tahun',$request->tahun)->update([
                    'id_pkp'            => $note['pkp'],
                    'note_pv_marketing' => $note['note'],
                    'Bulan'             => $request->bulan,
                    'tahun'             => $request->tahun,
                    'created'           => $request->date,
                    'launch'            => $note['launch'],
                    'launch_years'      => $note['years'],
                    'prioritas'         => $note['prio'],
                    'user'              => Auth::user()->id
                ]);
                $nf = NoteForecast::where('info','=','2')->where('id_pkp',$note['pkp'])->delete();
            }
            if($jumlah=='0' && $jumlah2=='0' && $note['note']){
                    $not = new notulen;
                    $not->id_pkp = $note['pkp'];
                    if($request->info=='1'){
                        $not->note_rd_pv = $note['note'];
                    }
                    if($request->info=='2'){
                        $not->note_pv_marketing = $note['note'];
                    }
                    $not->Bulan         = $request->bulan;
                    $not->tahun         = $request->tahun;
                    $not->created       = $request->date;
                    $not->launch        = $note['launch'];
                    $not->launch_years  = $note['years'];
                    $not->prioritas     = $note['prio'];
                    $not->user          = Auth::user()->id;
                    $not->save();
            }

            $project = PkpProject::where('id_project',$note['pkp'])->update([
                "launch" => $note['launch'],
                "years"  => $note['years']
            ]);
        }

        $for = $request->input('for');
        foreach($for as $for){
            if($request->info=='1'){
                $fn = new NoteForecast;
                $fn->id_pkp   = $for['id'];
                $fn->forecash = $for['for'];
                $fn->satuan   = $for['satuan'];
                $fn->Bulan    = $request->bulan;
                $fn->tahun    = $request->tahun;
                $fn->date     = $for['up'];
                $fn->info     = '1';
                $fn->save();
            }elseif($request->info=='2'){
                $fn = new NoteForecast;
                $fn->id_pkp   = $for['id'];
                $fn->forecash = $for['for'];
                $fn->satuan   = $for['satuan'];
                $fn->Bulan    = $request->bulan;
                $fn->tahun    = $request->tahun;
                $fn->date     = $for['up'];
                $fn->info     = '2';
                $fn->save();
            }
              
            $fc = Forecast::where('id',$for['pr'])->update([
                "forecast" => $for['for'],
                "satuan"   => $for['satuan']
            ]);
        }
        return redirect::back()->with('status', 'Saved data ');
    }

    public function editnote(Request $request){
        $note = $request->input('pkp');
        foreach($note as $pkp){
            $npkp = notulen::where('id_notulen',$pkp['pkp_id'])->update([
                "note" => $pkp['note'],
                "user" => Auth::user()->id
            ]);
        }
        return redirect::back()->with('status', 'Saved data ');
    }

    public function pengajuan(){
        $pengajuanpdf   = pengajuan::where('id_pdf','!=','')->get();
        $pengajuanpkp   = pengajuan::where('id_pkp','!=','')->get();
        $pengajuanpromo = pengajuan::where('id_promo','!=','')->get();
        $pengajuan      = pengajuan::count();
        return view('pv.datapengajuan')->with([
            'pengajuanpdf'   => $pengajuanpdf,
            'pengajuanpkp'   => $pengajuanpkp,
            'pengajuan'      => $pengajuan,
            'pengajuanpromo' => $pengajuanpromo
        ]);
    }
}