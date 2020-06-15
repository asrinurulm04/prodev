<?php

namespace App\Http\Controllers\nutfact;
use App\nutfact\tb_parameter;
use App\nutfact\tb_kategori;
use App\devnf\tb_akg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TbParameterController extends Controller
{
    public function index()
    {
    	$tampilkan = tb_parameter::with('get_akg','get_kategori')->get();
        return view('nutfact.parameter', compact('tampilkan'));
    }

    public function show()
    {
    	$tampil  = tb_parameter::all();
        $tampil1 = tb_kategori::all();
        return view('nutfact.mencariparameter', compact('tampil', 'tampil1'));
    }

    public function edit($id)
    {
        $kat  = tb_kategori::all();
        $akg  = tb_akg::distinct()->get();
        $edit = tb_parameter::where('id_p',$id)->with('get_akg','get_kategori')->get();
        return view('nutfact.editparameter', compact('edit','akg','kat'));
    }

    public function delete($id)
    {
        tb_parameter::where('id_p',$id)->delete();
        return back();
    }
}