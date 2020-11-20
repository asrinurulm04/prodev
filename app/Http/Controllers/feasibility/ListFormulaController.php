<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dev\Formula;
use App\pkp\tipp;
use App\pkp\pkp_project;
use App\Modelfn\feasibility;
use Redirect;

class ListFormulaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $formulas = tipp::where('status_data','active')->join('fs_finance','fs_finance.id_formula','=','tippu.id_pkp')->get();
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