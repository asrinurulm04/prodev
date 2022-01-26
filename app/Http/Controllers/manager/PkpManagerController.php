<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\model\manager\pengajuan;
use App\model\master\Brand;
use App\model\formula\Formula;
use App\model\pkp\PkpProject;
use App\model\pkp\DataSES;
use App\model\pkp\FileProject;
use App\model\pkp\DetailKlaim;
use App\model\pkp\DataKlaim;
use App\model\pkp\Forecast;
use App\model\users\User;
use App\model\users\Departement;

use Redirect;
use DB;
use Auth;

class PkpManagerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:manager' || 'rule:user_produk' );
    }

    public function listpkp(){
        $pkp      = PkpProject::where('status_project','active')->where('status_pkp','!=','draf')->where('status_pkp','!=','drop')->where('status_freeze','inactive')->orderBy('pkp_number','desc')->get();
        $brand    = Brand::all();
        return view('manager.listpkp')->with([
            'brand'   => $brand,
            'pkp'     => $pkp
        ]);
    }
    
    public function pengajuan(Request $request){    // request revisi project PKP dari manager RD ke pV
        $pkp = PkpProject::where('id_project',$request->pkp)->first();
        $pkp->updata = $request->pkp;
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
        try{ //sent email to PV
            Mail::send('email.infoemailpkp', [
                'app'   => $isipkp,
                'for'   => $for,
                'info'  => 'Manager RD mengajukan revisi pada project PKP',
                'jangka'=> $request->jangka,
                'waktu' => $request->waktu,],function($message)use($request){
                    $message->subject('Revision Request PROJECT PKP');
                    $user = DB::table('tr_users')->where('id',$request->kirim)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                    $user2 = DB::table('tr_users')->where('id',$request->kirimauthor)->get(); // CC Author project
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
    
    public function daftarpkp($id_project){
        $user         = user::where('status','=','active')->get();
        $cf           = Formula::where('workbook_id',$id_project)->count();
        $listpkp      = PkpProject::where('id_project',$id_project)->get();
        $pkp          = PkpProject::where('id_project',$id_project)->first();
        $sample       = Formula::where('workbook_id', $pkp->id_pkp)->orderBy('versi','asc')->get();
        $dept         = Departement::where('Divisi','=','RND')->get();
        return view('manager.daftarpkp')->with([
            'user'    => $user,
            'cf'      => $cf,
            'pkp'     => $pkp,
            'sample'  => $sample,
            'dept'    => $dept,
            'listpkp' => $listpkp
        ]);
    }
    
    public function lihatpkp($id_project){ // halaman detail project PKP
        $pkp            = PkpProject::where('id_project',$id_project)->first();
        $pkp1           = PkpProject::where([['id_pkp',$pkp->id_pkp],['revisi','<=',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas','<=',$pkp->revisi_kemas]])->orderBy('revisi','desc')->get();
        $for            = Forecast::where([['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->get();
        $dataklaim      = DataKlaim::where('id_pkp',$pkp->id_pkp)->join('ms_klaim','ms_klaim.id','=','id_klaim')->where('revisi',$pkp->revisi)->where('turunan',$pkp->turunan)->get();
        $datadetail     = DetailKlaim::where([['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->get();
        $ses            = DataSES::where([['id_pkp',$pkp->id_pkp],['revisi','<=',$pkp->revisi],['turunan','<=',$pkp->turunan],['revisi_kemas','<=',$pkp->revisi_kemas]])->get();
        $pengajuan      = pengajuan::where('pkp_id',$id_project)->count();
        $user           = DB::table('tr_users')->where('departement_id',Auth::user()->departement->id)->get();
        $user2          = DB::table('tr_users')->where('departement_id','!=',Auth::user()->departement->id)->get();
        $picture        = FileProject::where([['pkp_id',$pkp->id_pkp],['revisi','<=',$pkp->revisi],['turunan','<=',$pkp->turunan],['revisi_kemas','<=',$pkp->revisi_kemas]])->get();
        return view('manager.lihatpkp')->with([
            'pengajuan'       => $pengajuan,
            'pkp'             => $pkp,
            'datases'         => $ses,
            'for'             => $for,
            'datadetail'      => $datadetail,
            'dataklaim'       => $dataklaim,
            'pkp1'            => $pkp1,
            'user'            => $user,
            'user2'           => $user2,
            'picture'         => $picture
        ]);
    }
    
    public function alihkan(Request $request,$id_project){ // mnengalihkan project PKP ke manager dept berbeda
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

    public function approve1(Request $request,$id_project){ // approve project dari manager proses
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $pkp->status_terima = 'terima';
        $pkp->save();
        return redirect::back();
    }

    public function approve2(Request $request,$id_project){ // approve project dari manager Kemas
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $pkp->status_terima2 = 'terima';
        $pkp->save();
        return redirect::back();
    }
}