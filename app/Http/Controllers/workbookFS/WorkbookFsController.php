<?php

namespace App\Http\Controllers\workbookFS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\PkpProject;
use App\model\formula\Formula;
use App\model\feasibility\Feasibility;
use App\model\feasibility\WorkbookFs;

class WorkbookFsController extends Controller
{
    public function workbookfs($id_project,$for){
        $ws = WorkbookFs::where('id_project',$id_project)->count();
        $list = WorkbookFs::where('id_project',$id_project)->where('status','!=','sent')->get();
        $fs = Feasibility::where('id_project',$id_project)->where('id_wb_fs',NULL)->get();
        $pkp = PkpProject::where('id_project',$id_project)->first();
        return view('workbookFS.workbook')->with([
            'pkp' => $pkp,
            'ws' => $ws,
            'list' => $list,
            'fs' => $fs
        ]);
    }

    public function info($id_project,$for){
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $wb = Formula::where('id',$for)->first();
        return view('workbookFS.info')->with([
            'pkp' => $pkp,
            'wb' => $wb
        ]);
    }
}
