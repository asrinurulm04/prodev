<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\users\Departement;
use App\model\users\User;
use Redirect;

class DepartementController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:admin');
    }

    public function dept(){ //halaman list deppartement
        $depts = Departement::all();
        $users = User::where('status','active')->get();
        return view('datamaster.departement')->with([
            'depts' => $depts,
            'users' => $users
        ]);
    }

    public function deldept($id){ // delet dept
        $dept = Departement::where('id',$id)->delete();
        return Redirect::back()->with('error', 'Departement '.$n.' Telah Dihapus!');
    }

    public function adddept(Request $request){ // menambahkan data dept baru
        $dept = new Departement;
        $dept->dept         = $request->dept;
        $dept->nama_dept    = $request->nama_dept;
        $dept->manager_id   = $request->manager;
        $dept->save();

        return Redirect::back()->with('status', 'Departement '.$dept->dept.' Telah Ditambahkan!');
    }

    public function saveupdateDept($id,Request $request){ // save update
        $dept = Departement::where('id',$id)->first();
        $dept->dept         = $request->dept;
        $dept->nama_dept    = $request->nama_dept;
        $dept->manager_id   = $request->manager;
        $dept->save();

        return Redirect()->route('dept')->with('status', 'Departement '.$dept->dept.' Telah DiUpdate!');
    }
}