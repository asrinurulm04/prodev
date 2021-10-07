<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\pkp\PkpProject;
use App\model\pkp\Forecast;
use App\model\pkp\klaim;
use App\model\pkp\DataKlaim;
use App\model\pkp\DetailKlaim;
use App\model\pkp\DataSES;
use App\model\pkp\Allocation;
use App\model\pkp\DataPromo;
use App\model\pkp\PromoIdea;
use App\model\pkp\FileProject;
use App\model\pkp\ProjectLaunching;
use App\model\pdf\SubPDF;
use App\model\pdf\kemaspdf;
use App\model\pdf\ProjectPDF;
use App\model\manager\pengajuan;
use Auth;
use DB;
use Redirect;
use Carbon\Carbon;

class templateController extends Controller
{
    public function template(Request $request,$id_ProjectPDF){
        $pdf     = SubPDF::where('pdf_id',$id_ProjectPDF)->max('turunan');
        $max     = SubPDF::where('pdf_id',$id_ProjectPDF)->max('revisi');
        $pdf1    = ProjectPDF::where('id_project_pdf',$id_ProjectPDF)->first();
        $project = new ProjectPDF;
        $project->project_name = $pdf1->project_name;
        $project->reference    = $pdf1->reference;
        $project->id_brand     = $pdf1->id_brand;
        $project->id_type      = $pdf1->id_type;
        $project->jenis        = $pdf1->jenis;
        $project->product_type = $pdf1->product_type;
        $project->country      = $pdf1->country;
        $project->author       = Auth::user()->id;
        $project->save();

        $clf=SubPDF::where('pdf_id',$id_ProjectPDF)->count();
        if($clf>0){
            $isipdf=SubPDF::where('pdf_id',$id_ProjectPDF)->where('revisi',$max)->where('turunan',$pdf)->get();
            foreach ($isipdf as $ipdf){
                $tip= new SubPDF;
                $tip->pdf_id         = $project->id_ProjectPDF;
                $tip->primer         = $ipdf->primer;
                $tip->primery        = $ipdf->primery;
                $tip->secondery      = $ipdf->secondery;
                $tip->Tertiary       = $ipdf->Tertiary;
                $tip->kemas_eksis    = $ipdf->kemas_eksis;
                $tip->dariusia       = $ipdf->dariusia;
                $tip->sampaiusia     = $ipdf->sampaiusia;
                $tip->gender         = $ipdf->gender;
                $tip->other          = $ipdf->other;
                $tip->wight          = $ipdf->wight;
                $tip->serving        = $ipdf->serving;
                $tip->target_price   = $ipdf->target_price;
                $tip->claim          = $ipdf->claim;
                $tip->ingredient     = $ipdf->ingredient;
                $tip->background     = $ipdf->background;
                $tip->attractiveness = $ipdf->attractiveness;
                $tip->rto            = $ipdf->rto;
                $tip->perevisi       = Auth::user()->id;
                $tip->name           = $ipdf->name;
                $tip->retailer_price = $ipdf->retailer_price;
                $tip->special        = $ipdf->special;
                $tip->revisi         = '0';
                $tip->turunan        = '0';
                $tip->status_data    = 'draf';
                $tip->save();
                }
            }

            $datases=DataSES::where('id_pdf',$id_ProjectPDF)->where('revisi',$max)->where('turunan',$pdf)->count();
            if($datases>0){
                $isises=DataSES::where('id_pdf',$id_ProjectPDF)->where('revisi',$max)->where('turunan',$pdf)->get();
                foreach ($isises as $isises){
                    $data1= new DataSES;
                    $data1->id_pdf  = $project->id_ProjectPDF;
                    $data1->revisi  = '0';
                    $data1->turunan = '0';
                    $data1->ses     = $isises->ses;
                    $data1->save();
                }
            }

            $datafor=Forecast::where('id_pdf',$id_ProjectPDF)->where('revisi',$max)->where('turunan',$pdf)->count();
            if($datafor>0){
                $isifor=Forecast::where('id_pdf',$id_ProjectPDF)->where('revisi',$max)->where('turunan',$pdf)->get();
                foreach ($isifor as $isifor){
                    $for= new Forecast;
                    $for->id_pdf     = $project->id_ProjectPDF;
                    $for->revisi     = '0';
                    $for->turunan    = '0';
                    $for->forecast   = $isifor->forecast;
                    $for->satuan     = $isifor->satuan;
                    $for->keterangan = $isifor->keterangan;
                    $for->save();
                }
            }

            $dataklaim=DataKlaim::where('id_pdf',$id_ProjectPDF)->where('revisi',$max)->where('turunan',$pdf)->count();
            if($dataklaim>0){
                $isiklaim=DataKlaim::where('id_pdf',$id_ProjectPDF)->where('revisi',$max)->where('turunan',$pdf)->get();
                foreach ($isiklaim as $isiklaim){
                    $klaim= new DataKlaim;
                    $klaim->id_pdf      = $project->id_ProjectPDF;
                    $klaim->revisi      = '0';
                    $klaim->turunan     = '0';
                    $klaim->id_komponen = $isiklaim->id_komponen;
                    $klaim->id_klaim    = $isiklaim->id_klaim;
                    $klaim->note        = $isiklaim->note;
                    $klaim->save();
                }
            }

            $detailklaim=DetailKlaim::where('id_pdf',$id_ProjectPDF)->where('revisi',$max)->where('turunan',$pdf)->count();
            if($detailklaim>0){
                $isidetail=DetailKlaim::where('id_pdf',$id_ProjectPDF)->where('revisi',$max)->where('turunan',$pdf)->get();
                foreach ($isidetail as $isidetail){
                    $detail= new DetailKlaim;
                    $detail->id_pdf    = $project->id_ProjectPDF;
                    $detail->revisi    = '0';
                    $detail->turunan   = '0';
                    $detail->id_detail = $isidetail->id_detail;
                    $detail->save();
                }
            }

            $detailkemaspdf=kemaspdf::where('id_pdf',$id_ProjectPDF)->where('revisi',$max)->where('turunan',$pdf)->count();
            if($detailkemaspdf>0){
                $isikemaspdf=kemaspdf::where('id_pdf',$id_ProjectPDF)->where('revisi',$max)->where('turunan',$pdf)->get();
                foreach ($isikemaspdf as $isikemaspdf){
                    $detail= new kemaspdf;
                    $detail->id_pdf      = $project->id_ProjectPDF;
                    $detail->revisi      = '0';
                    $detail->turunan     = '0';
                    $detail->oracle      = $isikemaspdf->oracle;
                    $detail->kk          = $isikemaspdf->kk;
                    $detail->information = $isikemaspdf->information;
                    $detail->save();
                }
            }
            return redirect::route('buatpdf1',['pdf_id' => $tip->pdf_id, 'revisi' => $tip->revisi, 'turunan' => $tip->turunan]);
    }

