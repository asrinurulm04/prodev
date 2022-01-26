<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\master\Supplier;
use App\model\master\Principal;
use DB;
use Auth;
use Redirect;

class PrincipalController extends Controller
{
    public function principal(){ 
        $supplier   = Supplier::orderBy('nama_supplier_principal','asc')->get();
        $principal  = Principal::orderBy('nama_cp','asc')->select('nama_cp','is_active','email_cp')->get();
        return view('datamaster.principal')->with([
            'principal' => $principal,
            'supplier'  => $supplier
        ]);
    }

    public function inactive_principal($id){
        $principal = Principal::where('id',$id)->first();
        $principal->is_active='inactive';
        $principal->save();

        return redirect::back()->with('status', 'Data nonactive');
    }

    public function active_principal($id){
        $principal = Principal::where('id',$id)->first();
        $principal->is_active='active';
        $principal->save();

        return redirect::back()->with('status', 'Data di aktifkan');
    }

    public function add_principal(Request $request){
        $principal = new Principal;
        $principal->ms_supplier_principal_id = $request->supplier;
        $principal->nama_cp                  = $request->name;
        $principal->email_cp                 = $request->email;
        $principal->telepon_cp               = $request->telp;
        $principal->jabatan_cp               = $request->jabatan;
        $principal->is_active                = 'active';
        $principal->created_by               = Auth::user()->id;
        $principal->updated_by               = Auth::user()->id;
        $principal->save();

        return redirect::back()->with('status', 'Data berhasil ditambahkan');
    }

    public function edit_principal(Request $request,$id){
        $principal = Principal::where('id',$id)->first();
        $principal->nama_cp     = $request->name;
        $principal->email_cp    = $request->email;
        $principal->telepon_cp  = $request->telp;
        $principal->jabatan_cp  = $request->jabatan;
        $principal->is_active   = 'active';
        $principal->updated_by  = Auth::user()->id;
        $principal->save();

        return redirect::back()->with('status', 'Revised data ');
    }
}
