<?php

namespace App\Http\Controllers\workbookFS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\PkpProject;
use App\model\formula\Formula;
use App\model\feasibility\Feasibility;
use App\model\feasibility\WorkbookFs;
use App\model\feasibility\reportRevisi;

class WorkbookFsController extends Controller
{
    public function workbookfs($id_project){
        $ws         = WorkbookFs::where('id_project',$id_project)->where('type','proses')->count();
        $ws_lab     = WorkbookFs::where('id_project',$id_project)->where('type','lab')->count();
        $ws_kemas   = WorkbookFs::where('id_project',$id_project)->where('type','kemas')->count();
        $list       = WorkbookFs::where('id_project',$id_project)->where('status','!=','sent')->get();
        $fs         = Feasibility::where('id_project',$id_project)->where('id_wb_fs',NULL)->get();
        $pkp        = PkpProject::where('id_project',$id_project)->first();
        return view('workbookFS.workbook')->with([
            'pkp'       => $pkp,
            'ws'        => $ws,
            'ws_lab'    => $ws_lab,
            'ws_kemas'  => $ws_kemas,
            'list'      => $list,
            'fs'        => $fs
        ]);
    }

    public function info($id_project,$for){
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $wb = Formula::where('id',$for)->first();
        $report = reportRevisi::join('tr_feasibility','tr_feasibility.id','tr_report_revisifs.id_fs')->where('id_formula',$for)->get();
        return view('workbookFS.info')->with([
            'pkp' => $pkp,
            'wb' => $wb,
            'report' => $report
        ]);
    }

     public function reportinfo($id_project){
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $report = reportRevisi::join('tr_feasibility','tr_feasibility.id','tr_report_revisifs.id_fs')->where('id_project',$id_project)->get();
        return view('workbookFS.tabulasiInfo')->with([
            'pkp' => $pkp,
            'report' => $report
        ]);
    }
}