    public function templatepkpumum($id_project,$revisi,$turunan,$kemas){
        $pkp     = PkpProject::max('id_pkp')+1;
        $current = Carbon::now();
        $pkpp    = PkpProject::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->first();

        $tip= new PkpProject;
        $tip->id_pkp                = $pkp;
        $tip->project_name          = $pkpp->project_name;
        $tip->type                  = $pkpp->type;
        $tip->idea                  = $pkpp->idea;
        $tip->gender                = $pkpp->gender;
        $tip->dariumur              = $pkpp->dariumur;
        $tip->sampaiumur            = $pkpp->sampaiumur;
        $tip->Uniqueness            = $pkpp->Uniqueness;
        $tip->reason                = $pkpp->reason;
        $tip->no_kemas              = 'A';
        $tip->id_brand              = $pkpp->id_brand;
        $tip->kategori              = 'New';
        $tip->jenis                 = 'Umum';
        $tip->created_date          = $current->format('j-F-Y');
        $tip->last_update           = $current->format('j-F-Y');
        $tip->author                = Auth::user()->id;
        $tip->perevisi              = Auth::user()->id;
        $tip->Estimated             = $pkpp->Estimated;
        $tip->launch                = $pkpp->launch;
        $tip->remarks_ses           = $pkpp->remarks_ses;
        $tip->remarks_forecash      = $pkpp->remarks_forecash;
        $tip->remarks_product_form  = $pkpp->remarks_product_form;
        $tip->years                 = $pkpp->years;
        $tip->olahan                = $pkpp->olahan;
        $tip->serving_suggestion    = $pkpp->serving_suggestion;
        $tip->revisi                = '0';
        $tip->turunan               = '0';
        $tip->revisi_kemas          = '0';
        $tip->competitive           = $pkpp->competitive;
        $tip->selling_price         = $pkpp->selling_price;
        $tip->competitor            = $pkpp->competitor;
        $tip->aisle                 = $pkpp->aisle;
        $tip->UOM                   = $pkpp->UOM;
        $tip->price                 = $pkpp->price;
        $tip->product_form          = $pkpp->product_form;
        $tip->bpom                  = $pkpp->bpom;
        $tip->kategori_bpom         = $pkpp->kategori_bpom;
        $tip->akg                   = $pkpp->akg;
        $tip->primer                = $pkpp->primer;
        $tip->status_pkp            = 'draf';
        $tip->primery               = $pkpp->primery;
        $tip->secondary             = $pkpp->secondary;
        $tip->tertiary              = $pkpp->tertiary;
        $tip->kemas_eksis           = $pkpp->kemas_eksis;
        $tip->prefered_flavour      = $pkpp->prefered_flavour;
        $tip->product_benefits      = $pkpp->product_benefits;
        $tip->mandatory_ingredient  = $pkpp->mandatory_ingredient;
        $tip->gambaran_proses       = $pkpp->gambaran_proses;
        $tip->save();
        
        $datases=DataSES::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
        if($datases>0){
            $isises=DataSES::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
            foreach ($isises as $isises) {
                $data1= new DataSES;
                $data1->id_project   = $tip->id_project;
                $data1->id_pkp       = $pkp;
                $data1->revisi       = '0';
                $data1->revisi_kemas = '0';
                $data1->turunan      = '0';
                $data1->ses          = $isises->ses;
                $data1->save();
            }
        }
        
        $datafor=Forecast::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
        if($datafor>0){
            $isifor=Forecast::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
            foreach ($isifor as $isifor){
                $data1= new Forecast;
                $data1->id_project   = $tip->id_project;
                $data1->id_pkp       = $pkp;
                $data1->turunan      = '0';
                $data1->revisi       = '0';
                $data1->revisi_kemas = '0';
                $data1->forecast     = $isifor->forecast;
                $data1->satuan       = $isifor->satuan;
                $data1->save();
            }
        }

        $datak =DataKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
        if($datak>0){
            $isikl=DataKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
            foreach ($isikl as $isikl){
                $pipeline = new DataKlaim;
                $pipeline->id_project   = $tip->id_project;
                $pipeline->id_pkp       = $pkp;
                $pipeline->turunan      = '0';
                $pipeline->revisi       = '0';
                $pipeline->revisi_kemas = '0';
                $pipeline->id_klaim     = $isikl->id_klaim;
                $pipeline->id_komponen  = $isikl->id_komponen;
                $pipeline->note         = $isikl->note;
                $pipeline->save();
            }
        }

        $detailklaim=DetailKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
        if($detailklaim>0){
            $isidetail=DetailKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
            foreach ($isidetail as $isidetail){
                $detail= new DetailKlaim;
                $detail->id_project   = $tip->id_project;
                $detail->id_pkp       = $pkp;
                $detail->revisi       = '0';
                $detail->revisi_kemas = '0';
                $detail->turunan      = '0';
                $detail->id_detail    = $isidetail->id_detail;
                $detail->save();
            }
        }
        return Redirect::Route('buatpkp1',[$tip->id_project,$tip->id_pkp]);
    }

