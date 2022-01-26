<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\users\User;
use DB;
use Redirect;

class ApprovalController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:admin');
    }
    
    public function index(){ //Halaman approval user
        $users = new User;
        $users = User::all();
        return view('admin.approval')->with([
            'users' => $users
        ]);
    }
}