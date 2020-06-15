<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dev\Formula;
use Redirect;

class ListFormulaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $formulas = Formula::where('status_fisibility','proses')->get();
        return view('feasibility.formula')->with([
            'formulas' => $formulas
        ]);
    }

    public function sudah(){
        $formulas = Formula::where('status_fisibility','approved')->get();
        return view('feasibility.selesai')->with([
            'formulas' => $formulas
        ]);
    }
}