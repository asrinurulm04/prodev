<?php

namespace App\Http\Controllers\workbookFS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pdf\ProjectPDF;
use App\model\pdf\SubPDF;
use App\model\pkp\PkpProject;
use App\model\pkp\Forecast;
use App\model\formula\Formula;
use App\model\Modellab\DataLab;
use App\model\Modellab\ItemDesc;
use App\model\Modelmesin\Mesin;
use App\model\Modelmesin\LiniTerdampak;
use App\model\Modelkemas\KonsepKemas;
use App\model\Modelkemas\FormulaKemas;
use App\model\Modelmaklon\Maklon;
use App\model\feasibility\Feasibility;
use App\model\feasibility\WorkbookFs;
use App\model\feasibility\reportRevisi;
use App\model\feasibility\FormPengajuanFS;

use Redirect;

class WorkbookFsController extends Controller
{
    public function workbookfs($id_project,$fs){
        $wsproses   = WorkbookFs::where('id_feasibility',$fs)->where('type','proses')->count();
        $wsproses2  = WorkbookFs::where('id_feasibility',$fs)->where('type','proses')->where('status','sent')->count();
        $wskemas    = WorkbookFs::where('id_feasibility',$fs)->where('type','kemas')->count();
        $wskemas2   = WorkbookFs::where('id_feasibility',$fs)->where('type','kemas')->where('status','sent')->count();
        if(auth()->user()->role->namaRule === 'user_rd_proses' || auth()->user()->role->namaRule === 'manager'){
            $list   = WorkbookFs::where('id_feasibility',$fs)->where('type','proses')->get();
        }if(auth()->user()->role->namaRule === 'kemas'){
            $list   = WorkbookFs::where('id_feasibility',$fs)->where('type','kemas')->get();
        }
        $fs         = Feasibility::where('id',$fs)->first();
        $pdf        = SubPDF::where('pdf_id',$id_project)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('status_pdf','active')->first();
        $pkp        = PkpProject::where('id_project',$id_project)->first();
        return view('workbookFS.workbook')->with([
            'pkp'       => $pkp,
            'pdf'       => $pdf,
            'wsproses'  => $wsproses,
            'wskemas'   => $wskemas,
            'wsproses2' => $wsproses2,
            'wskemas2'  => $wskemas2,
            'list'      => $list,
            'id'        => $id_project,
            'fs'        => $fs
        ]);
    }

    public function overview($fs){
        $fs      = Feasibility::where('id',$fs)->first();
        $pkp     = PkpProject::where('id_project',$fs->id_project)->first();
        $formula = Formula::where('id',$fs->id_formula)->first();
        $for     = Forecast::where('id_project',$fs->id_project)->where('forecast','!=','0')->min('forecast');
        $form    = FormPengajuanFS::where('id_feasibility',$fs->id)->first();
        $maklon  = Maklon::where('id_fs',$fs->id)->first();
        $mesin   = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')
                   ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->where('tr_workbook_fs.status','Sent')->where('id_feasibility',$fs->id)
                   ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('nama_mesin')->distinct()->get();
        $kemas   = KonsepKemas::join('tr_workbook_fs','tr_workbook_fs.id','tr_datakemas.id_ws')->where('tr_workbook_fs.status','Sent')->where('id_feasibility',$fs->id)
                   ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('referensi')->first();
        $lokasi  = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','!=','Filling')->where('kategori','!=','Packing')
                   ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->get();
        $lokasi2 = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')->orwhere('kategori','Packing')
                   ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->get();
        $all     = LiniTerdampak::join('tr_workbook_fs','tr_workbook_fs.id','tr_lini_allergen.id_ws')->where('tr_workbook_fs.status','Sent')
                   ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->where('id_feasibility',$fs->id)->first();
        $dataLab = DataLab::where('id_fs',$fs->id)->join('ms_item_desc','ms_item_desc.id','tr_lab.id_item_desc')->first();
        $lab     = ($dataLab->kimia_batch * $formula->batch) + ($dataLab->biaya_tahanan * $formula->batch) + ($dataLab->analisa_swab * $formula->batch) + ($dataLab->mikro_analisa * $formula->batch) + (($dataLab->biaya_analisa * $dataLab->jlh_sample_mikro)* $formula->batch) + $dataLab->biaya_analisa_tahun;
        $analisa = $lab/$formula->batch;
        $forKemas= FormulaKemas::join('tr_feasibility','tr_feasibility.id_wb_kemas','tr_formula_kemas.id_ws')->where('id',$fs->id)->where('cost_uom','!=',NULL)->select('cost_uom')->first();
        return view('workbookFS.overview')->with([
            'fs'       => $fs,
            'for'      => $for,
            'formula'  => $formula,
            'forKemas' => $forKemas,
            'pkp'      => $pkp,
            'form'     => $form,
            'maklon'   => $maklon,
            'lokasi'   => $lokasi,
            'lokasi2'  => $lokasi2,
            'all'      => $all,
            'analisa'  => $analisa,
            'kemas'    => $kemas,
            'mesin'    => $mesin
        ]);
    }

