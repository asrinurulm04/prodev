<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\formula\registrasi_formula;
use App\formula\tb_formula;
use App\dev\Bahan;

use Auth;
use Redirect;


class penyusunanalternatifController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function alternatif($registrasi,$id){
        $formulas = tb_formula::where('id_registrasi',$registrasi)->get();
        $regis = registrasi_formula::where('id_registrasi',$registrasi)->get();
        $ada= tb_formula::where('id_registrasi',$registrasi)->count();
        return view('formula/penyusunan_alternatif')->with([
            'formulas' => $formulas,
            'registrasi' => $regis,
            'ada' => $ada
        ]);
    }
}
