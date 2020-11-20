<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\pkp\pkp_project;
use App\pkp\pkp_type;
use App\pkp\project_pdf;
use App\master\Brand;
use App\pkp\data_ses;
use App\pkp\promo_idea;
use App\manager\pengajuan;
use App\pkp\promo;
use App\users\Departement;
use App\pkp\picture;
use App\User;
use App\pkp\tipp;
use App\pkp\apppromo;
use App\pkp\data_detail_klaim;
use App\pkp\product_allocation;
use App\pkp\data_promo;
use App\pkp\data_klaim;
use App\pkp\coba;
use App\pkp\data_forecast;

use Redirect;
use DB;
use Charts;
use Auth;

class managerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:manager');
    }

    public function listpkp(){
        $ppkp = pkp_project::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppkp1 = pkp_project::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppromo = promo::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppromo1 = promo::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppdf = project_pdf::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppdf1 = project_pdf::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $pkpselesai2 = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pkpselesai = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pdfselesai2= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pdfselesai= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $promoselesai2 = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$promoselesai = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $data = $ppkp + $ppdf + $ppromo;$data2 =  $ppkp1 + $ppdf1 + $ppromo1;$notif2 = $pkpselesai2 + $pdfselesai2 + $promoselesai2 ;$notif = $pkpselesai + $pdfselesai + $promoselesai;
        $pkp = pkp_project::where('status_project','!=','draf')->orderBy('prioritas','asc')->get();
        $pkpname = pkp_project::where('status_project','!=','draf')->get();
        $type = pkp_type::all();
        $brand = brand::all();
        return view('manager.listpkp')->with([
            'type' => $type,
            'brand' => $brand,
            'pkpname' => $pkpname,
            'pkp' => $pkp,
            'ppkp' => $ppkp,'ppkp1' => $ppkp1,
            'ppromo' => $ppromo,'ppromo1' => $ppromo1,
            'ppdf' => $ppdf,'ppdf1' => $ppdf1,
            'notif' => $notif,'notif2' => $notif2,'data' => $data,'data2' => $data2,
            'pkpselesai' =>$pkpselesai,'pkpselesai2' => $pkpselesai2,
            'pdfselesai' => $pdfselesai,'pdfselesai2' => $pdfselesai2,
            'promoselesai' => $promoselesai,'promoselesai2' => $promoselesai2
        ]);
    }

    public function listpdf(){
        $pdf = project_pdf::where('status_project','!=','draf')->orderBy('prioritas','asc')->get();
        $type = pkp_type::all();
        $brand = brand::all();
        $brand = brand::all();
        $ppkp = pkp_project::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppkp1 = pkp_project::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppromo = promo::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppromo1 = promo::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppdf = project_pdf::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppdf1 = project_pdf::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $pkpselesai2 = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pkpselesai = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pdfselesai2= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pdfselesai= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $promoselesai2 = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$promoselesai = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $data = $ppkp + $ppdf + $ppromo;$data2 =  $ppkp1 + $ppdf1 + $ppromo1;$notif2 = $pkpselesai2 + $pdfselesai2 + $promoselesai2 ;$notif = $pkpselesai + $pdfselesai + $promoselesai;

        return view('manager.listpdf')->with([
            'type' => $type,
            'pdf' => $pdf,
            'brand' => $brand,
            'brand' => $brand,
            'ppkp' => $ppkp,'ppkp1' => $ppkp1,
            'ppromo' => $ppromo,'ppromo1' => $ppromo1,
            'ppdf' => $ppdf,'ppdf1' => $ppdf1,
            'notif' => $notif,'notif2' => $notif2,'data' => $data,'data2' => $data2,
            'pkpselesai' =>$pkpselesai,'pkpselesai2' => $pkpselesai2,
            'pdfselesai' => $pdfselesai,'pdfselesai2' => $pdfselesai2,
            'promoselesai' => $promoselesai,'promoselesai2' => $promoselesai2
        ]);
    }

    public function listpromo(){
        $pkp = promo::where('status_project','!=','draf')->orderBy('prioritas','asc')->get();
        $brand = brand::all();
        $jumlahpkp = data_promo::where('status_promo','=','sent')->count();
        $ppkp = pkp_project::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppkp1 = pkp_project::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppromo = promo::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppromo1 = promo::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppdf = project_pdf::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppdf1 = project_pdf::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $pkpselesai2 = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pkpselesai = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pdfselesai2= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pdfselesai= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $promoselesai2 = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$promoselesai = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $data = $ppkp + $ppdf + $ppromo;$data2 =  $ppkp1 + $ppdf1 + $ppromo1;$notif2 = $pkpselesai2 + $pdfselesai2 + $promoselesai2 ;$notif = $pkpselesai + $pdfselesai + $promoselesai;

        return view('manager.listpromo')->with([
            'pkp' => $pkp,
            'brand' => $brand,
            'jumlah' => $jumlahpkp,
            'ppkp' => $ppkp,'ppkp1' => $ppkp1,
            'ppromo' => $ppromo,'ppromo1' => $ppromo1,
            'ppdf' => $ppdf,'ppdf1' => $ppdf1,
            'notif' => $notif,'notif2' => $notif2,'data' => $data,'data2' => $data2,
            'pkpselesai' =>$pkpselesai,'pkpselesai2' => $pkpselesai2,
            'pdfselesai' => $pdfselesai,'pdfselesai2' => $pdfselesai2,
            'promoselesai' => $promoselesai,'promoselesai2' => $promoselesai2
        ]);
    }
    
    public function pengajuan(Request $request){
        $pengajuan = new pengajuan;
        $pengajuan->prioritas_pengajuan=$request->prioritas;
        $pengajuan->penerima=$request->penerima;
        $pengajuan->id_pkp=$request->pkp;
        $pengajuan->alasan_pengajuan=$request->catatan;
        $pengajuan->jangka=$request->jangka;
        $pengajuan->waktu=$request->waktu;
        $pengajuan->turunan=$request->turunan;
        $pengajuan->save();

        $pkp = pkp_project::where('id_project',$request->pkp)->first();
        $pkp->status_project='revisi';
        $pkp->save();

        return Redirect::Route('listpkprka');
    }

    public function pengajuanpdf(Request $request){
        $pengajuan = new pengajuan;
        $pengajuan->prioritas_pengajuan=$request->prioritas;
        $pengajuan->penerima=$request->penerima;
        $pengajuan->id_pdf=$request->pdf;
        $pengajuan->alasan_pengajuan=$request->catatan;
        $pengajuan->jangka=$request->jangka;
        $pengajuan->waktu=$request->waktu;
        $pengajuan->turunan=$request->turunan;
        $pengajuan->save();

        $pkp = project_pdf::where('id_project_pdf',$request->pdf)->first();
        $pkp->status_project='revisi';
        $pkp->save();

        return Redirect::Route('listpdfrka');
    }

    public function pengajuanpromo(Request $request){
        $pengajuan = new pengajuan;
        $pengajuan->prioritas_pengajuan=$request->prioritas;
        $pengajuan->penerima=$request->penerima;
        $pengajuan->id_promo=$request->promo;
        $pengajuan->alasan_pengajuan=$request->catatan;
        $pengajuan->jangka=$request->jangka;
        $pengajuan->waktu=$request->waktu;
        $pengajuan->turunan=$request->turunan;
        $pengajuan->save();

        $pkp = promo::where('id_pkp_promo',$request->promo)->first();
        $pkp->status_project='revisi';
        $pkp->save();

        return Redirect::Route('listpromoo');
    }

    public function dasboardmanager(){
        $ppkp = pkp_project::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppkp1 = pkp_project::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppromo = promo::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppromo1 = promo::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppdf = project_pdf::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppdf1 = project_pdf::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $pkpselesai2 = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pkpselesai = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pdfselesai2= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pdfselesai= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $promoselesai2 = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$promoselesai = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $data = $ppkp + $ppdf + $ppromo;$data2 =  $ppkp1 + $ppdf1 + $ppromo1;$notif2 = $pkpselesai2 + $pdfselesai2 + $promoselesai2 ;$notif = $pkpselesai + $pdfselesai + $promoselesai;
        // chart PKP
        $revisi = pkp_project::where('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $proses = pkp_project::where('status_project','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $sent= pkp_project::where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $close = pkp_project::where('status_project','=','close')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pie  =	 Charts::create('bar', 'highcharts')->title('Data PKP')->colors(['#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['sent', 'revisi', 'proses', 'close'])->values([$sent,$revisi,$proses,$close])->responsive(false);
        // chart PDF
        $revisipdf = project_pdf::where('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $prosespdf = project_pdf::where('status_project','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $sentpdf= project_pdf::where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $closepdf = project_pdf::where('status_project','=','close')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pie2  =	 Charts::create('pie', 'highcharts')->title('Data PDF')->colors(['#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['sent', 'revisi', 'proses', 'close'])->values([$sentpdf,$revisipdf,$prosespdf,$closepdf])->responsive(false);
        // chart promo
        $revisipromo = promo::where('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $prosespromo = promo::where('status_project','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $sentpromo = promo::where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $closepromo = promo::where('status_project','=','close')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pie3  =	 Charts::create('area', 'highcharts')->title('Data PKP Promo')->labels(['sent', 'revisi', 'proses', 'close'])->values([$sentpromo,$revisipromo,$prosespromo,$closepromo])->responsive(false);
        // chart PKP
        $revisi2 = pkp_project::where('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $proses2 = pkp_project::where('status_project','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $sent2 = pkp_project::where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $close2 = pkp_project::where('status_project','=','close')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $chart1  =	 Charts::create('bar', 'highcharts')->title('Data PKP')->colors(['#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['sent', 'revisi', 'proses', 'close'])->values([$sent2,$revisi2,$proses2,$close2])->responsive(false);
        // chart PDF
        $revisipdf2 = project_pdf::where('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $prosespdf2 = project_pdf::where('status_project','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $sentpdf2= project_pdf::where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $closepdf2 = project_pdf::where('status_project','=','close')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $chart2  =	 Charts::create('pie', 'highcharts')->title('Data PDF')->colors(['#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['sent', 'revisi', 'proses', 'close'])->values([$sentpdf2,$revisipdf2,$prosespdf2,$closepdf2])->responsive(false);
        // chart promo
        $revisipromo2 = promo::where('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $prosespromo2 = promo::where('status_project','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $sentpromo2 = promo::where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $closepromo2 = promo::where('status_project','=','close')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $chart3  =	 Charts::create('area', 'highcharts')->title('Data PKP Promo')->labels(['sent', 'revisi', 'proses', 'close'])->values([$sentpromo2,$revisipromo2,$prosespromo2,$closepromo2])->responsive(false);
        
        return view('manager.dasboard')->with([
            'chart1' => $chart1,
            'chart2' => $chart2,
            'chart3' => $chart3,
            'pie' => $pie,'pie2' => $pie2,'pie3' => $pie3,
            'ppkp' => $ppkp,'ppkp1' => $ppkp1,
            'ppromo' => $ppromo,'ppromo1' => $ppromo1,
            'ppdf' => $ppdf,'ppdf1' => $ppdf1,
            'notif' => $notif,'notif2' => $notif2,'data' => $data,'data2' => $data2,
            'pkpselesai' =>$pkpselesai,'pkpselesai2' => $pkpselesai2,
            'pdfselesai' => $pdfselesai,'pdfselesai2' => $pdfselesai2,
            'promoselesai' => $promoselesai,'promoselesai2' => $promoselesai2
        ]);
    }

    public function daftarpkp($id_project){
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $max2 = tipp::where('id_pkp',$id_project)->max('revisi');
        $user = user::where('status','=','active')->get();
        $datapkp = tipp::where('id_pkp',$id_project)->where('status_pkp','sent')->where('turunan',$max)->where('turunan',$max)->where('revisi',$max2)->get();
        $pkp1 = pkp_project::where('id_project',$id_project)->get();
        $data = pkp_project::where('id_project',$id_project)->get();
        $pengajuan = pengajuan::where('id_pkp',$id_project)->count();
        $dept = Departement::where('Divisi','=','RND')->get();
        $ppkp = pkp_project::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppkp1 = pkp_project::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppromo = promo::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppromo1 = promo::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppdf = project_pdf::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppdf1 = project_pdf::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $pkpselesai2 = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pkpselesai = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pdfselesai2= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pdfselesai= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $promoselesai2 = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$promoselesai = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $data = $ppkp + $ppdf + $ppromo;$data2 =  $ppkp1 + $ppdf1 + $ppromo1;$notif2 = $pkpselesai2 + $pdfselesai2 + $promoselesai2 ;$notif = $pkpselesai + $pdfselesai + $promoselesai;
        return view('manager.daftarpkp')->with([
            'pkp' => $pkp,
            'pkp1' => $pkp1,
            'user' => $user,
            'dept' => $dept,
            'pengajuan' => $pengajuan,
            'datapkp' => $datapkp,
            'data' => $data,
            'ppkp' => $ppkp,'ppkp1' => $ppkp1,
            'ppromo' => $ppromo,'ppromo1' => $ppromo1,
            'ppdf' => $ppdf,'ppdf1' => $ppdf1,
            'notif' => $notif,'notif2' => $notif2,'data' => $data,'data2' => $data2,
            'pkpselesai' =>$pkpselesai,'pkpselesai2' => $pkpselesai2,
            'pdfselesai' => $pdfselesai,'pdfselesai2' => $pdfselesai2,
            'promoselesai' => $promoselesai,'promoselesai2' => $promoselesai2
        ]);
    }

    public function daftarpdf($id_project_pdf){
        $data = project_pdf::where('id_project_pdf',$id_project_pdf)->get();
        $hitung = coba::where('pdf_id',$id_project_pdf)->count();
        $dept = Departement::all();
        $max = coba::where('pdf_id',$id_project_pdf)->max('turunan');
        $max2 = coba::where('pdf_id',$id_project_pdf)->max('revisi');
        $pdf = project_pdf::where('id_project_pdf',$id_project_pdf)->join('tipu','pdf_project.id_project_pdf','tipu.pdf_id')->where('status_data','=','sent')->where('revisi',$max2)->where('turunan',$max)->get();
        $pengajuan = pengajuan::where('id_pdf',$id_project_pdf)->count();
        $ppkp = pkp_project::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppkp1 = pkp_project::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppromo = promo::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppromo1 = promo::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppdf = project_pdf::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppdf1 = project_pdf::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $pkpselesai2 = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pkpselesai = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pdfselesai2= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pdfselesai= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $promoselesai2 = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$promoselesai = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $data = $ppkp + $ppdf + $ppromo;$data2 =  $ppkp1 + $ppdf1 + $ppromo1;$notif2 = $pkpselesai2 + $pdfselesai2 + $promoselesai2 ;$notif = $pkpselesai + $pdfselesai + $promoselesai;
        return view('manager.daftarpdf')->with([
            'data' => $data,
            'hitung' => $hitung,
            'dept' => $dept,
            'pdf' => $pdf,
            'pengajuan' => $pengajuan,
            'ppkp' => $ppkp,'ppkp1' => $ppkp1,
            'ppromo' => $ppromo,'ppromo1' => $ppromo1,
            'ppdf' => $ppdf,'ppdf1' => $ppdf1,
            'notif' => $notif,'notif2' => $notif2,'data' => $data,'data2' => $data2,
            'pkpselesai' =>$pkpselesai,'pkpselesai2' => $pkpselesai2,
            'pdfselesai' => $pdfselesai,'pdfselesai2' => $pdfselesai2,
            'promoselesai' => $promoselesai,'promoselesai2' => $promoselesai2
        ]);
    }

    public function daftarpromo($id_pkp_promo){
        $data = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $dept = Departement::all();
        $max = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $max2 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('revisi');
        $pkp = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('status_promo','=','sent')->where('turunan',$max)->where('revisi',$max2)->get();
        $promo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $pengajuan = pengajuan::where('id_promo',$id_pkp_promo)->count();
        $ppkp = pkp_project::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppkp1 = pkp_project::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppromo = promo::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppromo1 = promo::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppdf = project_pdf::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppdf1 = project_pdf::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $pkpselesai2 = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pkpselesai = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pdfselesai2= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pdfselesai= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $promoselesai2 = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$promoselesai = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $data = $ppkp + $ppdf + $ppromo;$data2 =  $ppkp1 + $ppdf1 + $ppromo1;$notif2 = $pkpselesai2 + $pdfselesai2 + $promoselesai2 ;$notif = $pkpselesai + $pdfselesai + $promoselesai;
        return view ('manager.daftarpromo')->with([
            'data' => $data,
            'promo' => $promo,
            'pkp' => $pkp,
            'dept' => $dept,
            'pengajuan' => $pengajuan,
            'ppkp' => $ppkp,'ppkp1' => $ppkp1,
            'ppromo' => $ppromo,'ppromo1' => $ppromo1,
            'ppdf' => $ppdf,'ppdf1' => $ppdf1,
            'notif' => $notif,'notif2' => $notif2,'data' => $data,'data2' => $data2,
            'pkpselesai' =>$pkpselesai,'pkpselesai2' => $pkpselesai2,
            'pdfselesai' => $pdfselesai,'pdfselesai2' => $pdfselesai2,
            'promoselesai' => $promoselesai,'promoselesai2' => $promoselesai2
        ]);
    }

    public function samplepkp($id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->pengajuan_sample='sent';
        $pkp->save();
        return redirect::back();
    }

    public function samplepdf($id_project_pdf){
        $pkp = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $pkp->pengajuan_sample='sent';
        $pkp->save();
        return redirect::back();
    }

    public function samplepromo($id_pkp_promo){
        $pkp = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pkp->pengajuan_sample='sent';
        $pkp->save();
        return redirect::back();
    }

    public function lihatpdf($id_project_pdf,$revisi,$turunan){
        $pdf = project_pdf::join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $hitung = pengajuan::where([ ['id_pdf',$id_project_pdf], ['turunan',$turunan] ])->count();
        $ses = data_ses::where([ ['id_pdf',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $pdf1 = coba::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $for = data_forecast::where('id_pdf',$id_project_pdf)->where('turunan',$turunan)->get();
        $nopdf = DB::table('pdf_project')->max('pdf_number')+1;
        $dept = Departement::all();
        $user = DB::table('users') ->where('departement_id',Auth::user()->departement->id)->get();
        $picture = picture::where('pdf_id',$id_project_pdf)->get();
        $ppkp = pkp_project::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppkp1 = pkp_project::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppromo = promo::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppromo1 = promo::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppdf = project_pdf::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppdf1 = project_pdf::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $pkpselesai2 = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pkpselesai = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pdfselesai2= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pdfselesai= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $promoselesai2 = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$promoselesai = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $data = $ppkp + $ppdf + $ppromo;$data2 =  $ppkp1 + $ppdf1 + $ppromo1;$notif2 = $pkpselesai2 + $pdfselesai2 + $promoselesai2 ;$notif = $pkpselesai + $pdfselesai + $promoselesai;
        return view('manager.lihatpdf')->with([
            'pdf' => $pdf,
            'pdf1' => $pdf1,
            'dept' => $dept,
            'for' => $for,
            'datases' => $ses,
            'user' => $user,
            'hitung' => $hitung,
            'nopdf' => substr("T00".$nopdf,1,3),
            'picture' => $picture,
            'ppkp' => $ppkp,'ppkp1' => $ppkp1,
            'ppromo' => $ppromo,'ppromo1' => $ppromo1,
            'ppdf' => $ppdf,'ppdf1' => $ppdf1,
            'notif' => $notif,'notif2' => $notif2,'data' => $data,'data2' => $data2,
            'pkpselesai' =>$pkpselesai,'pkpselesai2' => $pkpselesai2,
            'pdfselesai' => $pdfselesai,'pdfselesai2' => $pdfselesai2,
            'promoselesai' => $promoselesai,'promoselesai2' => $promoselesai2
        ]); 
    }

    public function lihatpkp($id_project,$revisi,$turunan){
        $pengajuanpkp = pkp_project::join('pkp_pengajuan','pkp_project.id_project','=','pkp_pengajuan.id_pkp')->count();
        $datapkp = tipp::where('id_pkp',$id_project)->count();
        $nopkp = DB::table('pkp_project')->max('pkp_number')+1;
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $for = data_forecast::where('id_pkp',$id_project)->where('turunan',$turunan)->get();
        $dataklaim = data_klaim::where('id_pkp',$id_project)->join('klaim','klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pkpp = tipp::join('pkp_project','tippu.id_pkp','=','pkp_project.id_project')->where([ ['id_project',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $ses= data_ses::where([ ['id_pkp',$id_project], ['turunan',$turunan] ])->get();
        $pkp1 = tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pengajuan = pengajuan::where('id_pkp',$id_project)->where('turunan',$turunan)->count();
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('turunan',$turunan)->get();
        $user = DB::table('users')->where('departement_id',Auth::user()->departement->id)->get();
        $picture = picture::where('pkp_id',$id_project)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        $dept = Departement::all();$dept1 = Departement::all();
        $ppkp = pkp_project::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppkp1 = pkp_project::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppromo = promo::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppromo1 = promo::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppdf = project_pdf::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppdf1 = project_pdf::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $pkpselesai2 = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pkpselesai = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pdfselesai2= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pdfselesai= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $promoselesai2 = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$promoselesai = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $data = $ppkp + $ppdf + $ppromo;$data2 =  $ppkp1 + $ppdf1 + $ppromo1;$notif2 = $pkpselesai2 + $pdfselesai2 + $promoselesai2 ;$notif = $pkpselesai + $pdfselesai + $promoselesai;
        return view('manager.lihatpkp')->with([
            'pkpp' => $pkpp,
            'pengajuan' => $pengajuan,
            'pkp' => $pkp,
            'datases' => $ses,
            'for' => $for,
            'datadetail' => $datadetail,
            'dataklaim' => $dataklaim,
            'pkp1' => $pkp1,
            'pengajuanpkp' => $pengajuanpkp,
            'user' => $user,
            'datapkp' => $datapkp,
            'nopkp' => substr("T00".$nopkp,1,3),
            'picture' => $picture,
            'dept' => $dept,
            'dept1' => $dept1,
            'ppkp' => $ppkp,'ppkp1' => $ppkp1,
            'ppromo' => $ppromo,'ppromo1' => $ppromo1,
            'ppdf' => $ppdf,'ppdf1' => $ppdf1,
            'notif' => $notif,'notif2' => $notif2,'data' => $data,'data2' => $data2,
            'pkpselesai' =>$pkpselesai,'pkpselesai2' => $pkpselesai2,
            'pdfselesai' => $pdfselesai,'pdfselesai2' => $pdfselesai2,
            'promoselesai' => $promoselesai,'promoselesai2' => $promoselesai2
        ]); 
    }

    public function lihatpromo($id_pkp_promo,$revisi,$turunan){
        $promoo = data_promo::join('pkp_promo','isi_promo.id_pkp_promoo','=','pkp_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $hitung = pengajuan::where([ ['id_promo',$id_pkp_promo], ['turunan',$turunan] ])->count();
        $max2 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('revisi');
        $max = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $promo1 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$max2)->where('turunan',$max)->get();
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $idea = promo_idea::where('id_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $nopromo = DB::table('pkp_promo')->max('promo_number')+1;
        $picture = picture::where('promo',$id_pkp_promo)->get();
        $app = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$max2)->where('turunan',$max)->get();
        $dept = Departement::all();
        $user = DB::table('users')->where('departement_id',Auth::user()->departement->id)->get();
        $ppkp = pkp_project::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppkp1 = pkp_project::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppromo = promo::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppromo1 = promo::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $ppdf = project_pdf::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();$ppdf1 = project_pdf::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $pkpselesai2 = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pkpselesai = pkp_project::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pdfselesai2= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$pdfselesai= project_pdf::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $promoselesai2 = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();$promoselesai = promo::where('status_project','=','sent')->orwhere('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $data = $ppkp + $ppdf + $ppromo;$data2 =  $ppkp1 + $ppdf1 + $ppromo1;$notif2 = $pkpselesai2 + $pdfselesai2 + $promoselesai2 ;$notif = $pkpselesai + $pdfselesai + $promoselesai;
        return view('manager.lihatpromo')->with([
            'promo' => $promo,
            'promoo' => $promoo,
            'app' => $app,
            'picture' => $picture,
            'idea' => $idea,
            'hitung' => $hitung,
            'promo1' => $promo1,
            'nopromo' => substr("T00".$nopromo,1,3),
            'user' => $user,
            'dept' => $dept,
            'ppkp' => $ppkp,'ppkp1' => $ppkp1,
            'ppromo' => $ppromo,'ppromo1' => $ppromo1,
            'ppdf' => $ppdf,'ppdf1' => $ppdf1,
            'notif' => $notif,'notif2' => $notif2,'data' => $data,'data2' => $data2,
            'pkpselesai' =>$pkpselesai,'pkpselesai2' => $pkpselesai2,
            'pdfselesai' => $pdfselesai,'pdfselesai2' => $pdfselesai2,
            'promoselesai' => $promoselesai,'promoselesai2' => $promoselesai2
        ]);
    }

    public function alihkan(Request $request,$id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->tujuankirim=$request->tujuankirim;
        $pkp->tujuankirim2=$request->tujuankirim2;
        $pkp->userpenerima2=null;
        $pkp->userpenerima=null;
        $pkp->pengajuan_sample='proses';
        $pkp->status_terima='proses';
        $pkp->status_project='sent';
        $pkp->status_terima2='proses';
        $pkp->save();

        return redirect::Route('listpkprka');
    }

    public function alihkanpdf(Request $request,$id_project_pdf){
        $pdf = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $pdf->tujuankirim=$request->tujuankirim;
        $pdf->tujuankirim2=$request->tujuankirim2;
        $pdf->userpenerima2=null;
        $pdf->userpenerima=null;
        $pdf->pengajuan_sample='proses';
        $pdf->status_terima='proses';
        $pdf->status_project='sent';
        $pdf->status_terima2='proses';
        $pdf->save();

        return redirect::Route('listpdfrka');
    }

    public function alihkanpromo(Request $request,$id_pkp_promo){
        $pkp = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pkp->tujuankirim=$request->tujuankirim;
        $pkp->userpenerima2=null;
        $pkp->userpenerima=null;
        $pkp->tujuankirim2=$request->tujuankirim2;
        $pkp->pengajuan_sample='proses';
        $pkp->status_terima='proses';
        $pkp->status_project='sent';
        $pkp->status_terima2='proses';
        $pkp->save();

        return redirect::Route('listpromoo');
    }
    
    public function Gproses(Request $request,$id_project,$revisi,$turunan){
        $pkp = tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $pkp->gambaran_proses=$request->proses;
        $pkp->save();

        return redirect::route('pkplihat',['id_pkp'=>$pkp->id_pkp, 'revisi' => $revisi, 'turunan' => $turunan]);
    }
}