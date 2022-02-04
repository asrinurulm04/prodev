<?php

namespace App\Http\Controllers\Costing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\pkp\PkpProject;
use App\model\pdf\ProjectPDF;

class ListFsCostingController extends Controller
{
    public function listFsConting(){
        $pkp    = PkpProject::where('pengajuan_fs','done')->get();
        $pdf    = ProjectPDF::where('pengajuan_fs','done')->get();
        return view('costing.listprojectfs')->with([
            'pkp'   => $pkp,
            'pdf'   => $pdf
        ]);
    }
}
