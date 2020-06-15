<?php

namespace App\Http\Controllers\nutfact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TbBtpController extends Controller
{
    public function index(){
        return view('nutfact.btp');
    }
}
