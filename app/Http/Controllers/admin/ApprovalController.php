<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\users\User;
use App\model\pkp\data;
use App\model\pkp\kategori;
use App\model\pkp\jenis;
use App\model\pkp\ses;
use App\model\pkp\data_ses;
use App\model\pkp\sub;
use App\model\pkp\uom;
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