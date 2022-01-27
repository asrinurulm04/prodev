<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\model\manager\pengajuan;
use App\model\master\Brand;
use App\model\pkp\FileProject;
use App\model\promo\Allocation;
use App\model\promo\PromoIdea;
use App\model\promo\promo;
use App\model\promo\DataPromo;
use App\model\users\User;
use App\model\users\Departement;
use Redirect;
use DB;
use Auth;

class PromoManagerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:manager' || 'rule:user_produk' );
    }
    
    public function listpromo(){
        $pkp        = Promo::where('status_project','!=','draf')->orderBy('prioritas','asc')->get();
        $brand      = Brand::all();
        $jumlahpkp  = DataPromo::where('status_promo','=','sent')->count();
        return view('manager.listpromo')->with([
            'pkp'         => $pkp,
            'jumlah'      => $jumlahpkp,
            'brand'       => $brand
        ]);
    }

    public function pengajuanpromo(Request $request){ // request revisi project PROMO dari manager RD ke pV
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
        $pkp->status_project = 'revisi';
        $pkp->save();

        return Redirect::Route('listpromoo');
    }

    public function daftarpromo($id_pkp_promo){
        $data     = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $dept     = Departement::all();
        $max      = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $max2     = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->max('revisi');
        $pkp      = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('status_promo','!=','draf')->where('turunan',$max)->where('revisi',$max2)->get();
        return view ('manager.daftarpromo')->with([
            'data'      => $data,
            'pkp'       => $pkp,
            'dept'      => $dept
        ]);
    }

    public function lihatpromo($id_pkp_promo,$revisi,$turunan){
        $promoo      = DataPromo::join('tr_project_promo','tr_promo.id_pkp_promoo','=','tr_project_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $hitung             = pengajuan::where([ ['id_promo',$id_pkp_promo], ['turunan',$turunan] ])->count();
        $max2        = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->max('revisi');
        $max         = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $promo1      = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$max2)->where('turunan',$max)->get();
        $promo       = Promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $idea        = PromoIdea::where('id_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $picture     = FileProject::where('promo',$id_pkp_promo)->get();
        $app         = Allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$max2)->where('turunan',$max)->get();
        $dept        = Departement::all();
        $user        = DB::table('tr_users')->where('departement_id',Auth::user()->departement->id)->get();
        return view('manager.lihatpromo')->with([
            'promo'        => $promo,
            'promoo'       => $promoo,
            'app'          => $app,
            'picture'      => $picture,
            'hitung'       => $hitung,
            'idea'         => $idea,
            'promo1'       => $promo1,
            'user'         => $user,
            'dept'         => $dept
        ]);
    }

    public function alihkanpromo(Request $request,$id_pkp_promo){ // mengalihkan project promo ke dept berbeda
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
    
    public function approve1(Request $request,$id_pkp_promo){ // approve project dari manager proses
        $pdf = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pdf->status_terima='terima';
        $pdf->save();

        return redirect::back();
    }

    public function approve2(Request $request,$id_pkp_promo){ // approve project dari manager kemas
        $pdf = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pdf->status_terima2='terima';
        $pdf->save();

        return redirect::back();
    }
}