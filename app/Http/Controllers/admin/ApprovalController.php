<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\users\User;
use DB;
use Redirect;
use Yajra\Datatables\Datatables;

class ApprovalController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:admin');
    }
    
    public function index(){ 
        $users = new User;
        $users = User::all();
        return view('admin.approval')->withusers($users);
    }

    public function destroy($id){
        $affectedRows = User::where('id', '=', $id)->delete();
        return redirect()->to('userapproval');
    }

    
}