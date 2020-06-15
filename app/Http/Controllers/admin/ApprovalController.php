<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\pkp\data;
use App\pkp\kategori;
use App\pkp\jenis;
use App\pkp\ses;
use App\pkp\data_ses;
use App\pkp\sub;
use App\pkp\uom;
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

    public function datases(){
        $ses= ses::all();
        return view('admin.ses')->with([
            'ses' => $ses
        ]);
    }

    public function ses(Request $request){
        $ses = new ses;
        $ses->ses=$request->ses;
        $ses->save();

        return redirect::back();
    }

    public function datauom(){
        $uom = uom::all();
        return view('datamaster.datauom')->with([
            'uom' => $uom
        ]);
    }

    public function uom(Request $request){
        $uom = new uom;
        $uom->primary_uom=$request->uom;
        $uom->save();

        return redirect::back();
    }
    
}