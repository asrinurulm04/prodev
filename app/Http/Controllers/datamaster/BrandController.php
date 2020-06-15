<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\master\Brand;
use Redirect;

class BrandController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:admin');
    }

    public function index(){
        $brands = Brand::all();
        return view('datamaster.brand')->with([
            'brands' => $brands
        ]);
    }

    public function store(Request $request){
        $brand = new Brand;
        $brand->brand = $request->brand;
        $brand->save();

        return Redirect::back()->with('status','Brand '.$brand->brand.' Berhasil Dimasukan');
    }

    public function update($id,Request $request){
        $brand = Brand::where('id',$id)->first();
        $brand->brand = $request->brand;
        $brand->save();

        return Redirect()->route('brand.index')->with('status','Brand '.$brand->brand.' Telah Di Update');
    }

    public function destroy($id){
        $brand = Brand::where('id',$id)->first();
        $n = $brand->brand;
        $brand->delete();
        return Redirect::back()->with('error','Brand '.$brand->brand.' Berhasil Di Hapus');
    }
}