<?php

namespace App\Http\Controllers\devnf;
use App\devnf\tb_parameter;
use App\devnf\formula;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TbHitungAkgController extends Controller
{
    public function hitungAKG(){
    	$tampilkan = tb_parameter::all();
        return view('devnf.penghitunganakg', compact('tampilkan','muncul'));
    }
}
