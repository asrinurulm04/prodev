<?php

namespace App\Http\Controllers\nutfact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\devnf\tb_nutrition;
use App\nutfact\tb_parameter;
use Illuminate\Support\Facades\DB;

class TbNutritionController extends Controller
{
    public function databb(){
    	$tampil = tb_nutrition::with('get_bahan')->get();
        return view('nutfact.bahanbaku',compact('tampil'));
    }
}	