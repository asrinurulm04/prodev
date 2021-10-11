<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\model\manager\pengajuan;
use App\model\master\Brand;
use App\model\formula\Formula;
use App\model\pkp\PkpProject;
use App\model\pkp\DataSES;
use App\model\pkp\FileProject;
use App\model\pkp\DetailKlaim;
use App\model\pkp\Allocation;
use App\model\pkp\DataKlaim;
use App\model\pkp\Forecast;
use App\model\pdf\SubPDF;
use App\model\pdf\kemaspdf;
use App\model\pdf\ProjectPDF;
use App\model\promo\PromoIdea;
use App\model\promo\promo;
use App\model\promo\DataPromo;
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
        $pkp                 = PkpProject::where('status_project','active')->where('status_pkp','!=','draf')->where('status_pkp','!=','drop')->orderBy('pkp_number','desc')->get();
        $brand               = Brand::all();
        return view('manager.listpkp')->with([
            'brand'               => $brand,
            'pkp'                 => $pkp
        ]);
    }

    public function listpdf(){
        $pdf                = ProjectPDF::where('status_project','!=','draf')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->where('status_data','!=','draf')->orderBy('pdf_number','desc')->get();
        $brand              = Brand::all();
        return view('manager.listpdf')->with([
            'pdf'                 => $pdf,
            'brand'               => $brand
        ]);
    }

    public function listpromo(){
        $pkp                = Promo::where('status_project','!=','draf')->orderBy('prioritas','asc')->get();
        $brand              = Brand::all();
        $jumlahpkp          = DataPromo::where('status_promo','=','sent')->count();
        return view('manager.listpromo')->with([
            'pkp'                 => $pkp,
            'jumlah'              => $jumlahpkp,
            'brand'               => $brand
        ]);
    }
    
    public function pengajuan(Request $request){    
        $pkp = PkpProject::where('id_project',$request->pkp)->first();
        $pkp->updata=$request->pkp;
        $pkp->save();
        
        $pengajuan = new pengajuan;
        $pengajuan->prioritas_pengajuan = $request->prioritas;
        $pengajuan->penerima            = '14';
        $pengajuan->pkp_id              = $request->pkp;
        $pengajuan->alasan_pengajuan    = $request->catatan;
        $pengajuan->jangka              = $request->jangka;
        $pengajuan->waktu               = $request->waktu;
        $pengajuan->revisi              = $request->revisi;
        $pengajuan->turunan             = $request->turunan;
        $pengajuan->revisi_kemas        = $request->revisi_kemas;
        $pengajuan->save();

        $isipkp = PkpProject::where('id_project',$request->pkp)->get();
        $for    = Forecast::where('id_pkp',$pkp->id_pkp)->where('revisi','=',$request->revisi)->where('turunan','=',$request->turunan)->where('revisi_kemas',$request->revisi_kemas)->get();
        try{
            Mail::send('email.infoemailpkp', [
                'app'   => $isipkp,
                'for'   => $for,
                'info'  => 'Manager RD mengajukan revisi pada project PKP',
                'jangka'=> $request->jangka,
                'waktu' => $request->waktu,],function($message)use($request){
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
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return Redirect::Route('listpkprka')->with('status','E-mail Successfully');
    }

    public function pengajuanpdf(Request $request){
        $pengajuan = new pengajuan;
        $pengajuan->prioritas_pengajuan = $request->prioritas;
        $pengajuan->penerima            = $request->penerima;
        $pengajuan->id_pdf              = $request->pdf;
        $pengajuan->alasan_pengajuan    = $request->catatan;
        $pengajuan->jangka              = $request->jangka;
        $pengajuan->waktu               = $request->waktu;
        $pengajuan->revisi              = $request->revisi;
        $pengajuan->turunan             = $request->turunan;
        $pengajuan->save();

        $pdf = ProjectPDF::where('id_project_pdf',$request->pdf)->first();
        $pdf->status_project='revisi';
        $pdf->save();

        $turunan = SubPDF::where('pdf_id',$request->pdf)->max('turunan');
        $revisi  = SubPDF::where('pdf_id',$request->pdf)->max('revisi');

        $isipdf  = SubPDF::where('pdf_id',$request->pdf)->where('status_pdf','=','active')->get();
        try{
            Mail::send('email.infoemailpdf', [
                'app'   =>$isipdf,
                'info'  => 'Manager RD mengajukan revisi pada project PDF berikut',
                'jangka'=> $request->jangka,
                'waktu' => $request->waktu,],function($message)use($request){
                    $message->subject('Revision Request PROJECT PDF');
                    //sent email to PV
                    $user = DB::table('tr_users')->where('id',$request->perevisi)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                });
                return back()->with('status','E-mail Successfully');
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return Redirect::Route('listpdfrka');
    }

    public function pengajuanpromo(Request $request){
        $pengajuan = new pengajuan;
        $pengajuan->prioritas_pengajuan = $request->prioritas;
        $pengajuan->penerima            = '14';
        $pengajuan->id_promo            = $request->promo;
        $pengajuan->alasan_pengajuan    = $request->catatan;
        $pengajuan->jangka              = $request->jangka;
        $pengajuan->waktu               = $request->waktu;
        $pengajuan->revisi              = $request->revisi;
        $pengajuan->turunan             = $request->turunan;
        $pengajuan->save();

        $pkp = promo::where('id_pkp_promo',$request->promo)->first();
        $pkp->status_project='revisi';
        $pkp->save();

        return Redirect::Route('listpromoo');
    }

    public function daftarpkp($id_project){
        $user               = user::where('status','=','active')->get();
        $cf                 = Formula::where('workbook_id',$id_project)->count();
        $listpkp            = PkpProject::where('id_project',$id_project)->get();
        $pkp                = PkpProject::where('id_project',$id_project)->first();
        $sample             = Formula::where('workbook_id', $pkp->id_pkp)->orderBy('versi','asc')->get();
        $dept               = Departement::where('Divisi','=','RND')->get();
        return view('manager.daftarpkp')->with([
            'user'                => $user,
            'cf'                  => $cf,
            'pkp'                 => $pkp,
            'sample'              => $sample,
            'dept'                => $dept,
            'listpkp'             => $listpkp
        ]);
    }

    public function daftarpdf($id_project_pdf){
        $data               = SubPDF::where('pdf_id',$id_project_pdf)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('status_pdf','active')->get();
        $dept               = Departement::all();
        $cf                 = Formula::where('workbook_pdf_id',$id_project_pdf)->count();
        $sample             = Formula::where('workbook_pdf_id', $id_project_pdf)->orderBy('versi','asc')->orderBy('turunan','asc')->get();
        $max                = SubPDF::where('pdf_id',$id_project_pdf)->max('turunan');
        $id                 = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $max2               = SubPDF::where('pdf_id',$id_project_pdf)->max('revisi');
        $pdf                = ProjectPDF::where('id_project_pdf',$id_project_pdf)->join('tr_sub_pdf','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('revisi',$max2)->where('turunan',$max)->get();
        return view('manager.daftarpdf')->with([
            'data'                => $data,
            'dept'                => $dept,
            'pdf'                 => $pdf,
            'cf'                  => $cf,
            'id'                  => $id,
            'sample'              => $sample
        ]);
    }

    public function daftarpromo($id_pkp_promo){
        $data               = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $dept               = Departement::all();
        $max                = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $max2               = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->max('revisi');
        $pkp                = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('status_promo','!=','draf')->where('turunan',$max)->where('revisi',$max2)->get();
        return view ('manager.daftarpromo')->with([
            'data'                => $data,
            'pkp'                 => $pkp,
            'dept'                => $dept
        ]);
    }

    public function lihatpdf($id_project_pdf,$revisi,$turunan){
        $ses                = DataSES::where([ ['id_pdf',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $pdf1               = SubPDF::where('pdf_id',$id_project_pdf)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('revisi','desc')->get();
        $pdf                = SubPDF::join('tr_pdf_project','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('id_project_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $id_pdf             = SubPDF::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $for                = Forecast::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->get();
        $kemaspdf           = kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->get();
        $dept               = Departement::all();
        $user               = DB::table('tr_users') ->where('departement_id',Auth::user()->departement->id)->get();
        $picture            = FileProject::where('pdf_id',$id_project_pdf)->get();
        return view('manager.lihatpdf')->with([
            'pdf'                 => $pdf,
            'pdf1'                => $pdf1,
            'dept'                => $dept,
            'for'                 => $for,
            'kemaspdf'            => $kemaspdf,
            'datases'             => $ses,
            'user'                => $user,
            'picture'             => $picture
        ]); 
    }

    public function lihatpkp($id_project){
        $pkp                = PkpProject::where('id_project',$id_project)->first();
        $pkp1               = PkpProject::where([['id_pkp',$pkp->id_pkp],['revisi','<=',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas','<=',$pkp->revisi_kemas]])->orderBy('revisi','desc')->get();
        $for                = Forecast::where([['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->get();
        $dataklaim          = DataKlaim::where('id_pkp',$pkp->id_pkp)->join('ms_klaim','ms_klaim.id','=','id_klaim')->where('revisi',$pkp->revisi)->where('turunan',$pkp->turunan)->get();
        $datadetail         = DetailKlaim::where([['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->get();
        $ses                = DataSES::where([['id_pkp',$pkp->id_pkp],['revisi','<=',$pkp->revisi],['turunan','<=',$pkp->turunan],['revisi_kemas','<=',$pkp->revisi_kemas]])->get();
        $pengajuan          = pengajuan::where('pkp_id',$id_project)->count();
        $user               = DB::table('tr_users')->where('departement_id',Auth::user()->departement->id)->get();
        $user2              = DB::table('tr_users')->where('departement_id','!=',Auth::user()->departement->id)->get();
        $picture            = FileProject::where([['pkp_id',$pkp->id_pkp],['revisi','<=',$pkp->revisi],['turunan','<=',$pkp->turunan],['revisi_kemas','<=',$pkp->revisi_kemas]])->get();
        return view('manager.lihatpkp')->with([
            'pengajuan'           => $pengajuan,
            'pkp'                 => $pkp,
            'datases'             => $ses,
            'for'                 => $for,
            'datadetail'          => $datadetail,
            'dataklaim'           => $dataklaim,
            'pkp1'                => $pkp1,
            'user'                => $user,
            'user2'               => $user2,
            'picture'             => $picture
        ]);
    }

    public function lihatpromo($id_pkp_promo,$revisi,$turunan){
        $promoo             = DataPromo::join('tr_project_promo','tr_promo.id_pkp_promoo','=','tr_project_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $max2               = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->max('revisi');
        $max                = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $promo1             = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$max2)->where('turunan',$max)->get();
        $promo              = Promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $idea               = PromoIdea::where('id_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $picture            = FileProject::where('promo',$id_pkp_promo)->get();
        $app                = Allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$max2)->where('turunan',$max)->get();
        $dept               = Departement::all();
        $user               = DB::table('tr_users')->where('departement_id',Auth::user()->departement->id)->get();
        return view('manager.lihatpromo')->with([
            'promo'               => $promo,
            'promoo'              => $promoo,
            'app'                 => $app,
            'picture'             => $picture,
            'idea'                => $idea,
            'promo1'              => $promo1,
            'user'                => $user,
            'dept'                => $dept
        ]);
    }

    public function alihkan(Request $request,$id_project){
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $pkp->tujuankirim       = $request->tujuankirim;
        $pkp->tujuankirim2      = $request->tujuankirim2;
        $pkp->userpenerima2     = null;
        $pkp->userpenerima      = null;
        $pkp->pengajuan_sample  = 'proses';
        $pkp->status_terima     = 'proses';
        $pkp->status_pkp        = 'sent';
        $pkp->status_terima2    = 'proses';
        $pkp->save();

        return redirect::Route('listpkprka');
    }

    public function alihkanpdf(Request $request,$id_project_pdf){
        $pdf = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $pdf->tujuankirim       = $request->tujuankirim;
        $pdf->tujuankirim2      = $request->tujuankirim2;
        $pdf->userpenerima2     = null;
        $pdf->userpenerima      = null;
        $pdf->pengajuan_sample  = 'proses';
        $pdf->status_terima     = 'proses';
        $pdf->status_project    = 'sent';
        $pdf->status_terima2    = 'proses';
        $pdf->save();

        return redirect::Route('listpdfrka');
    }

    public function alihkanpromo(Request $request,$id_pkp_promo){
        $pkp = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pkp->tujuankirim       = $request->tujuankirim;
        $pkp->userpenerima2     = null;
        $pkp->userpenerima      = null;
        $pkp->tujuankirim2      = $request->tujuankirim2;
        $pkp->pengajuan_sample  = 'proses';
        $pkp->status_terima     = 'proses';
        $pkp->status_project    = 'sent';
        $pkp->status_terima2    = 'proses';
        $pkp->save();

        return redirect::Route('listpromoo');
    }

    public function approve1(Request $request,$id_project){
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $pkp->status_terima='terima';
        $pkp->save();
        return redirect::back();
    }

    public function approve2(Request $request,$id_project){
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $pkp->status_terima2='terima';
        $pkp->save();
        return redirect::back();
    }
}