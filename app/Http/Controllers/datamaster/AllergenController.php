<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\nutfact\Allergen;
use DB;
use Auth;
use Redirect;

class AllergenController extends Controller
{
    public function allergen(){
        $allergen = Allergen::all();
        return view('datamaster.allergen')->with([
            'allergen' => $allergen
        ]);
    }

    public function add_allergen(Request $request){ // menambahkan data alergen baru
        $all = new Allergen;
        $all->allergen      = $request->allergen;
        $all->tgl_update    = $request->last;
        $all->tgl_dibuat    = $request->last;
        $all->id_user       = Auth::user()->id;
        $all->save();

        return redirect()->back();
    }

    public function edit_allergen(Request $request,$id_allergen){ // edit data alergen
        $all = Allergen::where('id','=',$id_allergen)->first();
        $all->allergen      = $request->allergen;
        $all->tgl_update    = $request->last;
        $all->id_user       = Auth::user()->id;
        $all->save();

        return redirect()->back();
    }
}