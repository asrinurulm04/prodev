<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function update($id,Request $request){
        $user = User::find($id);
        $this->validate(request(), [
            'username' => 'unique:tr_users,username,'.$user->id,
            'email' => 'unique:tr_users,email,'.$user->id,
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