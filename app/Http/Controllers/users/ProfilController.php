<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\users\User;
use Auth;
use Redirect;

class ProfilController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function show(){
        $id     = Auth::id();
        $users  = User::find($id);
        return view('myprofile')->with([
            'users' => $users]);

    }

    public function update(Request $request){
        $id     = Auth::id();
        $user   = User::find($id);
        
        $this->validate(request(), [
            'username'  => 'unique:tr_users,username,'.$user->id,
            'email'     => 'unique:tr_users,email,'.$user->id,
            'email'     => 'regex:"@nutrifood.co.id"',
            'password'  => 'confirmed'
        ]);
        
        $user->name     = $request->name;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = $request->password;
        $user->save();
        
        return Redirect::back()->with('status','Profil Anda Telah Dirubah !');
    }
}