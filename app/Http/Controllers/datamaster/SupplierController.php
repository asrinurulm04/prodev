<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\master\Supplier;
use DB;
use Auth;
use Redirect;

class SupplierController extends Controller
{
    public function add_supplier(Request $request){ // tambah supplier baru
        $supplier = new Supplier;
        $supplier->nama_supplier_principal          = $request->nama;
        $supplier->kode_oracle_supplier_principal   = $request->oracle;
        $supplier->alamat_supplier_principal        = $request->alamat;
        $supplier->telepon_supplier_principal       = $request->telp;
        $supplier->no_fax_supplier_principal        = $request->fax;
        $supplier->website_supplier_principal       = $request->web;
        $supplier->created_by                       = Auth::user()->id;
        $supplier->updated_by                       = Auth::user()->id;;
        $supplier->is_active                        = 'active';
        $supplier->save();

        return redirect::back()->with('status', 'Data berhasil ditambahkan');
    }

    public function supplier(){ // Halaman supplier
        $supplier = Supplier::orderBy('nama_supplier_principal','asc')->select('id','nama_supplier_principal','alamat_supplier_principal','telepon_supplier_principal','is_active')->get();
        return view('datamaster.supplier')->with([
            'supplier' => $supplier
        ]);
    }

    public function inactive_supplier($id){ // in-active data
        $supplier = Supplier::where('id',$id)->first();
        $supplier->is_active = 'inactive';
        $supplier->save();

        return redirect::back()->with('status', 'Data nonactive');
    }

    public function active_supplier($id){ // active data
        $supplier = Supplier::where('id',$id)->first();
        $supplier->is_active = 'active';
        $supplier->save();

        return redirect::back()->with('status', 'data diaktifkan');
    }

    public function edit_supplier(Request $request,$id){ // edit data supplier
        $supplier = Supplier::where('id',$id)->first();
        $supplier->nama_supplier_principal          = $request->nama;
        $supplier->kode_oracle_supplier_principal   = $request->oracle;
        $supplier->alamat_supplier_principal        = $request->alamat;
        $supplier->telepon_supplier_principal       = $request->telp;
        $supplier->no_fax_supplier_principal        = $request->fax;
        $supplier->website_supplier_principal       = $request->web;
        $supplier->updated_by                       = Auth::user()->id;
        $supplier->save();
        
        return redirect::back()->with('status', 'Revised data ');
    }
}