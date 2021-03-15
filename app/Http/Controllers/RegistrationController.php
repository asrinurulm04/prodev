<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\users\Departement;
use App\model\users\Role;
use App\model\users\User;

class RegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }

    public function create(){
        $roles = Role::all();
        $depts = Departement::all();
        return view('register')->with([
            'depts' => $depts,
            'roles' => $roles]);
    }

    public function registrationPost(Request $request){
        $this->validate(request(), [
            'username' => 'unique:tr_users',
            'email' => 'unique:tr_users|regex:"@nutrifood.co.id"',
            'password' => 'confirmed'
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->departement_id = $request->departement;
        $user->role_id = $request->role;
        $user->save();
        
        return redirect()->to('/signin')->with('status', 'Add Data Success ');
    }
}