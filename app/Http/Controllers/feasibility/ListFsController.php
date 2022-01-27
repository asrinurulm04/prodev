<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\PkpProject;
use App\model\pdf\ProjectPDF;
use App\model\users\User;
use App\model\Modelmesin\Mesin;
use App\model\feasibility\Feasibility;
use App\model\feasibility\WorkbookFs;
use App\model\feasibility\reportRevisi;
use App\model\Modelmaklon\Maklon;
use Auth;
use Redirect;

class ListFsController extends Controller
{
    public function listPkpFs($id_project){
        $pkp     = PkpProject::where('id_project',$id_project)->select('id_project','pkp_number','ket_no','id_brand','idea','user_fs','project_name')->first();
        if(Auth::user()->departement_id=='2'){
            $fs  = Feasibility::where('id_project','!=',NULL)->where('id_project',$id_project)->get();
        }elseif(Auth::user()->departement_id!='2'){
            $fs  = Feasibility::where('id_project','!=',NULL)->where('status_feasibility','proses')->orwhere('status_feasibility','selesai')->where('id_project',$id_project)->get();
        }
        $lokasi  = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','!=','Filling')->where('kategori','!=','Packing')
                 ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->get();
        $lokasi2 = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')->orwhere('kategori','Packing')
                 ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->get();
        $maklon  = Maklon::all();
        $report  = reportRevisi::select('note','id_fs')->get();
        $users   = User::where('departement_id','2')->get();
        $data    = 'PKP';
        return view('feasibility.ListFsPkp')->with([
            'fs'     => $fs,
            'report' => $report,
            'maklon' => $maklon,
            'users'  => $users,
            'lokasi' => $lokasi,
            'lokasi2'=> $lokasi2,
            'pkp'    => $pkp,
            'data'   => $data
        ]);
    }

    public function listPdfFs($id_project){
        $pdf     = ProjectPDF::where('id_project_pdf',$id_project)->join('tr_sub_pdf','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')
                ->select('id_project_pdf','pdf_number','ket_no','id_brand','background','user_fs','project_name','revisi','turunan')->first();
        if(Auth::user()->departement_id=='2'){
            $fs  = Feasibility::where('id_project_pdf','!=',NULL)->where('id_project_pdf',$id_project)->get();
        }elseif(Auth::user()->departement_id!='2'){
            $fs  = Feasibility::where('id_project_pdf','!=',NULL)->where('status_feasibility','proses')->where('id_project_pdf','!=',NULL)->orwhere('status_feasibility','selesai')->where('id_project_pdf',$id_project)->get();
        }
        $lokasi  = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','!=','Filling')->where('kategori','!=','Packing')
                 ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->get();
        $lokasi2 = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')->orwhere('kategori','Packing')
                 ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->get();
        $maklon  = Maklon::all();
        $report  = reportRevisi::select('note','id_fs')->get();
        $users   = User::where('departement_id','2')->get();
        $data    = 'PDF';
        return view('feasibility.ListFsPdf')->with([
            'fs'     => $fs,
            'maklon' => $maklon,
            'report' => $report,
            'users'  => $users,
            'lokasi' => $lokasi,
            'lokasi2'=> $lokasi2,
            'pdf'    => $pdf,
            'data'   => $data
        ]);
    }

    public function FsPKP(){
        $pkp  = PkpProject::where('pengajuan_fs','!=','reject')->get();
        $pkp2 = PkpProject::where('user_fs',Auth::user()->id)->where('pengajuan_fs','!=',NULL)->orwhere('pengajuan_fs','!=','reject')->where('user_fs',Auth::user()->id)->get();
        $pkp3 = PkpProject::where('pengajuan_fs','done')->orwhere('pengajuan_fs','proses')->get();
        $pkp4 = PkpProject::where('userpenerima2',Auth::user()->id)->get();
        return view('feasibility.FsPKP')->with([
            'pkp'  => $pkp,
            'pkp2' => $pkp2,
            'pkp3' => $pkp3,
            'pkp4' => $pkp4
        ]);
    }

    public function FsPDF(){
        $pdf  = ProjectPDF::where('pengajuan_fs','!=','reject')->get();
        $pdf2 = ProjectPDF::where('pengajuan_fs','!=',NULL)->where('user_fs',Auth::user()->id)->get();
        $pdf3 = ProjectPDF::where('pengajuan_fs','done')->orwhere('pengajuan_fs','proses')->get();
        $pdf4 = ProjectPDF::where('pengajuan_fs','done')->orwhere('pengajuan_fs','proses')->where('userpenerima2',Auth::user()->id)->get();
        return view('feasibility.FsPDF')->with([
            'pdf'  => $pdf,
            'pdf2' => $pdf2,
            'pdf3' => $pdf3,
            'pdf4' => $pdf4
        ]);
    }

    public function gabung($id,$fs){ // menggabungkan data workbook fs yang di tentukan dengan feasibility
        $list = WorkbookFs::where('id',$id)->first();
        $list->status = 'sent'; // update status draf->sent
        $list->save();

        $ws = Feasibility::where('id',$fs)->first();
        if($list->type == 'proses'){ // jika project tersebut adalah proses, maka yang dibatalkan hanya project proses saja
            $ws->status_proses ='sending';
            $ws->id_wb_proses  = $id;
        }elseif($list->type == 'kemas'){ // dan jika project kemas, maka yang akan di batalkan hanya project kemas saja
            $ws->status_kemas = 'sending';
            $ws->id_wb_kemas  = $id;
        }
        $ws->save();

        if($ws->id_project!=NULL){
            return redirect::route('listPkpFs',$ws->id_project);
        }elseif($ws->id_project_pdf!=NULL){
            return redirect::route('listPdfFs',$ws->id_project_pdf);
        }
    }

    public function batalgabung($id,$fs){ // membatalkan penggabungan workbook dengan fs
        $list = WorkbookFs::where('id',$id)->first();
        $list->status = 'Draf'; // kembali merubah status workbook sent->draf
        $list->save();

        $ws = Feasibility::where('id',$fs)->first();
        if($list->type == 'proses'){ // jika project tersebut adalah proses, maka yang dibatalkan hanya project proses saja
            $ws->status_proses = 'ajukan';
            $ws->id_wb_proses  = NULL;
        }elseif($list->type == 'kemas'){ // dan jika project kemas, maka yang akan di batalkan hanya project kemas saja
            $ws->status_kemas = 'ajukan';
            $ws->id_wb_kemas  = NULL;
        }
        $ws->save();

        return redirect::back();
    }
}