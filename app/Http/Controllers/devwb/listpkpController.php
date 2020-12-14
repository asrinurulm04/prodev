<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\pkp_type;
use App\model\pkp\pkp_project;
use App\model\pkp\project_pdf;
use App\model\pkp\data_forecast;
use App\model\pkp\klaim;
use App\model\pkp\kemaspdf;
use App\model\pkp\detail_klaim;
use App\model\pkp\komponen;
use App\model\pkp\data_klaim;
use App\model\pkp\data_detail_klaim;
use App\model\pkp\data_ses;
use App\model\pkp\promo;
use App\model\pkp\data_promo;
use App\model\pkp\coba;
use App\model\pkp\tipp;
use App\model\pkp\picture;
use App\model\master\Brand;
use App\model\kemas\datakemas;
use App\model\manager\pengajuan;

use Auth;
use DB;
use Redirect;

class listpkpController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:marketing' || 'rule:user_produk'  || 'rule:kemas');
    }

    public function dasboard(){
        $pkp = pkp_project::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $pkp1 = pkp_project::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapkp = $pkp + $pkp1;
        $pdf = project_pdf::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $pdf1 = project_pdf::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapdf = $pdf + $pdf1;
        $promo = promo::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $promo1 = promo::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapromo = $promo + $promo1;
        return view('devwb.dasboard')->with([
            'pkp' => $datapkp,
            'pdf' => $datapdf,
            'promo' => $datapromo
        ]);
    }

    public function listpkp(){
        $pkp = pkp_project::where('status_project','!=','draf')->where('status_project','!=','sent')->orderBy('pkp_number','desc')->get();
        $type = pkp_type::all();
        $brand = brand::all();
        $hitungpkp = tipp::where('status_pkp','=','draf')->count();
        $hitungpromo = data_promo::where('status_promo','=','draf')->count();
        $hitungpdf = coba::where('status_data','=','draf')->count();
        $jumlah = $hitungpkp+$hitungpromo+$hitungpdf;
        
        return view('devwb.listprojectpkp')->with([
            'type' => $type,
            'brand' => $brand,
            'pkp' => $pkp,
            'hitungpkp' => $hitungpkp,
            'hitungpromo' => $hitungpromo,
            'hitungpdf' => $hitungpdf,
            'jumlah' => $jumlah
        ]);
    }

    public function listpdf(){
        $pdf = project_pdf::all();
        $type = pkp_type::all();
        $brand = brand::all();
        $hitungpkp = tipp::where('status_pkp','=','draf')->count();
        $hitungpromo = data_promo::where('status_promo','=','draf')->count();
        $hitungpdf = coba::where('status_data','=','draf')->count();
        $jumlah = $hitungpkp+$hitungpromo+$hitungpdf;
        
        return view('devwb.listpdfproject')->with([
            'type' => $type,
            'pdf' => $pdf,
            'brand' => $brand,
            'hitungpkp' => $hitungpkp,
            'hitungpromo' => $hitungpromo,
            'hitungpdf' => $hitungpdf,
            'jumlah' => $jumlah
        ]);
    }

    public function listpromo(){
        $promo = promo::all();
        $brand = brand::all();
        
        return view('devwb.listprojectpromo')->with([
            'promo' => $promo,
            'brand' => $brand
        ]);
    }

    public function kemas(){
        return view('datamaster.datakemas');
    }

    public function closepkp(Request $request,$id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->status_project='close';
        $pkp->catatan=$request->note;
        $pkp->save();

        return Redirect::back();
    }

    public function closepdf(Request $request,$id_project_pdf){
        $pdf = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $pdf->status_project='close';
        $pdf->catatan=$request->note;
        $pdf->save();

        return Redirect::back();
    }

    public function closepromo(Request $request,$id_pkp_promo){
        $pkp = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pkp->status_project='close';
        $pkp->catatan=$request->note;
        $pkp->save();

        return Redirect::back();
    }

    public function allproject(){
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::orderBy('updated_at','desc')->get();
        $pic = picture::all();
        $pkp = tipp::max('turunan');
        $pdf = coba::max('turunan');
        $promo = data_promo::max('turunan');
        $hitungnotif = $pengajuan + $notif;
        $datapkp = pkp_project::where('status_project','!=','draf') ->join('tippu','pkp_project.id_project','=','tippu.id_pkp')->where('status_data','=','active')->get();
        $datapdf = project_pdf::where('status_project','!=','draf') ->join('tipu','pdf_project.id_project_pdf','=','tipu.pdf_id')->where('status_pdf','=','active')->get();
        $datapromo = promo::where('status_project','!=','draf') ->join('isi_promo','pkp_promo.id_pkp_promo','=','isi_promo.id_pkp_promoo')->where('status_data','=','active')->get();
        return view('produk.allproject')->with([
            'datapkp' => $datapkp,
            'datapdf' => $datapdf,
            'pic' => $pic,
            'datapromo' => $datapromo,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function template(Request $request,$id_project_pdf){
        $pdf = coba::where('pdf_id',$id_project_pdf)->max('turunan');
        $max = coba::where('pdf_id',$id_project_pdf)->max('revisi');
        $pdf1= project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $project = new project_pdf;
        $project->project_name=$pdf1->project_name;
        $project->reference=$pdf1->reference;
        $project->id_brand=$pdf1->id_brand;
        $project->id_type=$pdf1->id_type;
        $project->jenis=$pdf1->jenis;
        $project->product_type=$pdf1->product_type;
        $project->country=$pdf1->country;
        $project->author=Auth::user()->id;
        $project->save();

            $clf=coba::where('pdf_id',$id_project_pdf)->count();
            if($clf>0){
                $isipdf=coba::where('pdf_id',$id_project_pdf)->where('revisi',$max)->where('turunan',$pdf)->get();
                foreach ($isipdf as $ipdf)
                {
                $tip= new coba;
                $tip->pdf_id=$project->id_project_pdf;
                $tip->primer=$ipdf->primer;
                $tip->primery=$ipdf->primery;
                $tip->secondery=$ipdf->secondery;
                $tip->Tertiary=$ipdf->Tertiary;
                $tip->kemas_eksis=$ipdf->kemas_eksis;
                $tip->dariusia=$ipdf->dariusia;
                $tip->sampaiusia=$ipdf->sampaiusia;
                $tip->gender=$ipdf->gender;
                $tip->other=$ipdf->other;
                $tip->wight=$ipdf->wight;
                $tip->serving=$ipdf->serving;
                $tip->target_price=$ipdf->target_price;
                $tip->claim=$ipdf->claim;
                $tip->ingredient=$ipdf->ingredient;
                $tip->background=$ipdf->background;
                $tip->attractiveness=$ipdf->attractiveness;
                $tip->rto=$ipdf->rto;
                $tip->name=$ipdf->name;
                $tip->retailer_price=$ipdf->retailer_price;
                $tip->special=$ipdf->special;
                $tip->revisi='0';
                $tip->turunan='0';
                $tip->status_data='draf';
                $tip->save();
                }
            }

            $datases=data_ses::where('id_pdf',$id_project_pdf)->where('revisi',$max)->where('turunan',$pdf)->count();
            if($datases>0){
                $isises=data_ses::where('id_pdf',$id_project_pdf)->where('revisi',$max)->where('turunan',$pdf)->get();
                foreach ($isises as $isises)
                {
                    $data1= new data_ses;
                    $data1->id_pdf=$project->id_project_pdf;
                    $data1->revisi='0';
                    $data1->turunan='0';
                    $data1->ses=$isises->ses;
                    $data1->save();
                }
            }

            $datafor=data_forecast::where('id_pdf',$id_project_pdf)->where('revisi',$max)->where('turunan',$pdf)->count();
            if($datafor>0){
                $isifor=data_forecast::where('id_pdf',$id_project_pdf)->where('revisi',$max)->where('turunan',$pdf)->get();
                foreach ($isifor as $isifor)
                {
                    $for= new data_forecast;
                    $for->id_pdf=$project->id_project_pdf;
                    $for->revisi='0';
                    $for->turunan='0';
                    $for->forecast=$isifor->forecast;
                    $for->satuan=$isifor->satuan;
                    $for->keterangan=$isifor->keterangan;
                    $for->save();
                }
            }

            $dataklaim=data_klaim::where('id_pdf',$id_project_pdf)->where('revisi',$max)->where('turunan',$pdf)->count();
            if($dataklaim>0){
                $isiklaim=data_klaim::where('id_pdf',$id_project_pdf)->where('revisi',$max)->where('turunan',$pdf)->get();
                foreach ($isiklaim as $isiklaim)
                {
                    $klaim= new data_klaim;
                    $klaim->id_pdf=$project->id_project_pdf;
                    $klaim->revisi='0';
                    $klaim->turunan='0';
                    $klaim->id_komponen=$isiklaim->id_komponen;
                    $klaim->id_klaim=$isiklaim->id_klaim;
                    $klaim->note=$isiklaim->note;
                    $klaim->save();
                }
            }
            $detailklaim=data_detail_klaim::where('id_pdf',$id_project_pdf)->where('revisi',$max)->where('turunan',$pdf)->count();
            if($detailklaim>0){
                $isidetail=data_detail_klaim::where('id_pdf',$id_project_pdf)->where('revisi',$max)->where('turunan',$pdf)->get();
                foreach ($isidetail as $isidetail)
                {
                    $detail= new data_detail_klaim;
                    $detail->id_pdf=$project->id_project_pdf;
                    $detail->revisi='0';
                    $detail->turunan='0';
                    $detail->id_detail=$isidetail->id_detail;
                    $detail->save();
                }
            }

            $detailkemaspdf=kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi',$max)->where('turunan',$pdf)->count();
            if($detailkemaspdf>0){
                $isikemaspdf=kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi',$max)->where('turunan',$pdf)->get();
                foreach ($isikemaspdf as $isikemaspdf)
                {
                    $detail= new kemaspdf;
                    $detail->id_pdf=$project->id_project_pdf;
                    $detail->revisi='0';
                    $detail->turunan='0';
                    $detail->oracle=$isikemaspdf->oracle;
                    $detail->kk=$isikemaspdf->kk;
                    $detail->information=$isikemaspdf->information;
                    $detail->save();
                }
            }

            return redirect::route('buatpdf1',['pdf_id' => $tip->pdf_id, 'revisi' => $tip->revisi, 'turunan' => $tip->turunan]);
    }
}