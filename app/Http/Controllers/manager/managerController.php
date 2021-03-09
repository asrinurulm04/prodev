<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\model\manager\pengajuan;
use App\model\master\Brand;
use App\model\pkp\pkp_project;
use App\model\pkp\pkp_type;
use App\model\pkp\project_pdf;
use App\model\pkp\data_ses;
use App\model\dev\Formula;
use App\model\pkp\promo_idea;
use App\model\pkp\promo;
use App\model\pkp\kemaspdf;
use App\model\pkp\picture;
use App\model\pkp\tipp;
use App\model\pkp\data_detail_klaim;
use App\model\pkp\product_allocation;
use App\model\pkp\data_promo;
use App\model\pkp\data_klaim;
use App\model\pkp\coba;
use App\model\pkp\data_forecast;
use App\model\users\User;
use App\model\users\Departement;
use Redirect;
use DB;
use Charts;
use Auth;

class managerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:manager' || 'rule:user_produk' );
    }

    public function listpkp(){
        $hitungpkpselesai2 = pkp_project::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $hitungpkpselesai = pkp_project::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpdfselesai2= project_pdf::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpdfselesai= project_pdf::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpromoselesai2 = promo::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpromoselesai = promo::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungnotif2 = $hitungpkpselesai2 + $hitungpdfselesai2 + $hitungpromoselesai2 ;$hitungnotif = $hitungpkpselesai + $hitungpdfselesai + $hitungpromoselesai;
        $pkp = tipp::join('tr_project_pkp','tr_sub_pkp.id_pkp','=','tr_project_pkp.id_project')->where('status_data','active')->where('status_project','!=','draf')->orderBy('pkp_number','desc')->get();
        $pkpname = pkp_project::where('status_project','!=','draf')->get();
        $type = pkp_type::all();
        $brand = brand::all();
        return view('manager.listpkp')->with([
            'type' => $type,
            'brand' => $brand,
            'pkpname' => $pkpname,
            'pkp' => $pkp,
            'hitungnotif' => $hitungnotif,'hitungnotif2' => $hitungnotif2,
            'hitungpkpselesai' =>$hitungpkpselesai,'hitungpkpselesai2' => $hitungpkpselesai2,
            'hitungpdfselesai' => $hitungpdfselesai,'hitungpdfselesai2' => $hitungpdfselesai2,
            'hitungpromoselesai' => $hitungpromoselesai,'hitungpromoselesai2' => $hitungpromoselesai2
        ]);
    }

    public function listpdf(){
        $pdf = project_pdf::where('status_project','!=','draf')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->where('status_data','!=','draf')->orderBy('pdf_number','desc')->get();
        $type = pkp_type::all();
        $brand = brand::all();
        $hitungpkpselesai2 = pkp_project::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpkpselesai = pkp_project::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpdfselesai2= project_pdf::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpdfselesai= project_pdf::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpromoselesai2 = promo::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpromoselesai = promo::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungnotif2 = $hitungpkpselesai2 + $hitungpdfselesai2 + $hitungpromoselesai2 ;$hitungnotif = $hitungpkpselesai + $hitungpdfselesai + $hitungpromoselesai;
        return view('manager.listpdf')->with([
            'type' => $type,
            'pdf' => $pdf,
            'brand' => $brand,
            'hitungnotif' => $hitungnotif,'hitungnotif2' => $hitungnotif2,
            'hitungpkpselesai' =>$hitungpkpselesai,'hitungpkpselesai2' => $hitungpkpselesai2,
            'hitungpdfselesai' => $hitungpdfselesai,'hitungpdfselesai2' => $hitungpdfselesai2,
            'hitungpromoselesai' => $hitungpromoselesai,'hitungpromoselesai2' => $hitungpromoselesai2
        ]);
    }

    public function listpromo(){
        $pkp = promo::where('status_project','!=','draf')->orderBy('prioritas','asc')->get();
        $brand = brand::all();
        $jumlahpkp = data_promo::where('status_promo','=','sent')->count();
        $hitungpkpselesai2 = pkp_project::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpkpselesai = pkp_project::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpdfselesai2= project_pdf::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpdfselesai= project_pdf::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpromoselesai2 = promo::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpromoselesai = promo::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungnotif2 = $hitungpkpselesai2 + $hitungpdfselesai2 + $hitungpromoselesai2 ;$hitungnotif = $hitungpkpselesai + $hitungpdfselesai + $hitungpromoselesai;
        return view('manager.listpromo')->with([
            'pkp' => $pkp,
            'brand' => $brand,
            'jumlah' => $jumlahpkp,
            'hitungnotif' => $hitungnotif,'hitungnotif2' => $hitungnotif2,
            'hitungpkpselesai' =>$hitungpkpselesai,'hitungpkpselesai2' => $hitungpkpselesai2,
            'hitungpdfselesai' => $hitungpdfselesai,'hitungpdfselesai2' => $hitungpdfselesai2,
            'hitungpromoselesai' => $hitungpromoselesai,'hitungpromoselesai2' => $hitungpromoselesai2
        ]);
    }
    
    public function pengajuan(Request $request){
        $pengajuan = new pengajuan;
        $pengajuan->prioritas_pengajuan=$request->prioritas;
        $pengajuan->penerima='14';
        $pengajuan->id_pkp=$request->pkp;
        $pengajuan->alasan_pengajuan=$request->catatan;
        $pengajuan->jangka=$request->jangka;
        $pengajuan->waktu=$request->waktu;
        $pengajuan->revisi=$request->revisi;
        $pengajuan->turunan=$request->turunan;
        $pengajuan->save();

        $pkp = pkp_project::where('id_project',$request->pkp)->first();
        $pkp->status_project='revisi';
        $pkp->save();

        $turunan = tipp::where('id_pkp',$request->pkp)->max('turunan');
        $revisi =tipp::where('id_pkp',$request->pkp)->max('revisi');

        $isipkp = tipp::where('id_pkp',$request->pkp)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpkp', [
                'app'=>$isipkp,
                'info' => 'Manager RD mengajukan revisi pada project PKP',
                'jangka' => $request->jangka,
                'waktu' => $request->waktu,],function($message)use($request)
                {
                    $message->subject('Revision Request PROJECT PKP');
                    //sent email to PV
                    $user = DB::table('tr_users')->where('id',$request->kirim)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                    // CC Author
                    $user2 = DB::table('tr_users')->where('id',$request->kirimauthor)->get();
                    foreach($user2 as $user2){
                        $data2 = $user2->email;
                        $message->cc($data2);
                    }
                });
                return back()->with('status','E-mail Successfully');
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
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
        $pengajuan->revisi=$request->revisi;
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
        $pengajuan->penerima='14';
        $pengajuan->id_promo=$request->promo;
        $pengajuan->alasan_pengajuan=$request->catatan;
        $pengajuan->jangka=$request->jangka;
        $pengajuan->waktu=$request->waktu;
        $pengajuan->revisi=$request->revisi;
        $pengajuan->turunan=$request->turunan;
        $pengajuan->save();

        $pkp = promo::where('id_pkp_promo',$request->promo)->first();
        $pkp->status_project='revisi';
        $pkp->save();

        return Redirect::Route('listpromoo');
    }

    public function dasboardmanager(){
        $hitungpkpselesai2 = pkp_project::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpkpselesai = pkp_project::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpdfselesai2= project_pdf::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpdfselesai= project_pdf::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpromoselesai2 = promo::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpromoselesai = promo::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungnotif2 = $hitungpkpselesai2 + $hitungpdfselesai2 + $hitungpromoselesai2 ;$hitungnotif = $hitungpkpselesai + $hitungpdfselesai + $hitungpromoselesai;
        // chart PKP
        $revisi = pkp_project::where('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $proses = pkp_project::where('status_project','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $sent= pkp_project::where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $close = pkp_project::where('status_project','=','close')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pie  =	 Charts::create('bar', 'highcharts')->title('Data PKP')->elementlabel("Data PKP")->colors(['#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['sent', 'revisi', 'proses', 'close'])->values([$sent,$revisi,$proses,$close])->responsive(false);
        // chart PDF
        $revisipdf = project_pdf::where('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $prosespdf = project_pdf::where('status_project','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $sentpdf= project_pdf::where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $closepdf = project_pdf::where('status_project','=','close')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pie2  =	 Charts::create('pie', 'highcharts')->title('Data PDF')->elementlabel("Data PDF")->colors(['#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['sent', 'revisi', 'proses', 'close'])->values([$sentpdf,$revisipdf,$prosespdf,$closepdf])->responsive(false);
        // chart promo
        $revisipromo = promo::where('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $prosespromo = promo::where('status_project','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $sentpromo = promo::where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $closepromo = promo::where('status_project','=','close')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pie3  =	 Charts::create('area', 'highcharts')->title('Data PKP Promo')->elementlabel("Data PROMO")->labels(['sent', 'revisi', 'proses', 'close'])->values([$sentpromo,$revisipromo,$prosespromo,$closepromo])->responsive(false);
        // chart PKP
        $revisi2 = pkp_project::where('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $proses2 = pkp_project::where('status_project','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $sent2 = pkp_project::where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $close2 = pkp_project::where('status_project','=','close')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $chart1  =	 Charts::create('bar', 'highcharts')->title('Data PKP')->elementlabel("Data PKP")->colors(['#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['sent', 'revisi', 'proses', 'close'])->values([$sent2,$revisi2,$proses2,$close2])->responsive(false);
        // chart PDF
        $revisipdf2 = project_pdf::where('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $prosespdf2 = project_pdf::where('status_project','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $sentpdf2= project_pdf::where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $closepdf2 = project_pdf::where('status_project','=','close')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $chart2  =	 Charts::create('pie', 'highcharts')->title('Data PDF')->elementlabel("Data PDF")->colors(['#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['sent', 'revisi', 'proses', 'close'])->values([$sentpdf2,$revisipdf2,$prosespdf2,$closepdf2])->responsive(false);
        // chart promo
        $revisipromo2 = promo::where('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $prosespromo2 = promo::where('status_project','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $sentpromo2 = promo::where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $closepromo2 = promo::where('status_project','=','close')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $chart3  =	 Charts::create('area', 'highcharts')->title('Data PKP Promo')->elementlabel("Data PROMO")->labels(['sent', 'revisi', 'proses', 'close'])->values([$sentpromo2,$revisipromo2,$prosespromo2,$closepromo2])->responsive(false);
        return view('manager.dasboard')->with([
            'chart1' => $chart1,
            'chart2' => $chart2,
            'chart3' => $chart3,
            'pie' => $pie,'pie2' => $pie2,'pie3' => $pie3,
            'hitungnotif' => $hitungnotif,'hitungnotif2' => $hitungnotif2,
            'hitungpkpselesai' =>$hitungpkpselesai,'hitungpkpselesai2' => $hitungpkpselesai2,
            'hitungpdfselesai' => $hitungpdfselesai,'hitungpdfselesai2' => $hitungpdfselesai2,
            'hitungpromoselesai' => $hitungpromoselesai,'hitungpromoselesai2' => $hitungpromoselesai2
        ]);
    }

    public function daftarpkp($id_project){
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $max2 = tipp::where('id_pkp',$id_project)->max('revisi');
        $user = user::where('status','=','active')->get();
        $cf =Formula::where('workbook_id',$id_project)->count();
        $datapkp = tipp::where('id_pkp',$id_project)->where('status_pkp','sent')->where('turunan',$max)->where('turunan',$max)->where('revisi',$max2)->get();
        $sample = Formula::where('workbook_id', $id_project)->orderBy('versi','asc')->get();
        $listpkp = tipp::where('id_project',$id_project)->join('tr_project_pkp','tr_sub_pkp.id_pkp','=','tr_project_pkp.id_project')->where('status_data','=','active')->get();
        $dept = Departement::where('Divisi','=','RND')->get();
        $hitungpkpselesai2 = pkp_project::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpkpselesai = pkp_project::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpdfselesai2= project_pdf::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpdfselesai= project_pdf::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpromoselesai2 = promo::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpromoselesai = promo::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungnotif2 = $hitungpkpselesai2 + $hitungpdfselesai2 + $hitungpromoselesai2 ;$hitungnotif = $hitungpkpselesai + $hitungpdfselesai + $hitungpromoselesai;
        return view('manager.daftarpkp')->with([
            'pkp' => $pkp,
            'user' => $user,
            'cf' => $cf,
            'sample' => $sample,
            'dept' => $dept,
            'datapkp' => $datapkp,
            'listpkp' => $listpkp,
            'hitungnotif' => $hitungnotif,'hitungnotif2' => $hitungnotif2,
            'hitungpkpselesai' =>$hitungpkpselesai,'hitungpkpselesai2' => $hitungpkpselesai2,
            'hitungpdfselesai' => $hitungpdfselesai,'hitungpdfselesai2' => $hitungpdfselesai2,
            'hitungpromoselesai' => $hitungpromoselesai,'hitungpromoselesai2' => $hitungpromoselesai2
        ]);
    }

    public function daftarpdf($id_project_pdf){
        $data = Coba::where('pdf_id',$id_project_pdf)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('status_pdf','active')->get();
        $dept = Departement::all();
        $cf =Formula::where('workbook_pdf_id',$id_project_pdf)->count();
        $sample = Formula::where('workbook_pdf_id', $id_project_pdf)->orderBy('versi','asc')->orderBy('turunan','asc')->get();
        $max = coba::where('pdf_id',$id_project_pdf)->max('turunan');
        $max2 = coba::where('pdf_id',$id_project_pdf)->max('revisi');
        $pdf = project_pdf::where('id_project_pdf',$id_project_pdf)->join('tr_sub_pdf','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('revisi',$max2)->where('turunan',$max)->get();
        $hitungpkpselesai2 = pkp_project::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpkpselesai = pkp_project::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpdfselesai2= project_pdf::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpdfselesai= project_pdf::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpromoselesai2 = promo::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpromoselesai = promo::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungnotif2 = $hitungpkpselesai2 + $hitungpdfselesai2 + $hitungpromoselesai2 ;$hitungnotif = $hitungpkpselesai + $hitungpdfselesai + $hitungpromoselesai;
        return view('manager.daftarpdf')->with([
            'data' => $data,
            'dept' => $dept,
            'pdf' => $pdf,
            'cf' => $cf,
            'sample' => $sample,
            'hitungnotif' => $hitungnotif,'hitungnotif2' => $hitungnotif2,
            'hitungpkpselesai' =>$hitungpkpselesai,'hitungpkpselesai2' => $hitungpkpselesai2,
            'hitungpdfselesai' => $hitungpdfselesai,'hitungpdfselesai2' => $hitungpdfselesai2,
            'hitungpromoselesai' => $hitungpromoselesai,'hitungpromoselesai2' => $hitungpromoselesai2
        ]);
    }

    public function daftarpromo($id_pkp_promo){
        $data = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $dept = Departement::all();
        $max = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $max2 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('revisi');
        $pkp = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('status_promo','=','sent')->where('turunan',$max)->where('revisi',$max2)->get();
        $hitungpkpselesai2 = pkp_project::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpkpselesai = pkp_project::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpdfselesai2= project_pdf::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpdfselesai= project_pdf::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpromoselesai2 = promo::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpromoselesai = promo::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungnotif2 = $hitungpkpselesai2 + $hitungpdfselesai2 + $hitungpromoselesai2 ;$hitungnotif = $hitungpkpselesai + $hitungpdfselesai + $hitungpromoselesai;
        return view ('manager.daftarpromo')->with([
            'data' => $data,
            'pkp' => $pkp,
            'dept' => $dept,
            'hitungnotif' => $hitungnotif,'hitungnotif2' => $hitungnotif2,
            'hitungpkpselesai' =>$hitungpkpselesai,'hitungpkpselesai2' => $hitungpkpselesai2,
            'hitungpdfselesai' => $hitungpdfselesai,'hitungpdfselesai2' => $hitungpdfselesai2,
            'hitungpromoselesai' => $hitungpromoselesai,'hitungpromoselesai2' => $hitungpromoselesai2
        ]);
    }

    public function lihatpdf($id_project_pdf,$revisi,$turunan){
        $hitung = pengajuan::where([ ['id_pdf',$id_project_pdf],['revisi',$revisi], ['turunan',$turunan] ])->count();
        $ses = data_ses::where([ ['id_pdf',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $pdf1 = coba::where('pdf_id',$id_project_pdf)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('revisi','desc')->get();
        $pdf = coba::join('tr_pdf_project','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('id_project_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $id_pdf = coba::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $for = data_forecast::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->get();
        $hitungkemaspdf = kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->count();
        $kemaspdf = kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->get();
        $dept = Departement::all();
        $user = DB::table('tr_users') ->where('departement_id',Auth::user()->departement->id)->get();
        $picture = picture::where('pdf_id',$id_project_pdf)->get();
        $hitungpkpselesai2 = pkp_project::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpkpselesai = pkp_project::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpdfselesai2= project_pdf::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpdfselesai= project_pdf::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpromoselesai2 = promo::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpromoselesai = promo::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungnotif2 = $hitungpkpselesai2 + $hitungpdfselesai2 + $hitungpromoselesai2 ;$hitungnotif = $hitungpkpselesai + $hitungpdfselesai + $hitungpromoselesai;
        return view('manager.lihatpdf')->with([
            'pdf' => $pdf,
            'pdf1' => $pdf1,
            'dept' => $dept,
            'for' => $for,
            'kemaspdf' => $kemaspdf,
            'datases' => $ses,
            'user' => $user,
            'hitungkemaspdf' => $hitungkemaspdf,
            'hitung' => $hitung,
            'picture' => $picture,
            'hitungnotif' => $hitungnotif,'hitungnotif2' => $hitungnotif2,
            'hitungpkpselesai' =>$hitungpkpselesai,'hitungpkpselesai2' => $hitungpkpselesai2,
            'hitungpdfselesai' => $hitungpdfselesai,'hitungpdfselesai2' => $hitungpdfselesai2,
            'hitungpromoselesai' => $hitungpromoselesai,'hitungpromoselesai2' => $hitungpromoselesai2
        ]); 
    }

    public function lihatpkp($id_project,$revisi,$turunan){
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $id_pkp = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $for = data_forecast::where('id_pkp',$id_project)->where('turunan',$turunan)->get();
        $dataklaim = data_klaim::where('id_pkp',$id_project)->join('ms_klaim','ms_klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pkpp = tipp::join('tr_project_pkp','tr_sub_pkp.id_pkp','=','tr_project_pkp.id_project')->where([ ['id_project',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $ses= data_ses::where([ ['id_pkp',$id_project], ['turunan',$turunan] ])->get();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $pkp1 = tipp::where('id_pkp',$id_project)->where('revisi','<=',$revisi)->where('turunan',$max)->orderBy('revisi','desc')->get();
        $pengajuan = pengajuan::where('id_pkp',$id_project)->where('turunan',$turunan)->count();
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('turunan',$turunan)->get();
        $user = DB::table('tr_users')->where('departement_id',Auth::user()->departement->id)->get();
        $user2 = DB::table('tr_users')->where('departement_id','!=',Auth::user()->departement->id)->join('ms_departements','ms_departements.id','=','tr_users.departement_id')->orwhere('dept','==','RPP')->orwhere('dept','==','RPN')->orwhere('dept','==','RPE')->get();
        $picture = picture::where('pkp_id',$id_project)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        $hitungpkpselesai2 = pkp_project::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpkpselesai = pkp_project::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpdfselesai2= project_pdf::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpdfselesai= project_pdf::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpromoselesai2 = promo::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpromoselesai = promo::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungnotif2 = $hitungpkpselesai2 + $hitungpdfselesai2 + $hitungpromoselesai2 ;$hitungnotif = $hitungpkpselesai + $hitungpdfselesai + $hitungpromoselesai;
        return view('manager.lihatpkp')->with([
            'pkpp' => $pkpp,
            'pengajuan' => $pengajuan,
            'pkp' => $pkp,
            'datases' => $ses,
            'for' => $for,
            'datadetail' => $datadetail,
            'dataklaim' => $dataklaim,
            'pkp1' => $pkp1,
            'user' => $user,
            'user2' => $user2,
            'picture' => $picture,
            'hitungnotif' => $hitungnotif,'hitungnotif2' => $hitungnotif2,
            'hitungpkpselesai' =>$hitungpkpselesai,'hitungpkpselesai2' => $hitungpkpselesai2,
            'hitungpdfselesai' => $hitungpdfselesai,'hitungpdfselesai2' => $hitungpdfselesai2,
            'hitungpromoselesai' => $hitungpromoselesai,'hitungpromoselesai2' => $hitungpromoselesai2
        ]); 
    }

    public function lihatpromo($id_pkp_promo,$revisi,$turunan){
        $promoo = data_promo::join('tr_project_promo','tr_promo.id_pkp_promoo','=','tr_project_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $hitung = pengajuan::where([ ['id_promo',$id_pkp_promo], ['turunan',$turunan] ])->count();
        $max2 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('revisi');
        $max = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $promo1 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$max2)->where('turunan',$max)->get();
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $idea = promo_idea::where('id_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $picture = picture::where('promo',$id_pkp_promo)->get();
        $app = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$max2)->where('turunan',$max)->get();
        $dept = Departement::all();
        $user = DB::table('tr_users')->where('departement_id',Auth::user()->departement->id)->get();
        $hitungpkpselesai2 = pkp_project::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpkpselesai = pkp_project::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpdfselesai2= project_pdf::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpdfselesai= project_pdf::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpromoselesai2 = promo::where('status_terima2','=','proses')->where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();$hitungpromoselesai = promo::where('status_terima','=','proses')->where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungnotif2 = $hitungpkpselesai2 + $hitungpdfselesai2 + $hitungpromoselesai2 ;$hitungnotif = $hitungpkpselesai + $hitungpdfselesai + $hitungpromoselesai;
        return view('manager.lihatpromo')->with([
            'promo' => $promo,
            'promoo' => $promoo,
            'app' => $app,
            'picture' => $picture,
            'idea' => $idea,
            'hitung' => $hitung,
            'promo1' => $promo1,
            'user' => $user,
            'dept' => $dept,
            'hitungnotif' => $hitungnotif,'hitungnotif2' => $hitungnotif2,
            'hitungpkpselesai' =>$hitungpkpselesai,'hitungpkpselesai2' => $hitungpkpselesai2,
            'hitungpdfselesai' => $hitungpdfselesai,'hitungpdfselesai2' => $hitungpdfselesai2,
            'hitungpromoselesai' => $hitungpromoselesai,'hitungpromoselesai2' => $hitungpromoselesai2
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

    public function approve1(Request $request,$id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->status_terima='terima';
        $pkp->save();
        return redirect::back();
    }

    public function approve2(Request $request,$id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->status_terima2='terima';
        $pkp->save();
        return redirect::back();
    }
}