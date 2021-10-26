<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\users\User;
use App\model\pkp\PkpProject;
use App\model\formula\Formula;
use App\model\feasibility\Feasibility;
use App\model\feasibility\WorkbookFs;
use App\model\Modelmaklon\Maklon;
use Auth;
use Redirect;

class ListFsController extends Controller
{
    public function listPkpFs($id_project){
        $pkp    = PkpProject::where('id_project',$id_project)->first();
        if(Auth::user()->departement_id=='2'){
            $fs = Feasibility::where('status_feasibility','!=','batal')->where('id_project',$id_project)->get();
        }elseif(Auth::user()->departement_id!='2'){
            $fs = Feasibility::where('status_feasibility','proses')->orwhere('status_feasibility','selesai')->where('id_project',$id_project)->get();
        }
        $maklon = Maklon::all();
        $users  = User::where('departement_id','2')->get();
        return view('feasibility.ListFsPkp')->with([
            'fs'    => $fs,
            'maklon'=> $maklon,
            'users' => $users,
            'pkp'   => $pkp
        ]);
    }

    public function FsPKP(){
        $pkp = PkpProject::where('pengajuan_fs','sent')->orwhere('pengajuan_fs','proses')->get();
        $pkp2 = PkpProject::where('user_fs',Auth::user()->id)->where('pengajuan_fs','sent')->orwhere('pengajuan_fs','proses')->get();
        $pkp3 = PkpProject::where('user_fs',Auth::user()->id)->where('pengajuan_fs','done')->orwhere('pengajuan_fs','proses')->get();
        return view('feasibility.FsPKP')->with([
            'pkp' => $pkp,
            'pkp2' => $pkp2,
            'pkp3' => $pkp3
        ]);
    }

    public function gabung($id,$fs){
        $list = WorkbookFs::where('id',$id)->first();
        $list->id_feasibility=$fs;
        $list->save();

        $ws = Feasibility::where('id',$fs)->first();
        if($list->type=='proses'){
            $ws->status_proses='sending';
        }elseif($list->type=='kemas'){
            $ws->status_kemas='sending';
        }
        $ws->save();

        return redirect::route('listPkpFs',$ws->id_project);
    }
}