    public function templatepkpkemas($id_project,$revisi,$turunan,$kemas){
        $pkp     = PkpProject::max('id_pkp')+1;
        $current = Carbon::now();
        $pkpp    = PkpProject::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->first();

        $tip = new PkpProject;
        $tip->id_pkp                = $pkp;
        $tip->project_name          = $pkpp->project_name;
        $tip->type                  = $pkpp->type;
        $tip->idea                  = $pkpp->idea;
        $tip->no_kemas              = 'A';
        $tip->id_brand              = $pkpp->id_brand;
        $tip->kategori              = 'New';
        $tip->jenis                 = 'Kemas';
        $tip->competitive           = $pkpp->competitive;
        $tip->competitor            = $pkpp->competitor;
        $tip->created_date          = $current->format('j-F-Y');
        $tip->last_update           = $current->format('j-F-Y');
        $tip->author                = Auth::user()->id;
        $tip->perevisi              = Auth::user()->id;
        $tip->launch                = $pkpp->launch;
        $tip->remarks_forecash      = $pkpp->remarks_forecash;
        $tip->remarks_product_form  = $pkpp->remarks_product_form;
        $tip->years                 = $pkpp->years;
        $tip->revisi                = '0';
        $tip->turunan               = '0';
        $tip->revisi_kemas          = '0';
        $tip->selling_price         = $pkpp->selling_price;
        $tip->aisle                 = $pkpp->aisle;
        $tip->UOM                   = $pkpp->UOM;
        $tip->price                 = $pkpp->price;
        $tip->product_form          = $pkpp->product_form;
        $tip->akg                   = $pkpp->akg;
        $tip->primer                = $pkpp->primer;
        $tip->status_pkp            = 'draf';
        $tip->primery               = $pkpp->primery;
        $tip->secondary             = $pkpp->secondary;
        $tip->tertiary              = $pkpp->tertiary;
        $tip->kemas_eksis           = $pkpp->kemas_eksis;
        $tip->save();

        $datafor=Forecast::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
        if($datafor>0){
            $isifor=Forecast::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
            foreach ($isifor as $isifor){
                $data1= new Forecast;
                $data1->id_project   = $tip->id_project;
                $data1->id_pkp       = $pkp;
                $data1->turunan      = '0';
                $data1->revisi       = '0';
                $data1->revisi_kemas = '0';
                $data1->forecast     = $isifor->forecast;
                $data1->satuan       = $isifor->satuan;
                $data1->save();
            }
        }
        return Redirect::Route('buatpkp1',[$tip->id_project,$tip->id_pkp]);
    }

