<?php

namespace App\Http\Controllers\nutfact;
use App\nutfact\tb_ingredient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TbIngredientController extends Controller
{
    public function index()
    {
    	$tampilkan = tb_ingredient::all();
    	return view('nutfact.ingredient', compact('tampilkan'));
    }
}
