<?php

namespace App\Http\Controllers\devnf;
use App\devnf\tb_parameter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TbHitungHakController extends Controller
{
    public function hitungHAK(){
    	$tampilkan = tb_parameter::all();
        return view('devnf.penghitunganhak', compact('tampilkan','muncul'));
    }

    public function NutfactUser(){
        return view('devnf.compare_nutfact');
    }

    public function NutfactAdmin(){
        return view('admin.nutfact');
    }
}