<?php

namespace App\Http\Controllers\nutfact;
use App\devnf\tb_akg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TbAkgController extends Controller
{
    public function index()
    {
    	$tampilkan = tb_akg::with('get_tarkon')->get();
    	return view('nutfact.akg', compact('tampilkan'));
    }
}