    public function overviewpdf($fs){
        $fs      = Feasibility::where('id',$fs)->first();
        $pdf     = SubPDF::where('pdf_id',$fs->id_project_pdf)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('status_pdf','active')->first();
        $formula = Formula::where('id',$fs->id_formula)->first();
        $form    = FormPengajuanFS::where('id_feasibility',$fs->id)->first();
        $maklon  = Maklon::where('id_fs',$fs->id)->first();
        $mesin   = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')
                   ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->where('tr_workbook_fs.status','Sent')->where('id_feasibility',$fs->id)
                   ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('nama_mesin')->distinct()->get();
        $kemas   = KonsepKemas::join('tr_workbook_fs','tr_workbook_fs.id','tr_datakemas.id_ws')->where('tr_workbook_fs.status','Sent')->where('id_feasibility',$fs->id)
                   ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('referensi')->first();
        $lokasi  = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','!=','Filling')->where('kategori','!=','Packing')
                   ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->where('tr_workbook_fs.status','Sent')->where('id_feasibility',$fs->id)
                   ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->get();
        $lokasi2 = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')->orwhere('kategori','Packing')
                   ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->where('tr_workbook_fs.status','Sent')->where('id_feasibility',$fs->id)
                   ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->get();
        $all     = LiniTerdampak::join('tr_workbook_fs','tr_workbook_fs.id','tr_lini_allergen.id_ws')->where('tr_workbook_fs.status','Sent')
                   ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->where('id_feasibility',$fs->id)->first();
        $dataLab = DataLab::where('id_fs',$fs->id)->join('ms_item_desc','ms_item_desc.id','tr_lab.id_item_desc')->first();
        $lab     = ($dataLab->kimia_batch * $formula->batch) + ($dataLab->biaya_tahanan * $formula->batch) + ($dataLab->analisa_swab * $formula->batch) + ($dataLab->mikro_analisa * $formula->batch) + (($dataLab->biaya_analisa * $dataLab->jlh_sample_mikro)* $formula->batch) + $dataLab->biaya_analisa_tahun;
        $analisa = $lab/$formula->batch;
        $forKemas= FormulaKemas::join('tr_feasibility','tr_feasibility.id_wb_kemas','tr_formula_kemas.id_ws')->where('id',$fs->id)->where('cost_uom','!=',NULL)->select('cost_uom')->first();
        return view('workbookFS.overviewpdf')->with([
            'fs'       => $fs,
            'formula'  => $formula,
            'forKemas' => $forKemas,
            'pdf'      => $pdf,
            'form'     => $form,
            'maklon'   => $maklon,
            'lokasi'   => $lokasi,
            'lokasi2'  => $lokasi2,
            'all'      => $all,
            'analisa'  => $analisa,
            'kemas'    => $kemas,
            'mesin'    => $mesin
        ]);
    }

     public function reportinfo($info,$id_project){
        $informasi      = $info;
        if($info       == 'PKP'){
            $project    = PkpProject::where('id_project',$id_project)->first();
            $report     = reportRevisi::join('tr_feasibility','tr_feasibility.id','tr_report_revisifs.id_fs')->where('id_project',$id_project)->get();
        }elseif($info  == 'PDF'){
            $project    = SubPDF::where('pdf_id',$id_project)->where('status_pdf','active')->first();
            $report     = reportRevisi::join('tr_feasibility','tr_feasibility.id','tr_report_revisifs.id_fs')->where('id_project_pdf',$id_project)->get();
        }
        return view('workbookFS.tabulasiInfo')->with([
            'project'   => $project,
            'report'    => $report,
            'info'      => $informasi
        ]);
    }

    public function addFs(Request $request,$id,$fs){
        $ws = new WorkbookFs;
        $ws->id_feasibility = $fs;
        $ws->status         = 'draf';
        $ws->opsi           = '1';
        if(auth()->user()->role->namaRule === 'user_rd_proses'){
            $ws->type       = 'proses';
        }if(auth()->user()->role->namaRule === 'kemas'){
            $ws->type       = 'kemas';
        }
        $ws->save();

        if(auth()->user()->role->namaRule === 'user_rd_proses'){
            return redirect::route('datamesin',[$request->id,$fs,$ws->id]);
        }if(auth()->user()->role->namaRule === 'kemas'){
            return redirect::route('datakemas',[$request->id,$fs,$ws->id]);
        }
    }
}