<?php

namespace App\Http\Controllers\maklon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class workbookmaklonController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:manager' || 'rule:lab');
    }

    public function workbookmaklon($formula,$id){
        return view('maklon.workbook_maklon');
    }
}
