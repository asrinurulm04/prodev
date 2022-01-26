<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\master\Brand;
use Redirect;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:admin');
    }

    public function index(){
        $brands = Brand::select('brand','id')->get();
        return view('datamaster.brand')->with([
            'brands' => $brands
        ]);
    }
}