    public function templatepkpbaku($id_project,$revisi,$turunan,$kemas){
        $pkp     = PkpProject::max('id_pkp')+1;
        $current = Carbon::now();
        $pkpp    = PkpProject::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->first();

        $tip = new PkpProject;
        $tip->id_pkp                = $pkp;
        $tip->project_name          = $pkpp->project_name;
        $tip->type                  = $pkpp->type;
        $tip->idea                  = $pkpp->idea;
        $tip->gender                = $pkpp->gender;
        $tip->dariumur              = $pkpp->dariumur;
        $tip->sampaiumur            = $pkpp->sampaiumur;
        $tip->Uniqueness            = $pkpp->Uniqueness;
        $tip->reason                = $pkpp->reason;
        $tip->no_kemas              = 'A';
        $tip->id_brand              = $pkpp->id_brand;
        $tip->kategori              = 'New';
        $tip->jenis                 = 'Baku';
        $tip->created_date          = $current->format('j-F-Y');
        $tip->last_update           = $current->format('j-F-Y');
        $tip->author                = Auth::user()->id;
        $tip->perevisi              = Auth::user()->id;
        $tip->Estimated             = $pkpp->Estimated;
        $tip->launch                = $pkpp->launch;
        $tip->remarks_ses           = $pkpp->remarks_ses;
        $tip->remarks_forecash      = $pkpp->remarks_forecash;
        $tip->remarks_product_form  = $pkpp->remarks_product_form;
        $tip->years                 = $pkpp->years;
        $tip->olahan                = $pkpp->olahan;
        $tip->serving_suggestion    = $pkpp->serving_suggestion;
        $tip->revisi                = '0';
        $tip->turunan               = '0';
        $tip->revisi_kemas          = '0';
        $tip->competitive           = $pkpp->competitive;
        $tip->selling_price         = $pkpp->selling_price;
        $tip->competitor            = $pkpp->competitor;
        $tip->aisle                 = $pkpp->aisle;
        $tip->UOM                   = $pkpp->UOM;
        $tip->price                 = $pkpp->price;
        $tip->product_form          = $pkpp->product_form;
        $tip->bpom                  = $pkpp->bpom;
        $tip->kategori_bpom         = $pkpp->kategori_bpom;
        $tip->akg                   = $pkpp->akg;
        $tip->primer                = $pkpp->primer;
        $tip->status_pkp            = 'draf';
        $tip->primery               = $pkpp->primery;
        $tip->secondary             = $pkpp->secondary;
        $tip->tertiary              = $pkpp->tertiary;
        $tip->prefered_flavour      = $pkpp->prefered_flavour;
        $tip->product_benefits      = $pkpp->product_benefits;
        $tip->mandatory_ingredient  = $pkpp->mandatory_ingredient;
        $tip->gambaran_proses       = $pkpp->gambaran_proses;
        $tip->save();
        
        $datases=DataSES::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
        if($datases>0){
            $isises=DataSES::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
            foreach ($isises as $isises) {
                $data1= new DataSES;
                $data1->id_project   = $tip->id_project;
                $data1->id_pkp       = $pkp;
                $data1->revisi       = '0';
                $data1->revisi_kemas = '0';
                $data1->turunan      = '0';
                $data1->ses          = $isises->ses;
                $data1->save();
            }
        }
        
        $datafor=Forecast::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
        if($datafor>0){
            $isifor=Forecast::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
            foreach ($isifor as $isifor){
                $data1= new Forecast;
                $data1->id_project   = $tip->id_project;
                $data1->id_pkp       = $pkp;
                $data1->turunan      = '0';
                $data1->revisi       = '0';
                $data1->revisi_kemas = '0';
                $data1->forecast     = $isifor->forecast;
                $data1->satuan       = $isifor->satuan;
                $data1->save();
            }
        }

        $datak =DataKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
        if($datak>0){
            $isikl=DataKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
            foreach ($isikl as $isikl){
                $pipeline = new DataKlaim;
                $pipeline->id_project   = $tip->id_project;
                $pipeline->id_pkp       = $pkp;
                $pipeline->turunan      = '0';
                $pipeline->revisi       = '0';
                $pipeline->revisi_kemas = '0';
                $pipeline->id_klaim     = $isikl->id_klaim;
                $pipeline->id_komponen  = $isikl->id_komponen;
                $pipeline->note         = $isikl->note;
                $pipeline->save();
            }
        }

        $detailklaim=DetailKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
        if($detailklaim>0){
            $isidetail=DetailKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
            foreach ($isidetail as $isidetail){
                $detail= new DetailKlaim;
                $detail->id_project   = $tip->id_project;
                $detail->id_pkp       = $pkp;
                $detail->revisi       = '0';
                $detail->revisi_kemas = '0';
                $detail->turunan      = '0';
                $detail->id_detail    = $isidetail->id_detail;
                $detail->save();
            }
        }
        return Redirect::Route('buatpkp1',[$tip->id_project,$tip->id_pkp]);
    }
    
