<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\master\Subbrand;
use App\model\master\Brand;
use App\model\users\User;
use Redirect;
use Auth;

class subbrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:admin');
    }
    
    public function index(){
        $subbrands = Subbrand::all();
        $users = User::all();
        $brands = Brand::all();
        return view('datamaster.subbrand')->with([
            'subbrands' => $subbrands,
            'users' => $users,
            'brands' => $brands
        ]);
    }

    public function store(Request $request){
        $subbrand  = new Subbrand;
        $subbrand->subbrand= $request->subbrand;
        $subbrand->brand_id= $request->brand;
        $subbrand->user_id=Auth::user()->id;
        $subbrand->save();

        return Redirect::back()->with('status','Subbrand '.$subbrand->subbrand.' Berhasil Dibuat');
    }

    public function update(Request $request, $id){
        $subbrand = Subbrand::where('id',$id)->first();
        $subbrand->subbrand=$request->subbrand;
        $subbrand->brand_id=$request->brand;
        $subbrand->user_id=Auth::user()->id;
        $subbrand->save();

        return Redirect::back()->with('status','Subbrand '.$subbrand->subbrand.' Berhasil DiUpdate');
    }

    public function destroy(Subbrand $subbrand){
        $subbrand->delete();
        return Redirect::back()->with('error','Subbrand '.$subbrand->subbrand.' Berhasil DiHapus');
    }
}
