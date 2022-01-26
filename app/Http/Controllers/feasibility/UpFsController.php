<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\model\pdf\ProjectPDF;
use App\model\pkp\PkpProject;
use App\model\Modellab\DataLab;
use App\model\Modelmesin\OH;
use App\model\Modelmesin\Mesin;
use App\model\feasibility\WorkbookFs;
use App\model\feasibility\Feasibility;
use App\model\feasibility\reportRevisi;
use App\model\feasibility\FormPengajuanFS;
use App\model\Modelmaklon\Maklon;
use App\model\Modelmesin\LiniTerdampak;
use App\model\Modelkemas\KonsepKemas;
use App\model\Modelkemas\FormulaKemas;
use App\model\users\Departement;
use App\model\users\User;
use Redirect;
use Auth;

class UpFsController extends Controller
{
    public function up(Request $request,$fs){ // naik versi FS
        $Clonefs    = Feasibility::where('id',$fs)->first();
        if($Clonefs->id_project!=NULL){ // ketika type project PKP
            $naikKemas  = Feasibility::where('id_formula',$Clonefs->id_formula)->where('id_project',$Clonefs->id_project)->where('revisi',$Clonefs->revisi)->max('revisi_kemas')+1;
            $naikLab    = Feasibility::where('id_formula',$Clonefs->id_formula)->where('id_project',$Clonefs->id_project)->where('revisi',$Clonefs->revisi)->max('revisi_lab')+1;
            $naikProses = Feasibility::where('id_formula',$Clonefs->id_formula)->where('id_project',$Clonefs->id_project)->where('revisi',$Clonefs->revisi)->max('revisi_proses')+1;
        }elseif($Clonefs->id_project_pdf!=NULL){ // Ketika project type PDF
            $naikKemas  = Feasibility::where('id_formula',$Clonefs->id_formula)->where('id_project_pdf',$Clonefs->id_project_pdf)->where('revisi',$Clonefs->revisi)->max('revisi_kemas')+1;
            $naikLab    = Feasibility::where('id_formula',$Clonefs->id_formula)->where('id_project_pdf',$Clonefs->id_project_pdf)->where('revisi',$Clonefs->revisi)->max('revisi_lab')+1;
            $naikProses = Feasibility::where('id_formula',$Clonefs->id_formula)->where('id_project_pdf',$Clonefs->id_project_pdf)->where('revisi',$Clonefs->revisi)->max('revisi_proses')+1;
        }
        
        $addfs                  = new Feasibility; // menambahkan data FS baru
        $addfs->id_formula      = $Clonefs->id_formula;
        $addfs->id_project      = $Clonefs->id_project;
        $addfs->id_project_pdf  = $Clonefs->id_project_pdf;
        $addfs->revisi          = $Clonefs->revisi;
        $addfs->status_product  = $Clonefs->status_product;
        // Kemas
        if($request->kemas=='yes'){ // jika user kemas terdampak maka status nya akan "ajukan"
            $addfs->revisi_kemas = $naikKemas;
            $addfs->status_kemas = 'ajukan';
        }elseif($request->kemas != 'yes'){ // jika user kemas tidak terdampak, sistem akan kembali meminta konfirmasi keterdampakan tersebut pada user kemas
            $addfs->revisi_kemas = NULL;
            $addfs->status_kemas = $Clonefs->status_kemas;
        }
        // Lab
        if($request->lab=='yes'){ // jika user lab terdampak maka status nya akan "ajukan"
            $addfs->revisi_lab   = $naikLab;
            $addfs->status_lab   = 'ajukan';
        }elseif($request->lab   != 'yes'){ // jika user lab tidak terdampak, sistem akan kembali meminta konfirmasi keterdampakan tersebut pada user lab
            $addfs->revisi_lab   = NULL;
            $addfs->status_lab   = $Clonefs->status_lab;
        }
        // Proses
        if($request->proses=='yes'){ // jika user proses terdampak maka status nya akan "ajukan"
            $addfs->revisi_proses = $naikProses;
            $addfs->status_proses = 'ajukan';
        }elseif($request->proses != 'yes'){ // jika user proses tidak terdampak, sistem akan kembali meminta konfirmasi keterdampakan tersebut pada user proses
            $addfs->revisi_proses = NULL;
            $addfs->status_proses = $Clonefs->status_proses;
        }
        // Maklon
        if($request->maklon=='yes'){ // jika data maklon terdampak maka status nya akan "ajukan"
            $addfs->status_maklon = 'ajukan';
        }elseif($request->maklon != 'yes'){
            $addfs->status_maklon = $Clonefs->status_maklon;
        }
        $addfs->tgl_pengajuan     = $request->last_up;
        $addfs->status_feasibility= 'proses';
        $addfs->save();

        $pengajuan = FormPengajuanFS::where('id_feasibility',$fs)->first(); // membuat form pengajuan FS baru untuk FS baru
        $addform   = new FormPengajuanFS;
        $addform->id_feasibility        = $addfs->id;
        $addform->forecast              = $pengajuan->forecast;
        $addform->product_reference     = $pengajuan->product_reference;
        $addform->ref_ekp               = $pengajuan->ref_ekp;
        $addform->uom                   = $pengajuan->uom;
        $addform->gramasi_uom           = $pengajuan->gramasi_uom;
        $addform->location              = $pengajuan->location;
        $addform->Pricelist             = $pengajuan->Pricelist;
        $addform->uom_box               = $pengajuan->uom_box;
        $addform->uom_month             = $pengajuan->uom_month;
        $addform->box_batch             = $pengajuan->box_batch;
        $addform->serving_size          = $pengajuan->serving_size;
        $addform->serving_uom           = $pengajuan->serving_uom;
        $addform->Batch_month           = $pengajuan->Batch_month;
        $addform->batch_size            = $pengajuan->batch_size;
        $addform->batch_granulation     = $pengajuan->batch_granulation;
        $addform->Yield                 = $pengajuan->Yield;
        $addform->new_raw_material      = $pengajuan->new_raw_material;
        $addform->new_packaging_material= $pengajuan->new_packaging_material;
        $addform->new_machine           = $pengajuan->new_machine;
        $addform->trial                 = $pengajuan->trial;
        $addform->notes                 = $pengajuan->notes;
        $addform->user_id               = $pengajuan->user_id;
        $addform->created_date          = $pengajuan->created_date;
        $addform->save();

        $report              = new reportRevisi; // memasukan informasi naik versi FS ke table report
        $report->id_fs       = $addfs->id;
        $report->perevisi    = $request->perevisi;
        $report->Note        = $request->note;
        $report->update_date = $request->last_up;
        $report->kemas       = $request->kemas;
        $report->lab         = $request->lab;
        $report->proses      = $request->proses;
        $report->maklon      = $request->maklon;
        $report->save();

        //*****/ check workbook FS
        $id           = WorkbookFs::where('id_feasibility',$fs)->first();
        $cekKemas     = WorkbookFs::where('type','kemas')->where('id_feasibility',$fs)->count();
        $cekProses    = WorkbookFs::where('type','proses')->where('id_feasibility',$fs)->count();
        $dataKemas    = WorkbookFs::where('type','kemas')->where('id_feasibility',$fs)->first();
        $dataProses   = WorkbookFs::where('type','proses')->where('id_feasibility',$fs)->first();
        $cekMaklon    = Maklon::where('id_fs',$fs)->count();
        $cekLab       = DataLab::where('id_fs',$fs)->count();
        $dataMaklon   = Maklon::where('id_fs',$fs)->first();
        $dataLab      = DataLab::where('id_fs',$fs)->first();
        //*****/ Clone workbook FS
        // Kemas
        if($request->kemas!='yes'){ // jika kemas terdampak maka bagian ini akan di jalankan
            if($cekKemas!='0'){ // menghitung jumlah data kemas dan menduplikasi data tersebut
                $addwsKemas                 = new WorkbookFs;
                $addwsKemas->id_feasibility = $addfs->id;
                $addwsKemas->opsi           = '1';
                $addwsKemas->type           = 'kemas';
                $addwsKemas->name           = $id->name;
                $addwsKemas->note           = $id->note;
                $addwsKemas->status         = 'draf';
                $addwsKemas->save();

                $konsep             = KonsepKemas::where('id_ws',$dataKemas->id)->first();
                $kp                 = new KonsepKemas; // menambahkan data konsep kemas baru
                $kp->id_ws          = $addwsKemas->id ;
                $kp->keterangan     = $konsep->keterangan ;
                $kp->batch_size     = $konsep->batch_size ;
                $kp->box_palet      = $konsep->box_palet ;
                $kp->batch_yield    = $konsep->batch_yield ;
                $kp->referensi      = $konsep->referensi ;
                $kp->jumlah_box     = $konsep->jumlah_box ;
                $kp->kubikasi       = $konsep->kubikasi ;
                $kp->created_date   = $konsep->created_date ;
                $kp->save();

                $clm= Mesin::where('id_wb_fs',$dataKemas->id)->count();
                if($clm>0){ // menghitung data mesin filling dan packing dan menduplikasi data tersebut.
                    $mesin= Mesin::where('id_wb_fs',$dataKemas->id)->get();
                    foreach ($mesin as $lastM) {
                        $mesins = new Mesin;
                        $mesins->id_wb_fs       = $addwsKemas->id ;
                        $mesins->id_data_mesin  = $lastM->id_data_mesin ;
                        $mesins->runtime        = $lastM->runtime ;
                        $mesins->note           = $lastM->note ;
                        $mesins->save();
                    }
                } 

                $fk = FormulaKemas::where('id_ws',$dataKemas->id)->count();
                if($fk>0){ // menghitung data formula kemas dan menduplikasi data tersebut.
                    $kemas = FormulaKemas::where('id_ws',$dataKemas->id)->get();
                    foreach ($kemas as $formulaK) {
                        $km                 = new FormulaKemas;
                        $km->id_ws          = $addwsKemas->id ;
                        $km->item_code      = $formulaK->item_code ;
                        $km->kode_komputer  = $formulaK->kode_komputer ;
                        $km->Description    = $formulaK->Description ;
                        $km->jlh_pemakaian  = $formulaK->jlh_pemakaian ;
                        $km->spek           = $formulaK->spek ;
                        $km->supplier       = $formulaK->supplier ;
                        $km->min_order      = $formulaK->min_order ;
                        $km->harga_uom      = $formulaK->harga_uom ;
                        $km->cost_kemas     = $formulaK->cost_kemas ;
                        $km->line_mesin     = $formulaK->line_mesin ;
                        $km->dus_ppa        = $formulaK->dus_ppa ;
                        $km->box_ppa        = $formulaK->box_ppa ;
                        $km->batch_ppa      = $formulaK->batch_ppa ;
                        $km->unit_ppa       = $formulaK->unit_ppa ;
                        $km->dus_net        = $formulaK->dus_net ;
                        $km->box_net        = $formulaK->box_net ;
                        $km->batch_net      = $formulaK->batch_net ;
                        $km->unit_net       = $formulaK->unit_net ;
                        $km->waste          = $formulaK->waste ;
                        $km->cost_box       = $formulaK->cost_box ;
                        $km->cost_dus       = $formulaK->cost_dus ;
                        $km->cost_sachet    = $formulaK->cost_sachet ;
                        $km->save();
                    }
                } 
            }
        }
        // Lab
        if($request->lab!='yes'){// jika lab terdampak maka bagian ini akan di jalankan
            if($cekLab!='0'){ // menghitung jumlah data lab dan menduplikasi data tersebut
                $addweLab               = new DataLab;  // add ws Lab
                $addweLab->id_fs        = $addfs->id;
                $addweLab->id_item_desc = $dataLab->id_item_desc;
                $addweLab->save();
            }
        }
        // Proses
        if($request->proses!='yes'){ // jika proses terdampak maka bagian ini akan di jalankan
            if($cekProses!='0'){ // menghitung jumlah data proses dan menduplikasi data tersebut
                $addwsProses                 = new WorkbookFs; // add ws proses
                $addwsProses->id_feasibility = $addfs->id;
                $addwsProses->opsi           = '1';
                $addwsProses->type           = 'proses';
                $addwsProses->name           = $id->name;
                $addwsProses->note           = $id->note;
                $addwsProses->status         = 'draf';
                $addwsProses->save();

                $clm= Mesin::where('id_wb_fs',$dataProses->id)->count();
                if($clm>0){ // menghitung data mesin dan menduplikasi data tersebut
                    $mesin= Mesin::where('id_wb_fs',$dataProses->id)->get();
                    foreach ($mesin as $lastM) {
                        $mesins = new Mesin;
                        $mesins->id_wb_fs       = $addwsProses->id ;
                        $mesins->id_data_mesin  = $lastM->id_data_mesin ;
                        $mesins->runtime        = $lastM->runtime ;
                        $mesins->note           = $lastM->note ;
                        $mesins->save();
                    }
                } 

                $clo= OH::where('id_ws',$dataProses->id)->count();
                if($clo>0){ // menghitung data ohOther dan menduplikasi data tersebut
                    $oh= OH::where('id_ws',$dataProses->id)->get();
                    foreach ($oh as $lastO) {
                        $oh = new OH;
                        $oh->id_ws          = $addwsProses->id ;
                        $oh->mesin          = $lastO->mesin ;
                        $oh->nominal        = $lastO->nominal ;
                        $oh->Curren         = $lastO->Curren ;
                        $oh->note           = $lastO->note ;
                        $oh->save();
                    }
                } 

                $lini= LiniTerdampak::where('id_ws',$dataProses->id)->first();
                $ln = new LiniTerdampak; // membuat data lini terdampak baru
                $ln->id_ws          = $addwsProses->id ;
                $ln->my_contain     = $lini->my_contain ;
                $ln->allergen_baru  = $lini->allergen_baru ;
                $ln->lini_terdampak = $lini->lini_terdampak ;
                $ln->no_ref         = $lini->no_ref ;
                $ln->catatan        = $lini->catatan ;
                $ln->save();
            }
        }
        // Maklon
        if($request->maklon!='yes'){ // jika proses terdampak maka bagian ini akan di jalankan
            if($cekMaklon!='0'){ // menghitung jumlah data proses dan menduplikasi data tersebut
                $addwsMaklon = new Maklon; // add ws maklon
                $addwsMaklon->id_fs             = $addfs->id;
                $addwsMaklon->biaya_maklon      = $dataMaklon->biaya_maklon;
                $addwsMaklon->satuan            = $dataMaklon->satuan;
                $addwsMaklon->remarks_biaya     = $dataMaklon->remarks_biaya;
                $addwsMaklon->biaya_transport   = $dataMaklon->biaya_transport;
                $addwsMaklon->remarks_transport = $dataMaklon->remarks_transport;
                $addwsMaklon->save();
            }
        }

        if($Clonefs->id_project!=NULL){
            $data = PkpProject::where('id_project',$addfs->id_project)->first();
            $id   = $data->id_project;
        }elseif($Clonefs->id_project_pdf!=NULL){
            $data = ProjectPDF::where('id_project_pdf',$addfs->id_project_pdf)->first();
            $id   = $data->id_project_pdf;
        }
            try{ // mengirimkan informasi kepada PIC FS jika terdapat kenaikan versi pada FS
                Mail::send('email.EmailUpFs', [
                    'data'   => $data,
                    'fs'     => $Clonefs,
                    'info'   => '"'.Auth::user()->name.'" telah membuat versi baru untuk project FS dengan data sebagai berikut: ',
                    'alasan' => $request->note,
                    'catatan' => 'Silahkan Konfirmasi Terkait Perubahan Tersebut.',
                ], function ($message) use ($request,$id,$Clonefs) {
                    if($Clonefs->id_project!=NULL){
                        $data  = PkpProject::where('id_project',$id)->first();
                    }elseif($Clonefs->id_project_pdf!=NULL){
                        $data  = ProjectPDF::where('id_project_pdf',$id)->first();
                    }
                    $user1 = User::where('departement_id','7')->first();
                    $user2 = User::where('id',$data->user_fs)->first();
                    $user3 = User::where('id',$data->userpenerima2)->first();
                    $message->subject('PRODEV | INFO');
                    $message->to([$user1->email,$user2->email,$user3->email]);
                    $message->cc(Auth::user()->email);

                });
            }
            catch (Exception $e){
                return response (['status' => false,'errors' => $e->getMessage()]);
            }
        return redirect::back()->with('status','E-mail Successfully');
    }

