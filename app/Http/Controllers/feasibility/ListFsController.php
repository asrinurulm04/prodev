<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\PkpProject;
use App\model\formula\Formula;
use App\model\feasibility\Feasibility;
use App\model\users\User;

class ListFsController extends Controller
{
    public function listPkpFs($id_project){
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $fs = Feasibility::where('status_feasibility','!=','batal')->get();
        $users = User::where('departement_id','2')->get();
        return view('feasibility.ListFsPkp')->with([
            'fs'    => $fs,
            'users' => $users,
            'pkp'   => $pkp
        ]);
    }

    public function FsPKP(){
        $pkp = PkpProject::where('pengajuan_fs','sent')->orwhere('pengajuan_fs','proses')->get();
        return view('feasibility.FsPKP')->with([
            'pkp' => $pkp
        ]);
    }
}
