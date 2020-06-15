<?php

namespace App\Http\Controllers\datamaster;

use App\master\Subbrand;
use App\master\Brand;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class subbrandController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:admin');
    }
    
    public function index()
    {
        $subbrands = Subbrand::all();
        $users = User::all();
        $brands = Brand::all();
        return view('datamaster.subbrand')->with([
            'subbrands' => $subbrands,
            'users' => $users,
            'brands' => $brands
        ]);
    }

    public function store(Request $request)
    {
        $subbrand  = new Subbrand;
        $subbrand->subbrand = $request->subbrand;
        $subbrand->brand_id = $request->brand;
        $subbrand->user_id = $request->manager;
        $subbrand->save();

        return Redirect::back()->with('status','Subbrand '.$subbrand->subbrand.' Berhasil Dibuat');
    }

    public function edit(Subbrand $subbrand)
    {
        $users = User::all();
        $brands = Brand::all();
        return view('datamaster.editsubbrand')->with([
            'subbrand' => $subbrand,
            'users' => $users,
            'brands' => $brands
        ]);
    }

    public function update(Request $request, Subbrand $subbrand)
    {
        
        $subbrand->subbrand = $request->subbrand;
        $subbrand->brand_id = $request->brand;
        $subbrand->user_id = $request->manager;
        $subbrand->save();

        return Redirect()->route('subbrand.index')->with('status','Subbrand '.$subbrand->subbrand.' Berhasil DiUpdate');
    }

    public function destroy(Subbrand $subbrand)
    {
        $subbrand->delete();
        return Redirect::back()->with('error','Subbrand '.$subbrand->subbrand.' Berhasil DiHapus');
    }
}