    public function comfirmfs($fs){ // permintaan konfirmasi pada user ketika terdapat kenaikan versi
        $Clonefs    = Feasibility::where('id',$fs)->first();
        $kemas      = Feasibility::where('id_formula',$Clonefs->id_formula)->where('id_project',$Clonefs->id_project)->where('revisi',$Clonefs->revisi)->max('revisi_kemas');
        $lab        = Feasibility::where('id_formula',$Clonefs->id_formula)->where('id_project',$Clonefs->id_project)->where('revisi',$Clonefs->revisi)->max('revisi_lab');
        $proses     = Feasibility::where('id_formula',$Clonefs->id_formula)->where('id_project',$Clonefs->id_project)->where('revisi',$Clonefs->revisi)->max('revisi_proses');

        if(Auth::user()->departement_id=='1'){ // ketika user memiliki kode id departement "1/RKA"
            $wb = WorkbookFs::where('id_feasibility',$fs)->where('type','kemas')->first();
            $wb->status='sent';
            $wb->save();
            
            $Clonefs->revisi_kemas = $kemas;
            $Clonefs->id_wb_kemas=$wb->id;
        }elseif(Auth::user()->departement_id=='7'){ // ketika user memiliki kode id departement "7/LAB"
            $Clonefs->revisi_lab = $lab;
        }elseif(Auth::user()->departement_id=='2'){ // ketika user memiliki kode id departement "2/REA"
            $wb = WorkbookFs::where('id_feasibility',$fs)->where('type','proses')->first();
            $wb->status='sent';
            $wb->save();
            
            $Clonefs->revisi_proses = $proses;
            $Clonefs->id_wb_proses=$wb->id;
        }
        $Clonefs->save();

        return redirect::back();
    }

