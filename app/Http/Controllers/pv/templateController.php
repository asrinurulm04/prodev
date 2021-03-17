<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
use App\model\pkp\coba;
use App\model\pkp\tipp;
use App\model\pkp\uom;
use App\model\pkp\picture;
use Auth;
use DB;
use Redirect;
use Carbon\Carbon;

class templateController extends Controller
{
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
                $tip->perevisi=Auth::user()->id;
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

    public function templatepkp($id_project){
        $current = Carbon::now();
        $pkp = tipp::where('id_pkp',$id_project)->max('turunan');
        $max = tipp::where('id_pkp',$id_project)->max('revisi');
        $pkp1 = pkp_project::where('id_project',$id_project)->first();
        $project = new pkp_project;
        $project->project_name=$pkp1->project_name;
        $project->id_brand=$pkp1->id_brand;
        $project->jenis=$pkp1->jenis;
        $project->created_date=$current->format('j-F-Y');
        $project->author=Auth::user()->id;
        $project->type=$pkp1->type;
        $project->save();

            $clf=tipp::where('id_pkp',$id_project)->count();
            if($clf>0){
                $isipkp=tipp::where('id_pkp',$id_project)->where('revisi',$max)->where('turunan',$pkp)->get();
                foreach ($isipkp as $pkpp)
                {
                    $tip= new tipp;
                    $tip->id_pkp=$project->id_project;
                    $tip->idea=$pkpp->idea;
                    $tip->gender=$pkpp->gender;
                    $tip->dariumur=$pkpp->dariumur;
                    $tip->sampaiumur=$pkpp->sampaiumur;
                    $tip->Uniqueness=$pkpp->Uniqueness;
                    $tip->reason=$pkpp->reason;
                    $tip->perevisi=Auth::user()->id;
                    $tip->Estimated=$pkpp->Estimated;
                    $tip->launch=$pkpp->launch;
                    $tip->remarks_ses=$pkpp->remarks_ses;
                    $tip->remarks_forecash=$pkpp->remarks_forecash;
                    $tip->remarks_product_form=$pkpp->remarks_product_form;
                    $tip->years=$pkpp->years;
                    $tip->olahan=$pkpp->olahan;
                    $tip->serving_suggestion=$pkpp->serving_suggestion;
                    $tip->revisi='0';
                    $tip->turunan='0';
                    $tip->tgl_launch=$pkpp->tgl_launch;
                    $tip->competitive=$pkpp->competitive;
                    $tip->selling_price=$pkpp->selling_price;
                    $tip->competitor=$pkpp->competitor;
                    $tip->aisle=$pkpp->aisle;
                    $tip->UOM=$pkpp->UOM;
                    $tip->price=$pkpp->price;
                    $tip->product_form=$pkpp->product_form;
                    $tip->bpom=$pkpp->bpom;
                    $tip->status_data=$pkpp->status_data;
                    $tip->kategori_bpom=$pkpp->kategori_bpom;
                    $tip->akg=$pkpp->akg;
                    $tip->primer=$pkpp->primer;
                    $tip->status_pkp='draf';
                    $tip->primery=$pkpp->primery;
                    $tip->secondary=$pkpp->secondary;
                    $tip->tertiary=$pkpp->tertiary;
                    $tip->kemas_eksis=$pkpp->kemas_eksis;
                    $tip->prefered_flavour=$pkpp->prefered_flavour;
                    $tip->product_benefits=$pkpp->product_benefits;
                    $tip->mandatory_ingredient=$pkpp->mandatory_ingredient;
                    $tip->gambaran_proses=$pkpp->gambaran_proses;
                    $tip->save();
                }
            }
            $picture=picture::where('pkp_id',$id_project)->where('revisi',$max)->where('turunan',$pkp)->count();
            if($picture>0){
                $isipicturepkp=picture::where('pkp_id',$id_project)->where('revisi',$max)->where('turunan',$pkp)->get();
                foreach ($isipicturepkp as $ppkp)
                {
                    $gambar= new picture;
                    $gambar->filename=$ppkp->filename;
                    $gambar->pkp_id=$project->id_project;
                    $gambar->lokasi=$ppkp->lokasi;
                    $gambar->revisi='0';
                    $gambar->turunan='0';
                    $gambar->save();
                }
            }

            $datases=data_ses::where('id_pkp',$id_project)->where('revisi',$max)->where('turunan',$pkp)->count();
            if($datases>0){
                $isises=data_ses::where('id_pkp',$id_project)->where('revisi',$max)->where('turunan',$pkp)->get();
                foreach ($isises as $isises)
                {
                    $data1= new data_ses;
                    $data1->id_pkp=$project->id_project;
                    $data1->revisi='0';
                    $data1->turunan='0';
                    $data1->ses=$isises->ses;
                    $data1->save();
                }
            }

            $datafor=data_forecast::where('id_pkp',$id_project)->where('revisi',$max)->where('turunan',$pkp)->count();
            if($datafor>0){
                $isifor=data_forecast::where('id_pkp',$id_project)->where('revisi',$max)->where('turunan',$pkp)->get();
                foreach ($isifor as $isifor)
                {
                    $data1= new data_forecast;
                    $data1->id_pkp=$project->id_project;
                    $data1->turunan='0';
                    $data1->revisi='0';
                    $data1->forecast=$isifor->forecast;
                    $data1->satuan=$isifor->satuan;
                    $data1->save();
                }
            }

            $datak =data_klaim::where('id_pkp',$id_project)->where('revisi',$max)->where('turunan',$pkp)->count();
            if($datafor>0){
                $isikl=data_klaim::where('id_pkp',$id_project)->where('revisi',$max)->where('turunan',$pkp)->get();
                foreach ($isikl as $isikl)
                {
                    $pipeline = new data_klaim;
                    $pipeline->id_pkp=$project->id_project;
                    $pipeline->turunan='0';
                    $pipeline->id_klaim = $isikl->id_klaim;
                    $pipeline->id_komponen = $isikl->id_komponen;
                    $pipeline->note= $isikl->note;
                    $pipeline->save();
                }

            }

            $detailklaim=data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$max)->where('turunan',$pkp)->count();
            if($detailklaim>0){
                $isidetail=data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$max)->where('turunan',$pkp)->get();
                foreach ($isidetail as $isidetail)
                {
                    $detail= new data_detail_klaim;
                    $detail->id_pkp=$project->id_project;
                    $detail->revisi='0';
                    $detail->turunan='0';
                    $detail->id_detail=$isidetail->id_detail;
                    $detail->save();
                }
            }
            return Redirect::Route('buatpkp',['id_pkp' => $tip->id_pkp, 'revisi' => $tip->revisi, 'turunan' => $tip->turunan]);
    }
}