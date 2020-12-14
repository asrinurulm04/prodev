<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\PKP\jenis;
use App\model\users\Departement;
use App\model\users\User;
use App\model\users\Role;
use Redirect;
use DB;

class UserListController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:admin');
    }

    public function index(){
        $users = new User;
        $users = User::all();
        return view('admin.listuser')->with([
            'users' => $users]);
    }

    public function blok($id){
        $user = User::find($id)->update(['status'=>'nonactive']);
        return Redirect::back();
    }

    public function open($id){
        $user = User::find($id)->update(['status'=>'active']);
        return Redirect::back();
    }
        
    public function show($id){
        $users = User::find($id);
        $roles = Role::all();
        $depts = Departement::all();

        return view('admin.detail')->with([
            'users' => $users,
            'depts' =>$depts,
            'roles' =>$roles]);
    }

    public function isijenis(Request $request, $id_jenis){   
        $data = [$id_jenis]; 
        $datajenis = jenis::whereIn('id_jenis', $data)->first();
        foreach ($datajenis as $jenis){
            $jenis = $request->input('pjenis');
            foreach($jenis as $key => $jenis2) {
                if($jenis2 == 'active'){
                    $datajenis->status= 'active';
                }elseif($jenis2 == 'inactive'){
                    $datajenis->status = 'inactive';
                }
            }
        }
        $datajenis->save();
        return redirect()->back();
    }  

    public function update($id,Request $request){
        $user = User::find($id);
        $this->validate(request(), [
            'username' => 'unique:users,username,'.$user->id,
            'email' => 'unique:users,email,'.$user->id,
            'email' => 'regex:"@nutrifood.co.id"',
            'password' => 'confirmed'
        ]);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->departement_id = $request->departement;
        $user->role_id = $request->role;
        
        $user->password = $request->password;
        $user->save(); 
        
        return Redirect::back()->with('status','Profil User Telah Dirubah !');
    }

}