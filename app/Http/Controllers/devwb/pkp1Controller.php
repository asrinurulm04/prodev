<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\pkp\pkp_project;
use App\pkp\project_pdf;
use Carbon\Carbon;
use App\pkp\menu;
use App\pkp\promo;
use App\manager\pengajuan;

use Auth;
use DB;
use Redirect;

class pkp1Controller extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:userproduk' || 'rule:user_produk'  || 'rule:kemas');
    }

    // PKP
    public function freeze($id_project){
        $data = pkp_project::where('id_project',$id_project)->first();
        $data->status_freeze='active';
        $data->freeze=Auth::user()->id;
        $data->waktu_freeze=Carbon::now();
        $data->save();

        return redirect::back();
    }

    public function ubahTMpkp(Request $request,$id_project){
        $data= pkp_project::where('id_project',$id_project)->first();
        $data->status_project='revisi';
        $data->save();

        $pengajuan= new pengajuan;
        $pengajuan->prioritas_pengajuan=1;
        $pengajuan->penerima='5';
        $pengajuan->id_pkp=$request->pkp;
        $pengajuan->alasan_pengajuan=$request->lamafreze;
        $pengajuan->save();

        return redirect::back();
    }

    public function active($id_project){
        $data= pkp_project::where('id_project',$id_project)->first();
        $data->status_freeze='inactive';
        $data->save();

        return redirect::back();
    }

    public function TMubah(Request $request,$id_project){
        $data= pkp_project::where('id_project',$id_project)->first();
        $data->status_project='sent';
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status_freeze='inactive';
        $data->freeze_diaktifkan=Carbon::now();
        $data->save();

        $pengajuan = pengajuan::where('id_pkp',$id_project)->first();
        $pengajuan->delete();

        return redirect::back();
    }

    // PDF
    public function freezepdf($id_project_pdf){
        $data= project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $data->status_freeze='active';
        $data->freeze=Auth::user()->id;
        $data->waktu_freeze=Carbon::now();
        $data->save();

        return redirect::back();
    }

    public function ubahTMpdf(Request $request,$id_project_pdf){
        $data= project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $data->status_project='revisi';
        $data->save();
        $pengajuan= new pengajuan;
        $pengajuan->prioritas_pengajuan=1;
        $pengajuan->penerima='14';
        $pengajuan->id_pdf=$request->pdf;
        $pengajuan->alasan_pengajuan=$request->lamafreze;
        $pengajuan->save();

        return redirect::back();
    }

    public function activepdf($id_project_pdf){
        $data= project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $data->status_freeze='inactive';
        $data->save();

        return redirect::back();
    }

    public function TMubahpdf(Request $request,$id_project_pdf){
        $data= project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $data->status_project='sent';
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status_freeze='inactive';
        $data->freeze_diaktifkan=Carbon::now();
        $data->save();

        $pengajuan = pengajuan::where('id_pdf',$id_project_pdf)->first();
        $pengajuan->delete();

        return redirect::back();
    }

    // Promo
    public function freezepromo($id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_freeze='active';
        $data->freeze=Auth::user()->id;
        $data->waktu_freeze=Carbon::now();
        $data->save();

        return redirect::back();
    }

    public function ubahTM(Request $request,$id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_project='revisi';
        $data->save();

        $pengajuan= new pengajuan;
        $pengajuan->prioritas_pengajuan=1;
        $pengajuan->penerima='5';
        $pengajuan->id_promo=$request->pkp;
        $pengajuan->alasan_pengajuan=$request->lamafreze;
        $pengajuan->save();

        return redirect::back();
    }

    public function activepromo($id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_freeze='inactive';
        $data->save();

        return redirect::back();
    }

    public function TMubahpromo(Request $request,$id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_project='sent';
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status_freeze='inactive';
        $data->freeze_diaktifkan=Carbon::now();
        $data->save();

        $pengajuan = pengajuan::where('id_promo',$id_pkp_promo)->first();
        $pengajuan->delete();

        return redirect::back();
    }
}
