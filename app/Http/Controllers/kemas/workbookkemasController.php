<?php

namespace App\Http\Controllers\kemas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use DB;
Use redirect;

class workbookkemasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:manager' || 'rule:kemas');
    }

    public function workbookkemas($formula,$id){
        return view('kemas.workbook_kemas');
    }
}
