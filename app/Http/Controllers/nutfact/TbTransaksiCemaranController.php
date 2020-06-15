<?php

namespace App\Http\Controllers\nutfact;
use App\nutfact\tb_transaksi_cemaran;
use App\nutfact\tb_parameter_cemaran;
use App\nutfact\tb_jenis_cemaran;
use App\nutfact\tb_jenis_makanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TbTransaksiCemaranController extends Controller
{
    public function index(){
        $tampil1 = tb_parameter_cemaran::all();
        $tampil2 = tb_jenis_cemaran::all();
        $tampil3 = tb_jenis_makanan::all();
        return view('nutfact.inputc', compact('tampil1','tampil2', 'tampil3'));
    }

    public function datac(){
    	$tampilkan = tb_transaksi_cemaran::get();
        return view('nutfact.cemaran',compact('tampilkan'));
    }

    public function dataclanjut(){
    	$tampilkan  = tb_transaksi_cemaran::with('jenis','para','makanan')->get();  
    	$tampil1 = tb_parameter_cemaran::all();
    	$tampil2 = tb_jenis_cemaran::all();
        return view('nutfact.mencaricemaran', compact('tampilkan','tampil1','tampil2'));
    }

    public function store(Request $request){
        $cemaran = new tb_transaksi_cemaran;
        $cemaran->id_jenis_cemaran = $request->get('id_jenis_cemaran');
        $cemaran->id_parameter_cemaran = $request->get('id_parameter_cemaran');
        $cemaran->id_jenis_makanan = $request->get('id_jenis_makanan');
        $cemaran->save();
        return redirect('inputc')->with('success','Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $edit = tb_transaksi_cemaran::where('id_tc', $id)->with('')->get();
        return view('nutfact.editcemaran', compact('edit'));
    }
}