    public function revisifs($fs){ // ketika konfirmasi user membutuhkan revisi
        $Clonefs    = Feasibility::where('id',$fs)->first();
        $naikkemas  = Feasibility::where('id_formula',$Clonefs->id_formula)->where('id_project',$Clonefs->id_project)->where('revisi',$Clonefs->revisi)->max('revisi_kemas')+1;
        $naiklab    = Feasibility::where('id_formula',$Clonefs->id_formula)->where('id_project',$Clonefs->id_project)->where('revisi',$Clonefs->revisi)->max('revisi_lab')+1;
        $naikproses = Feasibility::where('id_formula',$Clonefs->id_formula)->where('id_project',$Clonefs->id_project)->where('revisi',$Clonefs->revisi)->max('revisi_proses')+1;
        
        if(Auth::user()->departement_id=='1'){// ketika user memiliki kode id departement "1/RKA"
            $Clonefs->revisi_kemas = $naikkemas;
            $Clonefs->status_kemas = 'ajukan';
        }elseif(Auth::user()->departement_id=='7'){// ketika user memiliki kode id departement "7/LAB"
            $Clonefs->revisi_lab = $naiklab;
            $Clonefs->status_lab = 'ajukan';
        }elseif(Auth::user()->departement_id=='2'){// ketika user memiliki kode id departement "2/REA"
            $Clonefs->revisi_proses = $naikproses;
            $Clonefs->status_proses = 'ajukan';
        }
        $Clonefs->save();

        return redirect::back();
    }
}