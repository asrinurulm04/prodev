<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\dev\Formula;
use App\model\pkp\SubPKP;
use Redirect;

class ListFormulaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $formulas = SubPKP::where('status_data','active')->join('tr_feasibility','tr_feasibility.id_formula','=','tr_sub_pkp.id_pkp')->get();
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