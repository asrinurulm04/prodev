<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use App\model\users\User;

class homeController extends Controller
{
     // untuk mengakses homecontroller user harus login terlebih dahulu
     public function __construct()
     {
         $this->middleware('auth');
     }
     // akses ke home menyesuaikan tipe akses user
 
     public function home()
     {
        // jika admin
        // user() : model user
        // ->role : relasi dgn tabel role
        // ->namaRule : kolom 'role' pada table 'role'
 
        if (auth()->check() && Auth::user()->role->namaRule == 'admin'){
            return Redirect::route('userapproval');
        // jika non admin
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'manager'){
            return Redirect::route('dasboardmanager');
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'marketing'){
            return Redirect::route('dasboardnr');
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'user_produk'){
            return Redirect::route('dasboardawal');
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'user_rd_proses'){
            return Redirect::route('dasboardawal');
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'pv_global'){
            return Redirect::route('dasboardpv');
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'pv_lokal'){
            return Redirect::route('dasboardpv');
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'produksi'){
            return Redirect::route('formula.feasibility');
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'kemas'){
            return Redirect::route('dasboardawal');
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'evaluator'){
            return Redirect::route('formula.feasibility');
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'finance'){
            return Redirect::route('formula.feasibility');
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'NR'){
            return Redirect::route('dasboardnr');
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'CS'){
            return Redirect::route('dasboardnr');
        }elseif (auth()->check() && Auth::user()->role->namaRule == 'lab'){
            return Redirect::route('formula.feasibility');
        }else{
            return view ('login');
        }
    }
}