    public function improve(Request $request, $id_project,$revisi,$turunan,$kemas){
        $pkp     = PkpProject::max('id_pkp')+1;
        $current = Carbon::now();
        $pkpp    = PkpProject::where('id_project',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->first();
        $launch  = ProjectLaunching::where('id_pkp',$pkpp->id_project)->first();

        $tip= new PkpProject;
        $tip->id_pkp                = $pkpp->id_pkp;
        $tip->project_name          = $launch->nama_produk;
        $tip->type                  = $pkpp->type;
        $tip->idea                  = $pkpp->idea;
        $tip->gender                = $pkpp->gender;
        $tip->dariumur              = $pkpp->dariumur;
        $tip->sampaiumur            = $pkpp->sampaiumur;
        $tip->Uniqueness            = $pkpp->Uniqueness;
        $tip->reason                = $pkpp->reason;
        $tip->id_brand              = $pkpp->id_brand;
        $tip->project_dev           = $pkpp->pkp_number.$pkpp->ket_no;
        $tip->kategori              = 'New';
        $tip->info                  = '_Imp';
        if($request->imp=='umum'){
            $tip->jenis             = 'Umum';
            $tip->primery           = $pkpp->primery;
            $tip->secondary         = $pkpp->secondary;
            $tip->tertiary          = $pkpp->tertiary;
            $tip->kemas_eksis       = $pkpp->kemas_eksis;
            $tip->primer            = $pkpp->primer;
        }elseif($request->imp=='baku'){
            $tip->jenis             = 'Baku';
        }
        $tip->created_date          = $current->format('j-F-Y');
        $tip->last_update           = $current->format('j-F-Y');
        $tip->author                = Auth::user()->id;
        $tip->perevisi              = Auth::user()->id;
        $tip->Estimated             = $pkpp->Estimated;
        $tip->launch                = $pkpp->launch;
        $tip->remarks_ses           = $pkpp->remarks_ses;
        $tip->remarks_forecash      = $pkpp->remarks_forecash;
        $tip->remarks_product_form  = $pkpp->remarks_product_form;
        $tip->years                 = $pkpp->years;
        $tip->olahan                = $pkpp->olahan;
        $tip->serving_suggestion    = $pkpp->serving_suggestion;
        $tip->revisi                = '0';
        $tip->turunan               = '0';
        $tip->revisi_kemas          = '0';
        $tip->no_kemas              = $pkpp->no_kemas;
        $tip->competitive           = $pkpp->competitive;
        $tip->selling_price         = $pkpp->selling_price;
        $tip->competitor            = $pkpp->competitor;
        $tip->aisle                 = $pkpp->aisle;
        $tip->UOM                   = $pkpp->UOM;
        $tip->price                 = $pkpp->price;
        $tip->product_form          = $pkpp->product_form;
        $tip->bpom                  = $pkpp->bpom;
        $tip->kategori_bpom         = $pkpp->kategori_bpom;
        $tip->akg                   = $pkpp->akg;
        $tip->status_pkp            = 'draf';
        $tip->prefered_flavour      = $pkpp->prefered_flavour;
        $tip->product_benefits      = $pkpp->product_benefits;
        $tip->mandatory_ingredient  = $pkpp->mandatory_ingredient;
        $tip->gambaran_proses       = $pkpp->gambaran_proses;
        $tip->pengajuan_sample      = $pkpp->pengajuan_sample;
        $tip->workbook              = $pkpp->workbook;
        $tip->save();
        
        $picture=FileProject::where([['pkp_id',$pkpp->id_project],['revisi',$revisi],['turunan',$turunan],['revisi_kemas',$kemas]])->count();
        if($picture>0){
            $isipicturepkp=FileProject::where([['pkp_id',$pkpp->id_project],['revisi',$revisi],['turunan',$turunan],['revisi_kemas',$kemas]])->get();
            foreach ($isipicturepkp as $ppkp){
                $gambar= new FileProject;
                $gambar->filename     = $ppkp->filename;
                $gambar->pkp_id       = $pkpp->id_pkp;
                $gambar->lokasi       = $ppkp->lokasi;
                $gambar->revisi       = '0';
                $gambar->revisi_kemas = '0';
                $gambar->turunan      = '0';
                $gambar->save();
            }
        }
        
        $datases=DataSES::where([['id_project',$pkpp->id_project],['id_pkp',$id_project],['revisi',$revisi],['turunan',$turunan],['revisi_kemas',$kemas]])->count();
        if($datases>0){
            $isises=DataSES::where([['id_project',$pkpp->id_project],['id_pkp',$id_project],['revisi',$revisi],['turunan',$turunan],['revisi_kemas',$kemas]])->get();
            foreach ($isises as $isises){
                $data1= new DataSES;
                $data1->id_project   = $tip->id_project;
                $data1->id_pkp       = $pkpp->id_pkp;
                $data1->revisi       = '0';
                $data1->revisi_kemas = '0';
                $data1->turunan      = '0';
                $data1->ses          = $isises->ses;
                $data1->save();
            }
        }

        $datafor=Forecast::where([['id_project',$pkpp->id_project],['id_pkp',$id_project],['revisi',$revisi],['turunan',$turunan],['revisi_kemas',$kemas]])->count();
        if($datafor>0){
            $isifor=Forecast::where([['id_project',$pkpp->id_project],['id_pkp',$id_project],['revisi',$revisi],['turunan',$turunan],['revisi_kemas',$kemas]])->get();
            foreach ($isifor as $isifor){
                $data1= new Forecast;
                $data1->id_project   = $tip->id_project;
                $data1->id_pkp       = $pkpp->id_pkp;
                $data1->turunan      = '0';
                $data1->revisi       = '0';
                $data1->revisi_kemas = '0';
                $data1->forecast     = $isifor->forecast;
                $data1->satuan       = $isifor->satuan;
                $data1->save();
            }
        }

        $datak =DataKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$id_project],['revisi',$revisi],['turunan',$turunan],['revisi_kemas',$kemas]])->count();
        if($datafor>0){
            $isikl=DataKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$id_project],['revisi',$revisi],['turunan',$turunan],['revisi_kemas',$kemas]])->get();
            foreach ($isikl as $isikl){
                $pipeline = new DataKlaim;
                $pipeline->id_pkp       = $pkpp->id_pkp;
                $pipeline->id_project   = $tip->id_project;
                $pipeline->turunan      = '0';
                $pipeline->revisi       = '0';
                $pipeline->revisi_kemas = '0';
                $pipeline->id_klaim     = $isikl->id_klaim;
                $pipeline->id_komponen  = $isikl->id_komponen;
                $pipeline->note         = $isikl->note;
                $pipeline->save();
            }
        }

        $detailklaim=DetailKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$id_project],['revisi',$revisi],['turunan',$turunan],['revisi_kemas',$kemas]])->count();
        if($detailklaim>0){
            $isidetail=DetailKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$id_project],['revisi',$revisi],['turunan',$turunan],['revisi_kemas',$kemas]])->get();
            foreach ($isidetail as $isidetail){
                $detail= new DetailKlaim;
                $detail->id_project   = $tip->id_project;
                $detail->id_pkp       = $pkpp->id_pkp;
                $detail->revisi       = '0';
                $detail->revisi_kemas = '0';
                $detail->turunan      = '0';
                $detail->id_detail    = $isidetail->id_detail;
                $detail->save();
            }
        }
        return Redirect::Route('buatpkp1',[$tip->id_project,$tip->id_pkp]);
    }
    
    public function upversionpkp($id_project,$revisi,$turunan,$kemas){
        $pkp       = PkpProject::where('id_project',$id_project)->max('revisi');
        $naikversi = $pkp + 1;

        $pkpp=PkpProject::where('id_project',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->first();
        $pkpp->status_project = 'inactive';
        $pkpp->status_pkp     = 'revisi';
        $pkpp->save();

        $tip= new PkpProject;
        $tip->pkp_number            = $pkpp->pkp_number;
        $tip->ket_no                = $pkpp->ket_no;
        $tip->project_name          = $pkpp->project_name;
        $tip->id_brand              = $pkpp->id_brand;
        $tip->no_kemas              = $pkpp->no_kemas;
        $tip->revisi_kemas          = $pkpp->revisi_kemas;
        $tip->type                  = $pkpp->type;
        $tip->jenis                 = $pkpp->jenis;
        $tip->kategori              = $pkpp->kategori;
        $tip->created_date          = $pkpp->created_date;
        $tip->last_update           = $pkpp->last_update;
        $tip->tgl_kirim             = $pkpp->tgl_kirim;
        $tip->author                = $pkpp->author;
        $tip->tujuankirim           = $pkpp->tujuankirim;
        $tip->tujuankirim2          = $pkpp->tujuankirim2;
        $tip->status_terima         = $pkpp->status_terima;
        $tip->status_terima2        = $pkpp->status_terima2;
        $tip->id_pkp                = $pkpp->id_pkp;
        $tip->prioritas             = $pkpp->prioritas;
        $tip->idea                  = $pkpp->idea;
        $tip->gender                = $pkpp->gender;
        $tip->dariumur              = $pkpp->dariumur;
        $tip->sampaiumur            = $pkpp->sampaiumur;
        $tip->Uniqueness            = $pkpp->Uniqueness;
        $tip->reason                = $pkpp->reason;
        $tip->Estimated             = $pkpp->Estimated;
        $tip->remarks_ses           = $pkpp->remarks_ses;
        $tip->remarks_forecash      = $pkpp->remarks_forecash;
        $tip->remarks_product_form  = $pkpp->remarks_product_form;
        $tip->launch                = $pkpp->launch;
        $tip->serving_suggestion    = $pkpp->serving_suggestion;
        $tip->years                 = $pkpp->years;
        $tip->olahan                = $pkpp->olahan;
        $tip->revisi                = $naikversi;
        $tip->turunan               = $pkpp->turunan;
        $tip->competitive           = $pkpp->competitive;
        $tip->selling_price         = $pkpp->selling_price;
        $tip->competitor            = $pkpp->competitor;
        $tip->aisle                 = $pkpp->aisle;
        $tip->product_form          = $pkpp->product_form;
        $tip->bpom                  = $pkpp->bpom;
        $tip->kategori_bpom         = $pkpp->kategori_bpom;
        $tip->akg                   = $pkpp->akg;
        $tip->UOM                   = $pkpp->UOM;
        $tip->price                 = $pkpp->price;
        $tip->status_pkp            = 'revisi';
        $tip->primery               = $pkpp->primery;
        $tip->secondary             = $pkpp->secondary;
        $tip->tertiary              = $pkpp->tertiary;
        $tip->kemas_eksis           = $pkpp->kemas_eksis;
        $tip->prefered_flavour      = $pkpp->prefered_flavour;
        $tip->product_benefits      = $pkpp->product_benefits;
        $tip->mandatory_ingredient  = $pkpp->mandatory_ingredient;
        $tip->gambaran_proses       = $pkpp->gambaran_proses;
        $tip->workbook              = $pkpp->workbook;
        $tip->approval              = $pkpp->approval;
        $tip->perevisi              = Auth::user()->id;
        $tip->save();

        $datases=DataSES::where('id_pkp',$pkpp->id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->count();
        if($datases>0){
            $isises=DataSES::where('id_pkp',$pkpp->id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->get();
            foreach ($isises as $isises){
                $data1= new DataSES;
                $data1->id_project   = $tip->id_project;
                $data1->id_pkp       = $isises->id_pkp;
                $data1->revisi       = $naikversi;
                $data1->turunan      = $isises->turunan;
                $data1->revisi_kemas = $isises->revisi_kemas;
                $data1->ses          = $isises->ses;
                $data1->save();
            }
        }
        $datafor=Forecast::where('id_pkp',$pkpp->id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->count();
        if($datafor>0){
            $isifor=Forecast::where('id_pkp',$pkpp->id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->get();
            foreach ($isifor as $isifor){
                $for= new Forecast;
                $for->id_project   = $tip->id_project;
                $for->id_pkp       = $isifor->id_pkp;
                $for->revisi       = $naikversi;
                $for->turunan      = $isifor->turunan;
                $for->revisi_kemas = $isifor->revisi_kemas;
                $for->forecast     = $isifor->forecast;
                $for->satuan       = $isifor->satuan;
                $for->save();
            }
        }
        $dataklaim=DataKlaim::where('id_pkp',$pkpp->id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->count();
        if($dataklaim>0){
            $isiklaim=DataKlaim::where('id_pkp',$pkpp->id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->get();
            foreach ($isiklaim as $isiklaim){
                $klaim= new DataKlaim;
                $klaim->id_project   = $tip->id_project;
                $klaim->id_pkp       = $isiklaim->id_pkp;
                $klaim->revisi       = $naikversi;
                $klaim->turunan      = $isiklaim->turunan;
                $klaim->revisi_kemas = $isiklaim->revisi_kemas;
                $klaim->id_komponen  = $isiklaim->id_komponen;
                $klaim->id_klaim     = $isiklaim->id_klaim;
                $klaim->note         = $isiklaim->note;
                $klaim->save();
            }
        }
        $detailklaim=DetailKlaim::where('id_pkp',$pkpp->id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->count();
        if($detailklaim>0){
            $isidetail=DetailKlaim::where('id_pkp',$pkpp->id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->get();
            foreach ($isidetail as $isidetail){
                $detail= new DetailKlaim;
                $detail->id_project   = $tip->id_project;
                $detail->id_pkp       = $isidetail->id_pkp;
                $detail->revisi       = $naikversi;
                $detail->turunan      = $isidetail->turunan;
                $detail->revisi_kemas = $isidetail->revisi_kemas;
                $detail->id_detail    = $isidetail->id_detail;
                $detail->save();
            }
        }

        $pengajuan = pengajuan::where('pkp_id',$pkpp->id_project)->count();
        if($pengajuan == 1){
            $pengajuan = pengajuan::where('pkp_id',$pkpp->id_project)->delete();
        }

        return Redirect::Route('buatpkp',$tip->id_project);
    }
    
    public function upversionpdf($id_ProjectPDF,$revisi,$turunan){
        $pdf       = SubPDF::where('pdf_id',$id_ProjectPDF)->max('revisi');
        $naikversi = $pdf + 1;

        $project = ProjectPDF::where('id_project_pdf',$id_ProjectPDF)->first();
        $project->status_project='revisi';
        $project->save();

        $datapdf = SubPDF::where('pdf_id',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $datapdf->status_pdf='inactive';
        $datapdf->save();

        $clf = SubPDF::where('pdf_id',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($clf>0){
            $isipdf=SubPDF::where('pdf_id',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach ($isipdf as $pdfp){
                $SubPDF= new SubPDF;
                $SubPDF->pdf_id         = $pdfp->pdf_id;
                $SubPDF->primer         = $pdfp->primer;
                $SubPDF->primery        = $pdfp->primery;
                $SubPDF->secondery      = $pdfp->secondery;
                $SubPDF->Tertiary       = $pdfp->Tertiary;
                $SubPDF->dariusia       = $pdfp->dariusia;
                $SubPDF->sampaiusia     = $pdfp->sampaiusia;
                $SubPDF->gender         = $pdfp->gender;
                $SubPDF->other          = $pdfp->other;
                $SubPDF->kemas_eksis    = $pdfp->kemas_eksis;
                $SubPDF->wight          = $pdfp->wight;
                $SubPDF->serving        = $pdfp->serving;
                $SubPDF->target_price   = $pdfp->target_price;
                $SubPDF->claim          = $pdfp->claim;
                $SubPDF->ingredient     = $pdfp->ingredient;
                $SubPDF->background     = $pdfp->background;
                $SubPDF->attractiveness = $pdfp->attractiveness;
                $SubPDF->rto            = $pdfp->rto;
                $SubPDF->status_data    = 'revisi';
                $SubPDF->status_pdf     = 'active';
                $SubPDF->name           = $pdfp->name;
                $SubPDF->retailer_price = $pdfp->retailer_price;
                $SubPDF->special        = $pdfp->special;
                $SubPDF->turunan        = $pdfp->turunan;
                $SubPDF->revisi         = $naikversi;
                $SubPDF->save();
            }
        }
            
        $datases=DataSES::where('id_pdf',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($datases>0){
            $isises=DataSES::where('id_pdf',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach ($isises as $isises) {
                $data1= new DataSES;
                $data1->id_pdf  = $isises->id_pdf;
                $data1->revisi  = $naikversi;
                $data1->turunan = $isises->turunan;
                $data1->ses     = $isises->ses;
                $data1->save();
            }
        }

        $datafor=Forecast::where('id_pdf',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($datafor>0){
            $isifor=Forecast::where('id_pdf',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach ($isifor as $isifor){
                $for= new Forecast;
                $for->id_pdf     = $isifor->id_pdf;
                $for->revisi     = $naikversi;
                $for->turunan    = $isifor->turunan;
                $for->forecast   = $isifor->forecast;
                $for->satuan     = $isifor->satuan;
                $for->keterangan = $isifor->keterangan;
                $for->save();
            }
        }

        $dataklaim=DataKlaim::where('id_pdf',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($dataklaim>0){
            $isiklaim=DataKlaim::where('id_pdf',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach ($isiklaim as $isiklaim){
                $klaim= new DataKlaim;
                $klaim->id_pdf      = $isiklaim->id_pdf;
                $klaim->revisi      = $naikversi;
                $klaim->turunan     = $isiklaim->turunan;
                $klaim->id_komponen = $isiklaim->id_komponen;
                $klaim->id_klaim    = $isiklaim->id_klaim;
                $klaim->note        = $isiklaim->note;
                $klaim->save();
            }
        }
        $detailklaim=DetailKlaim::where('id_pdf',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($detailklaim>0){
            $isidetail=DetailKlaim::where('id_pdf',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach ($isidetail as $isidetail){
                $detail= new DetailKlaim;
                $detail->id_pdf    = $isidetail->id_pdf;
                $detail->revisi    = $naikversi;
                $detail->turunan   = $isidetail->turunan;
                $detail->id_detail = $isidetail->id_detail;
                $detail->save();
            }
        }
        
        $detailkemaspdf=kemaspdf::where('id_pdf',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($detailkemaspdf>0){
            $isikemaspdf=kemaspdf::where('id_pdf',$id_ProjectPDF)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach ($isikemaspdf as $isikemaspdf){
                $detail= new kemaspdf;
                $detail->id_pdf      = $isikemaspdf->id_pdf;
                $detail->revisi      = $naikversi;
                $detail->turunan     = $isikemaspdf->turunan;
                $detail->oracle      = $isikemaspdf->oracle;
                $detail->kk          = $isikemaspdf->kk;
                $detail->information = $isikemaspdf->information;
                $detail->save();
            }
        }
        return Redirect::Route('buatpdf1',['pdf_id' => $id_ProjectPDF, 'revisi' => $naikversi, 'turunan' => $turunan]);
    }
    
    public function upversionpromo($id_pkp_promo,$revisi,$turunan){
        $promo     = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $naikversi = $promo->revisi + 1;

        $datapromo = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $datapromo->status_data='inactive';
        $datapromo->save();

        $clf = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($clf>0){
            $isipromo = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach ($isipromo as $promoo){
                $ppromo = new DataPromo;
                $ppromo->id_pkp_promoo    = $promoo->id_pkp_promoo;
                $ppromo->application      = $promoo->application;
                $ppromo->promo_readiness  = $promoo->promo_readiness;
                $ppromo->promo_readiness2 = $promoo->promo_readiness2;
                $ppromo->rto              = $promoo->rto;
                $ppromo->status_promo     = 'revisi';
                $ppromo->status_data      = 'active';
                $ppromo->turunan          = $promoo->turunan;
                $ppromo->revisi           = $naikversi;
                $ppromo->gambaran_proses  = $promoo->gambaran_proses;
                $ppromo->save();
            }
        }
        $allocation = Allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($allocation>0){
            $isiallocation = Allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach($isiallocation as $all){
                $al= new Allocation;
                $al->id_pkp_promo = $all->id_pkp_promo;
                $al->product_sku  = $all->product_sku;
                $al->allocation   = $all->allocation;
                $al->remarks      = $all->remarks;
                $al->start        = $all->start;
                $al->end          = $all->end;
                $al->turunan      = $all->turunan;
                $al->revisi       = $naikversi;
                $al->rto          = $all->rto;
                $al->opsi         = $all->opsi;
                $al->save();
            }
        }
        $idea = PromoIdea::where('id_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($idea>0){
            $isiidea = PromoIdea::where('id_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach($isiidea as $all){
                $ide= new PromoIdea;
                $ide->id_promo   = $all->id_promo;
                $ide->promo_idea = $all->promo_idea;
                $ide->dimension  = $all->dimension;
                $ide->turunan    = $all->turunan;
                $ide->revisi     = $naikversi;
                $ide->save();
            }
        }
        return Redirect::Route('datapromo11',['id_pkp_promo'=> $ppromo->id_pkp_promoo,'revisi' => $naikversi,'turunan' => $ppromo->turunan]);
    }
}